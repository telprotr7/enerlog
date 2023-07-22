<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TasksController extends Controller
{
    public function index()
    {

        $taskStatusCounts = Task::select(DB::raw('status, count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $started = $taskStatusCounts['Started'] ?? 0;
        $not_started = $taskStatusCounts['Not Started'] ?? 0;
        $complete = $taskStatusCounts['Complete'] ?? 0;
        $pending = $taskStatusCounts['Pending'] ?? 0;
        $progress = $taskStatusCounts['Progress'] ?? 0;


        $title = 'Task Management';

        $tasks = Task::with('users')->get();
        $users = User::all();
        // return view('task.index', [
        //     'title' => 'Task Management',
        //     'tasks' => $tasks,
        //     'users' => $users
        // ]);
        return view('task.index', compact('title', 'tasks', 'users', 'started', 'not_started', 'complete', 'pending', 'progress'));
    }


    public function create()
    {
        $users = User::all();
        $title = 'Create Task';
        return view('task.create', compact('users', 'title'));
    }


    public function store(Request $request)
    {
        $task = new Task;
        $task->start = $request->start;
        $task->name = $request->task_name;
        $task->task_to = json_encode($request->users_task);
        $task->status = $request->status_task;
        $task->priority = $request->priority;
        $task->tasK_type = $request->task_type;
        $task->end = $request->end;
        $task->keterangan = $request->keterangan;
        // Tambahkan atribut lainnya

        $task->save();

        $assignedUserIds = $request->input('users_task');
        $task->users()->attach($assignedUserIds); // Menghubungkan pengguna dengan tugas

        return redirect('/task')->with('success', 'Tugas berhasil ditambahkan!');
    }

    function edit($id)
    {
        $users = User::all();
        $data = Task::find($id);
        // dd(json_decode($data->task_to));
        return view('task.edit', [
            'title' => "update Task",
            'users' => $users,
            'data' => $data
        ]);
    }

    function update($id, Request $request)
    {

        $task = Task::find($id);

        $task->start = $request->start;
        $task->name = $request->name;
        $task->task_to = json_encode($request->users_task_edit);
        $task->status = $request->status;
        $task->priority = $request->priority;
        $task->tasK_type = $request->task_type;
        $task->end = $request->end;
        $task->keterangan = $request->keterangan;
        // Tambahkan atribut lainnya

        $task->save();

        $assignedUserIds = $request->input('users_task_edit');
        $task->users()->sync($assignedUserIds);

        return redirect('/task')->with('success', 'Tugas berhasil diupdate!');
    }

    // Fungsi untuk menghapus data tugas
    function destroy($id)
    {
        // Temukan entitas Task berdasarkan $id
        $task = Task::find($id);

        // Hapus relasi Many-to-Many antara pengguna dan tugas
        $task->users()->detach();

        // Hapus entitas Task dari database
        $task->delete();

        return redirect('/task')->with('success', 'Tugas berhasil dihapus!');
    }
}
