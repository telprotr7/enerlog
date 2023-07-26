@extends('layouts.main')
@section('content')
    <style>
        .modal.fade.bd-example-modal-lg {
            z-index: 1050;
            position: absolute;
        }

        .dataTables_filter {
            margin-right: 20px;
        }
    </style>
    @php
        use Illuminate\Support\Carbon;
    @endphp


    <link href="{{ asset('assets/vendor/input-tags/css/tagsinput.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('') }}/assets/vendor/toastr/css/toastr.min.css">
    <div class="flash-error" data-error="{{ session('error') }}"></div>
    <div class="flash-success" data-success="{{ session('success') }}"></div>


    <div class="page-titles">
        <ol class="breadcrumb">
            <li>
                <h5 class="bc-title">Task Management</h5>
            </li>
        </ol>
        <a class="text-primary fs-13" data-bs-toggle="offcanvas" href="#offcanvasExample1" role="button"
            aria-controls="offcanvasExample1">+ Add Task</a>
    </div>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">

            <div class="d-flex align-items-center">
                <button type="button" class="btn btn-primary btn-sm ms-2" data-bs-toggle="modal"
                    data-bs-target=".bd-example-modal-lg">+ Add Task</button>
            </div>
        </div>

        <div class="row kanban-bx">
            <div class="col">
                <div class="card kanbanPreview-bx">
                    <div class="card-body draggable-zone dropzoneContainer" tabindex="0">
                        <div class="sub-card border-primary">
                            <div class="sub-card-2">
                                <div>
                                    <h5 class="mb-0">Started</h5>
                                    <a href="#">View</a>
                                </div>
                                <div class="icon-box bg-primary-light rounded-circle">
                                    <h5 class="text-primary totalCount">{{ $started }}</h5>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card kanbanPreview-bx">
                    <div class="card-body draggable-zone dropzoneContainer" tabindex="0">
                        <div class="sub-card border-warning">
                            <div class="sub-card-2">
                                <div>
                                    <h5 class="mb-0">Not Started</h5>
                                    <a href="#">View</a>
                                </div>
                                <div class="icon-box bg-warning-light rounded-circle">
                                    <h5 class="text-warning totalCount">{{ $not_started }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card kanbanPreview-bx">
                    <div class="card-body draggable-zone dropzoneContainer" tabindex="0">
                        <div class="sub-card border-purple">
                            <div class="sub-card-2">
                                <div>
                                    <h5 class="mb-0">Progress</h5>
                                    <a href="#">View</a>
                                </div>
                                <div class="icon-box bg-purple-light rounded-circle">
                                    <h5 class="text-purple totalCount">{{ $progress }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card kanbanPreview-bx">
                    <div class="card-body draggable-zone dropzoneContainer" tabindex="0">
                        <div class="sub-card border-success">
                            <div class="sub-card-2">
                                <div>
                                    <h5 class="mb-0">Complete</h5>
                                    <a href="#">View</a>
                                </div>
                                <div class="icon-box bg-success-light rounded-circle">
                                    <h5 class="text-success totalCount">{{ $complete }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card kanbanPreview-bx">
                    <div class="card-body draggable-zone dropzoneContainer" tabindex="0">
                        <div class="sub-card border-danger">
                            <div class="sub-card-2">
                                <div>
                                    <h5 class="mb-0">Pending</h5>
                                    <a href="#">View</a>
                                </div>
                                <div class="icon-box bg-danger-light rounded-circle">
                                    <h5 class="text-danger totalCount">{{ $pending }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive active-projects task-table">
                            <div class="tbl-caption">
                                <h4 class="heading mb-0">Task</h4>
                            </div>
                            <table id="tasksTable" class="table">
                                <thead>
                                    <tr>

                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Task Type</th>
                                        <th>Assigned To</th>
                                        <th>Priority</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tasks as $task)
                                        <tr>
                                            <td><span>{{ $loop->iteration }}</span></td>
                                            <td>
                                                <div>
                                                    <div>
                                                        <h6>{{ $task->name }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($task->status == 'Started')
                                                    <span
                                                        class="badge badge-primary light border-0 me-1">{{ $task->status }}</span>
                                                @elseif ($task->status == 'Not Started')
                                                    <span class="badge badge-primary light border-0 me-1"
                                                        style="background-color: #ffeccc !important;
                                                    color: #FF9F00 !important;">{{ $task->status }}</span>
                                                @elseif ($task->status == 'Complete')
                                                    <span class="badge badge-primary light border-0 me-1"
                                                        style="background-color: #daf5e6 !important;
                                                    color: #3AC977 !important;">{{ $task->status }}</span>
                                                @elseif ($task->status == 'Pending')
                                                    <span class="badge badge-primary light border-0 me-1"
                                                        style="background-color: #ffdede !important;
                                                    color: #FF5E5E !important;">{{ $task->status }}</span>
                                                @else
                                                    <span class="badge badge-primary light border-0 me-1"
                                                        style="background-color: rgba(187, 107, 217, 0.1) !important;
                                                color: #BB6BD9 !important;">{{ $task->status }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span>{{ $task->start }}</span>
                                            </td>
                                            <td>
                                                <span>{{ $task->end }}</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-primary light border-0 me-1">{{ $task->task_type }}</span>

                                            </td>
                                            <td>
                                                <div class="avatar-list avatar-list-stacked">
                                                    @foreach ($task->users as $user)
                                                        @if (auth()->user()->image != 'default.png')
                                                            <img src="{{ asset('storage/' . $user->image) }}"
                                                                class="avatar rounded-circle" data-bs-container="body"
                                                                data-bs-toggle="popover" data-bs-placement="top"
                                                                data-bs-original-title="{{ $user->name }}"
                                                                data-bs-trigger="hover" alt="">
                                                        @else
                                                            <img src="{{ asset('assets/images/avatar/' . $user->image) }}"
                                                                class="avatar rounded-circle" data-bs-container="body"
                                                                data-bs-toggle="popover" data-bs-placement="top"
                                                                data-bs-original-title="{{ $user->name }}"
                                                                data-bs-trigger="hover" alt="">
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td>
                                                @if ($task->priority == 'Medium')
                                                    <span class="badge badge-primary light border-0 me-1"
                                                        style="background-color: #ffeccc !important;
                                                    color: #FF9F00 !important;">{{ $task->priority }}</span>
                                                @elseif ($task->priority == 'High')
                                                    <span class="badge badge-primary light border-0 me-1"
                                                        style="background-color: #ffdede !important;
                                                    color: #FF5E5E !important;">{{ $task->priority }}</span>
                                                @else
                                                    <span class="badge badge-primary light border-0 me-1"
                                                        style="background-color: #daf5e6 !important;
                                                    color: #3AC977 !important;">{{ $task->priority }}</span>
                                                @endif
                                            </td>
                                            <td>

                                                <a href="{{ url('/tasks/update/' . $task->id) }}" class="text-info"
                                                    style="border:none;background:none"><i
                                                        class="fas fa-pencil-alt"></i></a>

                                                <span class="text-warning" data-bs-container="body"
                                                    data-bs-toggle="popover" data-bs-placement="top"
                                                    data-bs-original-title="{{ $task->keterangan }}"
                                                    data-bs-trigger="hover"><i class="fa-solid fa-eye"></i></span>


                                                <a id="btnDeleteTask" href="{{ url('/tasks/delete/' . $task->id) }}"
                                                    class="text-danger" style="border:none;background:none"><i
                                                        class="fa-solid fa-trash"></i></a>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- MODAL ADD TASK --}}

    <div class="modal fade bd-example-modal-lg" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group mb-2">
                                <label class="mb-0" for="start">Start Task</label>
                                <input type="text" class="form-control " name="start" id="date-format3">
                            </div>
                            <div class="form-group mb-2">
                                <label class="mb-0" for="task_name">Nama Tugas</label>
                                <input type="text" class="form-control" id="task_name_add" name="task_name" required>
                            </div>
                            <div class="form-group mb-2">
                                <label class="mb-0" for="users_task">Pilih Petugas</label>
                                <select id="users_task_add" name="users_task[]" class="multiple-select" multiple required
                                    style="z-index: 9999;">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="mb-0" for="status_task">Status</label>
                                <select class="default-select  form-control wide" name="status_task" id="status_task">
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
                                <select class="default-select  form-control wide" name="priority" id="priority_add">
                                    <option value="">--Pilih Priority--</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                    <option value="Low">Low</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="mb-0" for="task_type">Task Type</label>
                                <select class="default-select  form-control wide" name="task_type" id="task_type_add">
                                    <option value="">--Pilih Type Task--</option>
                                    <option value="Project">Project</option>
                                    <option value="Not Project">Not Project</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="mb-0" for="end">End Task</label>
                                <input type="text" class="form-control " name="end" id="date-format6">
                            </div>
                            <div class="col-md-12 mb-2">
                                <label class="mb-0" class="keterangan">Keterangan <small>(optional)</small></label>
                                <textarea class="form-control" name="keterangan" id="keterangan_add" rows="4" cols="4"
                                    value="{{ old('keterangan') }}" placeholder="Masukan keterangan jika ada!"></textarea>
                            </div>
                        </div>
                        <!-- tambahkan input untuk atribut lainnya -->
                        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    {{-- END MODAL ADD TASK --}}




    <script src="{{ asset('') }}/assets/js/jquery.min.js"></script>
    <script src="{{ asset('assets/vendor/input-tags/js/tagsinput.js') }}"></script>
    <script src="{{ asset('') }}/assets/vendor/toastr/js/toastr.min.js"></script>
    <script src="{{ asset('') }}/assets/js/myNotif.js"></script>

    {{-- SCRIPT DELETE DATA TASKS --}}
    <script>
        $(document).on('click', '#btnDeleteTask', function(e) {
            const href = $(this).attr('href');
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            })
        });
    </script>
    {{-- END SCRIPT DELETE DATA TASK --}}
@endsection
