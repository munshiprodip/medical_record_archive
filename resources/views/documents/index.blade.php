@extends('layouts.datatable')
@section('title', 'Documents')

@section('content')
    <!-- Responsive Datatable -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="dt-responsive table" id="data_table" >
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>PATIENT'S NAME</th>
                        <th>HN</th>
                        <th>AN</th>
                        <th>DEPARTMENT</th>
                        <th>WARD</th>
                        <th>SPECIALITY</th>
                        <th>ADMITED UNDER</th>
                        <th>OPTIONS</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

        <!-- Add data Offcanvas -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="add_data_canvas" aria-labelledby="add_data_canvas_label">
            <div class="offcanvas-header pb-0">
                <h5 id="offcanvasEndLabel" class="offcanvas-title">NEW ENTRY</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body my-auto mx-0 flex-grow-0">
                <form id="add_data_form" method="POST" enctype="multipart/form-data" >
                    @csrf
                    <div class="mb-3">
                        <div class="demo-inline-spacing ">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="is_dead"
                                    id="checkbox_is_dead" value="1" />
                                <label class="form-check-label"
                                    for="checkbox_is_dead">Is Dead</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="is_police_case"
                                    id="checkbox_is_police_case" value="1" />
                                <label class="form-check-label"
                                    for="checkbox_is_police_case">Polic case</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input name="name" type="text" class="form-control" placeholder="Name"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Registration No.</label>
                        <input name="hn" type="text" class="form-control" placeholder="HN"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Admission No.</label>
                        <input name="an" type="text" class="form-control" placeholder="AN"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Department</label>
                        <select name="department_id" type="text" class="form-control">
                            @foreach($departments as $row)
                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ward</label>
                        <select name="ward_id" type="text" class="form-control">
                            @foreach($wards as $row)
                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                            @endforeach
                        </select>
                    </div>  
                    <div class="mb-3">
                        <label class="form-label">Doctor</label>
                        <select name="doctor_id" type="text" class="form-control">
                            @foreach($doctors as $row)
                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="formFile" class="form-label">File</label>
                        <input name="pdf_file" class="form-control" type="file" id="formFile">
                    </div>

                    

                    <button type="submit" class="btn btn-outline-primary">Save</button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                </form>
            </div>
        </div>

        <!-- Edit data Offcanvas -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="edit_data_canvas" aria-labelledby="edit_data_canvas_label">
            <div class="offcanvas-header pb-0">
                <h5 id="offcanvasEndLabel" class="offcanvas-title">EDIT DATA</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body my-auto mx-0 flex-grow-0">
                <form id="edit_data_form" >
                    @method('PATCH')
                    <div class="mb-3">
                        <div class="demo-inline-spacing ">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="is_dead"
                                    id="checkbox_is_dead" value="1" />
                                <label class="form-check-label"
                                    for="checkbox_is_dead">Is Dead</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="is_police_case"
                                    id="checkbox_is_police_case" value="1" />
                                <label class="form-check-label"
                                    for="checkbox_is_police_case">Polic case</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input name="name" type="text" class="form-control" placeholder="Name"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Registration No.</label>
                        <input name="hn" type="text" class="form-control" placeholder="HN"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Admission No.</label>
                        <input name="an" type="text" class="form-control" placeholder="AN"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Department</label>
                        <select name="department_id" type="text" class="form-control">
                            @foreach($departments as $row)
                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ward</label>
                        <select name="ward_id" type="text" class="form-control">
                            @foreach($wards as $row)
                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                            @endforeach
                        </select>
                    </div>  
                    <div class="mb-3">
                        <label class="form-label">Doctor</label>
                        <select name="doctor_id" type="text" class="form-control">
                            @foreach($doctors as $row)
                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input name="id" id="edit_data_id" type="hidden" />
                    <button type="submit" class="btn btn-outline-primary">Send</button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                </form>
            </div>
        </div>
    </div>
    <!--/ Responsive Datatable --> 
@endsection


@section('script')
    <script>
        let data_table          = $("#data_table");
        let add_data_canvas     = $("#add_data_canvas");
        let edit_data_canvas    = $("#edit_data_canvas");
        let add_data_form       = $("#add_data_form");
        let edit_data_form      = $("#edit_data_form");

        $(function(){
            data_table = data_table.DataTable({
                ajax: "{{ route('documents') }}",
                processing:true,
                serverSide:true,
                columns: [
                    {data: 'DT_RowIndex', searchable: false, orderable: false},
                    { data: "name" },
                    { data: "hn" },
                    { data: "an" },
                    { data: "department" },
                    { data: "ward" },
                    { data: "speciality" },
                    { data: "doctor" },
                    { data: (row) => {
                        
                            return `
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                    <div class="dropdown-menu">
                                    <a class="dropdown-item" target="_blank" href="http://192.168.11.29/${row.file_path}" ><i class="ti ti-eye me-1"></i> View</a>
                                    <a class="dropdown-item" href="javascript:void(0);" onclick="editData(${row.id})"><i class="ti ti-pencil me-1"></i> Edit</a>
                                    <a class="dropdown-item" href="javascript:void(0);" onclick="deleteData(${row.id})"><i class="ti ti-trash me-1"></i> Delete</a>
                                    </div>
                                </div>
                            `;
                        } 
                    },
                ],

                columnDefs: [
                    { 
                        'searchable'    : false, 
                        'targets'       : [2,3] 
                    },
                ],
                dom: '<"row mx-1"<"col-sm-12 col-md-3" l><"col-sm-12 col-md-9"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-md-end justify-content-center flex-wrap me-1"<"me-3"f>B>>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                buttons: [
                    {
                        text: "ADD NEW",
                        className: "add-new btn btn-primary btn-sm mb-3 mb-md-0",
                        attr: {
                            "onclick": "addData()",
                        },
                        init: function (e, a, t) {
                            $(a).removeClass("btn-secondary");
                        },
                    },
                    
                ],
                pageLength: 25,
                responsive: true,
            });

            
        });
        
        function addData(){
            add_data_form.trigger("reset");
            add_data_canvas.offcanvas('show');
        }

        

        function editData(id) {
            $.ajax({
                url: `{{ route('documents.find', ':id' ) }}`.replace(':id', id),
                type: "GET",
                success: function ( res ) {
                    if (res.success) {
                        edit_data_form.trigger("reset");
                        edit_data_canvas.offcanvas('show');
                        edit_data_form.find("input[name='is_dead']").prop('checked', res.data.is_dead);
                        edit_data_form.find("input[name='is_police_case']").prop('checked', res.data.is_police_case);
                        edit_data_form.find("input[name='name']").val(res.data.name);
                        edit_data_form.find("input[name='hn']").val(res.data.hn);
                        edit_data_form.find("input[name='an']").val(res.data.an);
                        edit_data_form.find("select[name='department_id']").val(res.data.department_id).trigger('change');
                        edit_data_form.find("select[name='ward_id']").val(res.data.ward_id).trigger('change');
                        edit_data_form.find("select[name='doctor_id']").val(res.data.doctor_id).trigger('change');
                        edit_data_form.find("#edit_data_id").val(res.data.id);
                    } else {
                        Swal.fire({
                            icon: res.type, // "success", "error", "warning", "info", "question"
                            title: res.title,
                            text: res.message,
                            timer: 1500,
                            showConfirmButton: !1,
                        });
                        
                    }
                },
                error: function (err) {
                    Swal.fire({
                        icon: 'warning', // "success", "error", "warning", "info", "question"
                        title: "Warning!",
                        text: 'Oops, something went wrong. Please try again.',
                        timer: 1500,
                        showConfirmButton: !1,
                    });
                },
            });
        }



        // submit add-new-data form
        add_data_form.on('submit', function(e) {
            if (!e.isDefaultPrevented()) {
               let formData = new FormData(this);
                $.ajax({
                    url: "{{ route('documents.store') }}",
                    type: "POST",
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if (data.success === true) {
                            add_data_form.trigger("reset");
                            add_data_canvas.offcanvas('hide')
                            data_table.ajax.reload();
                        } 

                        Swal.fire({
                            icon: data.type, // "success", "error", "warning", "info", "question"
                            title: data.title,
                            text: data.message,
                            timer: 1500,
                            showConfirmButton: !1,
                        });


                    },
                    error: function() {
                        Swal.fire({
                            icon: 'warning', // "success", "error", "warning", "info", "question"
                            title: "Warning!",
                            text: 'Oops, something went wrong. Please try again.',
                            timer: 1500,
                            showConfirmButton: !1,
                        });

                        add_data_form.trigger("reset");
                        add_data_canvas.offcanvas('hide')
                    }
                });
                return false;
            }
        });

        edit_data_form.on('submit', function(e) {
            if (!e.isDefaultPrevented()) {
                let id = $('#edit_data_id').val();
                $.ajax({
                    url: `{{ route('documents.update', ':id') }}`.replace(':id', id),
                    type: "POST",
                    data: edit_data_form.serialize(),

                    success: function(data) {
                        if (data.success === true) {
                            edit_data_form.trigger("reset");
                            edit_data_canvas.offcanvas('hide')
                            data_table.ajax.reload();
                        } 

                        Swal.fire({
                            icon: data.type, // "success", "error", "warning", "info", "question"
                            title: data.title,
                            text: data.message,
                            timer: 1500,
                            showConfirmButton: !1,
                        });


                    },
                    error: function() {
                        Swal.fire({
                            icon: 'warning', // "success", "error", "warning", "info", "question"
                            title: "Warning!",
                            text: 'Oops, something went wrong. Please try again.',
                            timer: 1500,
                            showConfirmButton: !1,
                        });

                        edit_data_form.trigger("reset");
                        edit_data_canvas.offcanvas('hide')
                    }
                });
                return false;
            }
        });

        function changeStatus(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "The status will be changed",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, confirm!",
                cancelButtonText: "No, cancel!",
                customClass: {
                    confirmButton: "btn btn-primary me-3",
                    cancelButton: "btn btn-label-secondary",
                },
            }).then(
                function (t) {
                if(t.value){
                    $.ajax({
                        url: `{{route('documents.change_status', ':id')}}`.replace(':id', id),
                        type: 'GET',
                        success: function(data) {
                            if (data.success === true) {
                                data_table.ajax.reload();
                            } 

                            Swal.fire({
                                icon: data.type, // "success", "error", "warning", "info", "question"
                                title: data.title,
                                text: data.message,
                                timer: 1500,
                                showConfirmButton: !1,
                            });


                        },
                        error: function() {
                            Swal.fire({
                                icon: 'warning', // "success", "error", "warning", "info", "question"
                                title: "Warning!",
                                text: 'Oops, something went wrong. Please try again.',
                                timer: 1500,
                                showConfirmButton: !1,
                            });
                        }
                    });
                }
            });
        }


        function deleteData(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                customClass: {
                    confirmButton: "btn btn-primary me-3",
                    cancelButton: "btn btn-label-secondary",
                },
            }).then(
                function (t) {
                if(t.value){
                    $.ajax({
                        url: `{{route('documents.destroy', ':id')}}`.replace(':id', id),
                        type: 'POST',
                        data: {'_method': 'DELETE',},
                        success: function(data) {
                            if (data.success === true) {
                                data_table.ajax.reload();
                            } 

                            Swal.fire({
                                icon: data.type, // "success", "error", "warning", "info", "question"
                                title: data.title,
                                text: data.message,
                                timer: 1500,
                                showConfirmButton: !1,
                            });


                        },
                        error: function() {
                            Swal.fire({
                                icon: 'warning', // "success", "error", "warning", "info", "question"
                                title: "Warning!",
                                text: 'Oops, something went wrong. Please try again.',
                                timer: 1500,
                                showConfirmButton: !1,
                            });
                        }
                    });
                }
            });
        }

        
    </script>
@endsection