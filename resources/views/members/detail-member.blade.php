@extends('layouts.main')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/members')}}" class="btn btn-primary btn-icon-sm text-white"><i class="fa fa-arrow-left text-white"></i> Back</a></li>
        </ol>
    </div>
    <div class="container-fluid">
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="profile card card-body px-3 pt-3 pb-0">
                    <div class="profile-head">
                        <div class="photo-content">
                            <div class="cover-photo rounded"></div>
                        </div>
                        <div class="profile-info">
                            <div class="profile-photo">
                                @if ($member->image != 'default.png')
                                    <img src="{{ asset('storage/' . $member->image) }}" class="img-fluid rounded-circle"
                                        alt="">
                                @else
                                    <img src="{{ asset('assets/images/avatar/' . $member->image) }}"
                                        class="img-fluid rounded-circle" alt="">
                                @endif
                            </div>
                            <div class="profile-details">
                                <div class="profile-name px-3 pt-2">
                                    <h4 class="text-primary mb-0">{{ $member->name }}</h4>
                                    <p>{{ $member->nik }}</p>
                                </div>
                                <div class="profile-email px-2 pt-2">
                                    <h4 class="text-muted mb-0">{{ $member->email }}</h4>
                                    <p>Email</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-xl-8">
                <div class="card h-auto">
                    <div class="card-body">
                        <div class="profile-tab">
                            <div class="custom-tab-1">
                                <ul class="nav nav-tabs">

                                    <li class="nav-item"><a href="#about-me" data-bs-toggle="tab" class="nav-link ">About
                                            Me</a>
                                    </li>

                                </ul>

                                <div class="profile-about-me">
                                    <div class="pt-4 border-bottom-1 pb-3">
                                        <h4 class="text-primary">About Me</h4>
                                        <p class="mb-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo
                                            cumque voluptas recusandae, facilis magni adipisci corporis nesciunt asperiores
                                            deserunt quam est pariatur natus ducimus commodi sit velit doloribus id amet?
                                        </p>
                                    </div>
                                </div>
                                <div class="profile-skills mb-5">
                                    <h4 class="text-primary mb-2">Skills</h4>
                                    <a href="javascript:void(0);" class="btn btn-primary light btn-xs mb-1">Slot</a>
                                    <a href="javascript:void(0);" class="btn btn-primary light btn-xs mb-1">Gacor</a>
                                    <a href="javascript:void(0);" class="btn btn-primary light btn-xs mb-1">Slot</a>
                                    <a href="javascript:void(0);" class="btn btn-primary light btn-xs mb-1">Game</a>
                                    <a href="javascript:void(0);" class="btn btn-primary light btn-xs mb-1">Slot</a>
                                    <a href="javascript:void(0);" class="btn btn-primary light btn-xs mb-1">Gacor</a>
                                </div>
                                <div class="profile-lang  mb-5">
                                    <h4 class="text-primary mb-2">Language</h4>
                                    <a href="javascript:void(0);" class="text-muted pe-3 f-s-16"><i
                                            class="flag-icon flag-icon-us"></i> Indonesia</a>
                                    <a href="javascript:void(0);" class="text-muted pe-3 f-s-16"><i
                                            class="flag-icon flag-icon-fr"></i> China</a>
                                    <a href="javascript:void(0);" class="text-muted pe-3 f-s-16"><i
                                            class="flag-icon flag-icon-bd"></i> Vietnam</a>
                                </div>
                                <div class="profile-personal-info">
                                    <h4 class="text-primary mb-4">Personal Information</h4>
                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-5">
                                            <h5 class="f-w-500">Name <span class="pull-end">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-sm-9 col-7"><span>{{ $member->name }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-5">
                                            <h5 class="f-w-500">Email <span class="pull-end">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-sm-9 col-7"><span>{{ $member->email }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-5">
                                            <h5 class="f-w-500">Kontak <span class="pull-end">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-sm-9 col-7"><span>{{ $member->no_wa }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-5">
                                            <h5 class="f-w-500">Tempat Lahir <span class="pull-end">:</span></h5>
                                        </div>
                                        <div class="col-sm-9 col-7"><span>{{ $member->tempat_lahir }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-5">
                                            <h5 class="f-w-500">Tanggal Lahir <span class="pull-end">:</span></h5>
                                        </div>
                                        <div class="col-sm-9 col-7"><span>{{ date('l, M-d-Y', strtotime($member->tanggal_lahir)) }}</span>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
