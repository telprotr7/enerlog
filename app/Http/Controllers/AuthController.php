<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required'
        ]);

        $loginField = $request->input('login');
        $password = $request->input('password');

        $user = User::where(function ($query) use ($loginField) {
            $query->where('nik', $loginField)
                ->orWhere('email', $loginField);
        })->first();

        if ($user) {
            if ($user->is_active == 1) {
                $sess = User::find($user->id)->userAgent;

                $credentials = [];
                if (filter_var($loginField, FILTER_VALIDATE_EMAIL)) {
                    $credentials['email'] = $loginField;
                } else {
                    $credentials['nik'] = $loginField;
                }

                if (Auth::attempt(array_merge($credentials, ['password' => $password]), $request->has('remember'))) {
                    // $user->userAgent->lat = $request->lat;
                    // $user->userAgent->long = $request->long;
                    // $user->userAgent->user_agent = $request->userAgent();
                    // $user->push();

                    User::where('id', Auth::user()->id)->update(['user_time_login' => Carbon::now()]);

                    $request->session()->regenerate();

                    // Cek role pengguna dan arahkan ke URL yang sesuai
                    if ($user->role == 1) {
                        return redirect()->intended('/home');
                    } else if ($user->role == 0) {
                        return redirect()->intended('/ac');
                    }
                }
            } else {
                return back()->with('errorLogin', 'Sorry, ' . '<span style="color:red">' . $user->name . '</span>' . ' your account is not active!');
            }
        } else {
            return back()->with('errorLogin', 'This ' . '<span style="color:red">' . $loginField . '</span>' . ' is not registered yet!');
        }

        return back()->with('errorLogin', 'Wrong NIK or Password!');
    }

    public function logout(Request $request, $id)
    {

        $log = User::find($id);

        $data = ['status_login' => 'offline'];

        $log->where('id', $id)->update($data);

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/auth/login');
    }

    function registerPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|min:2',
            'nik' => 'required|digits:8|numeric|unique:users',
            'password' => 'required|string|min:3|confirmed',
            'password_confirmation' => 'required'
        ]);

        $validator->sometimes('email', 'required|email|unique:users', function ($input) {
            return $input->email !== null;
        });

        if ($validator->fails()) {
            return redirect()->to(route('forget.password'))
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Registrasi gagal!');
        }

        $validateData['image'] = 'default.png';
        $validateData['password'] = bcrypt($request->password);
        $validateData['name'] = $request->full_name;
        $validateData['nik'] = $request->nik;
        $validateData['email'] = $request->email;
        $validateData['is_active'] = 0;
        $validateData['role'] = 0;

        User::create($validateData);
        return redirect('/auth/login')->with('success', $request->full_name . ' berhasil ditambahkan!');
    }

    function forgotPassPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users'
        ]);

        $email = $request->email;
        $user = User::where('email', $email)->first();        

        $token = Str::random(64);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Email ' . $request->email . ' tidak terdaftar!');
        }

        if($user->is_active == 0){
            return redirect()->to(route('login'))->with('error', 'Akun Anda tidak aktif!');
        }

        // Hapus token yang sudah kadaluwarsa sebelum memasukkan yang baru
        DB::table('password_reset_tokens')
            ->where('created_at', '<=', Carbon::now()->subMinutes(1))
            ->delete();

        Mail::send('auth.emails.forget-password', ['token' => $token, "email" => $request->email], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject("Reset Password");
        });

        // Tambahkan token dengan waktu kadaluwarsa 1 menit
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'expires_at' => Carbon::now()->addMinutes(1),
            'created_at' => Carbon::now()
        ]);

        return redirect()->to(route('login'))->with('success', 'Silahkan buka email Anda!');
    }

    function resetPassword($token, $email)
    {
        return view('auth.new-password', compact('token', 'email'));
    }

    function resetPasswordPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:3|confirmed',
            'password_confirmation' => 'required'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal mengubah password!');
        }

        $updatePassword = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->where('expires_at', '>', Carbon::now())
            ->first();

            if (!$updatePassword) {
                return redirect()->to(route('reset.password', ['token' => $request->token, 'email' => $request->email]))
                    ->with('error', 'Token reset password tidak valid atau sudah kadaluwarsa!');
            }

        User::where("email", $request->email)->update(["password" => Hash::make($request->password)]);

        DB::table("password_reset_tokens")->where(["email" => $request->email])->delete();

        return redirect()->to(route('login'))->with('success', 'Password berhasil diubah!');
    }
}
