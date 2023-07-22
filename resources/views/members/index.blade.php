@extends('layouts.main')
@section('content')

<style>
    .dt-buttons .dt-button.buttons-excel.buttons-html5.btn.btn-sm.border-0{
        display: none;
    }
</style>
<link rel="stylesheet" href="{{ asset('') }}/assets/vendor/toastr/css/toastr.min.css">

<div class="flash-error" data-error="{{ session('error') }}"></div>
<div class="flash-success" data-success="{{ session('success') }}"></div>




<div class="page-titles">

    <a class="text-primary fs-13" data-bs-toggle="offcanvas" href="#offcanvasExample1" role="button"
        aria-controls="offcanvasExample1">+ Add Task</a>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive active-projects style-1">
                        <div class="tbl-caption">
                            <h4 class="heading mb-0">Users List</h4>
                            <div>
                                <a class="btn btn-primary btn-sm" data-bs-toggle="offcanvas" href="#offcanvasExample"
                                    role="button" aria-controls="offcanvasExample">+ Add Member</a>
                                    
                            </div>
                        </div>
                        <div id="empoloyees-tblwrapper_wrapper" class="dataTables_wrapper no-footer">
                            
                            <table id="empoloyees-tblwrapper" class="table dataTable no-footer" role="grid"
                                aria-describedby="empoloyees-tblwrapper_info">
                                <thead>
                                    <tr role="row">

                                        <th class="sorting" tabindex="0" aria-controls="empoloyees-tblwrapper"
                                            rowspan="1" colspan="1"
                                            aria-label="Employee Name: activate to sort column ascending"
                                            style="width: 270.25px;">Name</th>
                                        <th class="sorting" tabindex="0" aria-controls="empoloyees-tblwrapper"
                                            rowspan="1" colspan="1"
                                            aria-label="Department: activate to sort column ascending"
                                            style="width: 203.281px;">Nik</th>
                                        <th class="sorting" tabindex="0" aria-controls="empoloyees-tblwrapper"
                                            rowspan="1" colspan="1"
                                            aria-label="Contact Number: activate to sort column ascending"
                                            style="width: 209.719px;">Role</th>
                                        <th class="sorting" tabindex="0" aria-controls="empoloyees-tblwrapper"
                                            rowspan="1" colspan="1"
                                            aria-label="Gender: activate to sort column ascending"
                                            style="width: 115.547px;">Status</th>
                                        <th class="sorting" tabindex="0" aria-controls="empoloyees-tblwrapper"
                                            rowspan="1" colspan="1"
                                            aria-label="Location: activate to sort column ascending"
                                            style="width: 126.828px;">Opsi</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($members as $member)
                                        @if ($member->id != 1)
                                            <tr role="row" class="odd" id="iduser{{ $member->id }}">
                                                <td>
                                                    <div class="products">
                                                        @if ($member->image != 'default.png')
                                                            <img src="{{ asset('storage/' . $member->image) }}"
                                                                class="avatar avatar-md" alt="">
                                                        @else
                                                            <img src="{{ asset('assets/images/avatar/' . auth()->user()->image) }}"
                                                                class="avatar avatar-md" alt="">
                                                        @endif
                                                        <div>
                                                            <h6>{{ $member->name }}</h6>
                                                            <span>{{ $member->email }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><span>{{ $member->nik }}</span></td>
                                                <td>
                                                    @if ($member->role == 1)
                                                        <span class="text-primary">Admin</span>
                                                    @else
                                                        <span class="text-primary">Member</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($member->is_active == 1)
                                                        <span class="badge badge-success light border-0">Active</span>
                                                    @else
                                                        <span class="badge badge-danger light border-0">Nonactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)" id="btnEditMember"
                                                        data-iduser="{{ $member->id }}"
                                                        data-activeuser="{{ $member->is_active }}"
                                                        data-roleuser="{{ $member->role }}"
                                                        data-nameuser="{{ $member->name }}"
                                                        class="btn btn-primary btn-icon-xxs" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal1"><i
                                                            class="fas fa-pencil-alt"></i></a>

                                                    <a href="{{ url('members/detail-member/' . $member->id) }}" class="btn btn-info btn-icon-xxs"><i
                                                            class="fa-solid fa-eye"></i></a>

                                                    <a href="javascript:void(0)"
                                                        onclick="delUser({{ $member->id }})"
                                                        class="btn btn-danger btn-icon-xxs"><i
                                                            class="fa-solid fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




{{-- MODAL EDIT MEMBER --}}
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-center">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="userEditModalTitle">Invite Employee</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form class="row g-3 needs-validation" id="formEdit" method="post">
                   
                    @csrf
                    <div class="col-md-6">
                        <label for="isActiveCheck" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-control" id="statusEdit" name="status" tabindex="null">
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                        <select class="form-control" id="roleEdit" name="role" tabindex="null">
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>


        </div>
    </div>
</div>
{{-- END MODAL EDIT MEMBER --}}


<script src="{{ asset('') }}/assets/js/jquery-3.7.0.js"></script>
<script src="{{ asset('') }}/assets/vendor/toastr/js/toastr.min.js"></script>
<script src="{{ asset('') }}/assets/js/myNotif.js"></script>



<script>
    $(document).on("click", "#btnEditMember", function() {
        const id = $(this).data('iduser');
        const active = $(this).data('activeuser');

        let cardAct = '';
        if (active == 1) {
            cardAct += `
            <option value="1" selected>Active</option>
            <option value="0">Nonactive</option>`;
            $('#statusEdit').html(cardAct);
        } else {
            cardAct += `
            <option value="0" selected>Nonactive</option>
            <option value="1">Active</option>`;
            $('#statusEdit').html(cardAct);
        }


        const role = $(this).data('roleuser');
        let cardRole = '';
        if (role == 1) {
            cardRole += `<option value="1">Admin</option>
                    <option value="0">Member</option>`;
            $('#roleEdit').html(cardRole);
        } else {
            cardRole += `<option value="0">Member</option><option value="1">Admin</option>`;
            $('#roleEdit').html(cardRole);
        }

        const url = "{{ url('/members/update') }}";
        const name = $(this).data('nameuser');
       
        $('#formEdit').attr('action', url + "/" + id);
        $('#userEditModalTitle').html(`Update Data ${name}`);
    });
</script>



<script>
    document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault();
    });

    function previewImage() {
        const img = document.querySelector('#img');
        const imgPre = document.querySelector('.img-preview');
        imgPre.style.display = 'block';
        const ofReader = new FileReader();
        ofReader.readAsDataURL(img.files[0]);
        ofReader.onload = function(oFREvent) {
            imgPre.src = oFREvent.target.result;
        }
    }
</script>

<script>
    function delUser(id) {

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
                $.ajax({
                    url: "{{ url('/members/delete') }}" + "/" + id,
                    type: "DELETE",
                    data: {
                        _token: $("input[name=_token]").val()
                    },
                    success: function(response) {
                        $("#iduser" + id).remove();
                    }
                });
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        })
    }
</script>
@endsection
