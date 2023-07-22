@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{ asset('') }}/assets/vendor/toastr/css/toastr.min.css">
    <div class="flash-error" data-error="{{ session('error') }}"></div>
    <div class="flash-success" data-success="{{ session('success') }}"></div>

    <div class="row">
        <div class="col-xl-9 mx-auto">
            <a href="{{ url('/task') }}" class="btn btn-danger btn-sm mb-2 mt-3"><i class='bx bx-arrow-back'></i> Back</a>
            <h6 class="mb-0 text-uppercase">Update Task</h6>
            <hr />
            <div class="card">
                <div class="card-body">
                    <div class="p-4 border rounded">

                        <form action="{{ url('tasks/update-data/'. $data->id) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="form-group mb-2">
                                    <label class="mb-0" for="start">Start Task</label>
                                    <input type="text" class="form-control " name="start" id="date-format5"
                                        value="{{ old('start', $data->start) }}">
                                </div>
                                <div class="form-group mb-2">
                                    <label class="mb-0" for="task_name">Nama Tugas</label>
                                    <input type="text" class="form-control" id="task_name_edit" name="name" required
                                        value="{{ old('name', $data->name) }}">
                                </div>
                                <div class="form-group mb-2">
                                    <label class="mb-0" for="users_task">Pilih Petugas</label>
                                    <select id="users_task_edit" name="users_task_edit[]" class="multiple-select" multiple
                                        required style="z-index: 9999;" value>
                                        @foreach ($users as $user)
                                            <?php
                                            // Konversi data task_to menjadi array
                                            $selectedUsers = json_decode($data->task_to);
                                            
                                            ?>
                                            <option value="{{ $user->id }}"
                                                {{ in_array($user->id, $selectedUsers) ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="mb-0" for="status_task">Status</label>
                                    <select class="default-select  form-control wide" name="status"
                                        id="status_task_edit">
                                        <option value="{{ $data->status }}" selected>{{ $data->status }}</option>
                                        <option value="">--Pilih Status--</option>
                                        <option value="Started">Started</option>
                                        <option value="Not Started">Not Started</option>
                                        <option value="Complete">Complete</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Progress">In Progress</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="mb-0" for="priority">Priority</label>
                                    <select class="default-select  form-control wide" name="priority" id="priority_edit">
                                        <option value="{{ $data->priority }}" selected>{{ $data->priority }}</option>
                                        <option value="">--Pilih Priority--</option>
                                        <option value="Medium">Medium</option>
                                        <option value="High">High</option>
                                        <option value="Low">Low</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="mb-0" for="task_type">Task Type</label>
                                    <select class="default-select  form-control wide" name="task_type" id="task_type_edit">
                                        <option value="{{ $data->task_type }}" selected>{{ $data->task_type }}</option>
                                        <option value="">--Pilih Type Task--</option>
                                        <option value="Project">Project</option>
                                        <option value="Not Project">Not Project</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-2">
                                    <label class="mb-0" for="end">End Task</label>
                                    <input type="text" class="form-control " name="end" id="date-format6"
                                        value="{{ old('end', $data->end) }}">
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="mb-0" class="keterangan">Keterangan <small>(optional)</small></label>
                                    <textarea class="form-control" name="keterangan" id="keterangan_edit" rows="4" cols="4"
                                       placeholder="Masukan keterangan jika ada!">{{ old('keterangan', $data->keterangan) }}</textarea>
                                </div>
                            </div>
                            <!-- tambahkan input untuk atribut lainnya -->
                            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>


        <script src="{{ asset('') }}/assets/js/jquery.min.js"></script>
        <script src="{{ asset('assets/vendor/input-tags/js/tagsinput.js') }}"></script>
        <script src="{{ asset('') }}/assets/vendor/toastr/js/toastr.min.js"></script>
        <script src="{{ asset('') }}/assets/js/myNotif.js"></script>
    @endsection
