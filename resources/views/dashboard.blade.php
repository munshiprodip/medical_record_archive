@extends('layouts.datatable')
@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-xl-12 col-md-12 col-12 mb-4">
        <div class="card">
            <div class="card-body text-center">
                <h3 class="card-title mb-1 pt-2">Welcome back! "{{ auth()->user()->name }}"</h3>
                <h3 class="card-title mb-1 pt-2">Medical Record Archive</h3>
            </div>
        </div>
    </div>

    <div class="col-lg-12 mb-4">
        <div class="card">
            <div class="card-header pb-0 d-flex justify-content-between mb-lg-4">
                <div class="card-title mb-0">
                    <h5 class="mb-0">Total Files</h5>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-12 d-flex flex-column align-self-end">
                        <div class="d-flex gap-2 align-items-center mb-2 pb-1 flex-wrap">
                            <div class="badge rounded bg-label-info p-1"><i class="ti ti-users ti-xl"></i></div>
                            <h1 class="mb-0">{{ $file_count }}</h1>
                        </div>
                        <small class="text-muted">System over view</small>
                    </div>
                </div>
                <div class="border rounded p-3 mt-2">
                    <div class="row gap-4 gap-sm-0">
                        <div class="col-12 col-sm-3">
                            <div class="d-flex gap-2 align-items-center">
                                <div class="badge rounded bg-label-primary p-1"><i class="ti ti-user ti-sm"></i></div>
                                <h6 class="mb-0">Specialities</h6>
                            </div>
                            <h4 class="my-2 pt-1">{{ $speciality_count }}</h4>
                            <div class="progress w-75" style="height:4px">
                                <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3">
                            <div class="d-flex gap-2 align-items-center">
                                <div class="badge rounded bg-label-danger p-1"><i class="ti ti-user ti-sm"></i></div>
                                <h6 class="mb-0">Doctors</h6>
                            </div>
                            <h4 class="my-2 pt-1">{{ $doctor_count }}</h4>
                            <div class="progress w-75" style="height:4px">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3">
                            <div class="d-flex gap-2 align-items-center">
                                <div class="badge rounded bg-label-danger p-1"><i class="ti ti-user ti-sm"></i></div>
                                <h6 class="mb-0">Departments</h6>
                            </div>
                            <h4 class="my-2 pt-1">{{ $department_count }}</h4>
                            <div class="progress w-75" style="height:4px">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3">
                            <div class="d-flex gap-2 align-items-center">
                                <div class="badge rounded bg-label-danger p-1"><i class="ti ti-user ti-sm"></i></div>
                                <h6 class="mb-0">Wards</h6>
                            </div>
                            <h4 class="my-2 pt-1">{{ $ward_count }}</h4>
                            <div class="progress w-75" style="height:4px">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection