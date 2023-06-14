@extends('layouts.datatable')
@section('title', 'Generate report')

@section('content')
<form autocomplete=off method="GET" action="{{ route('reports.submit') }}" target="_blank">
    @csrf
  <div class="row">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">Reporte</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 p-5 border rounded">
                        <div class="demo-inline-spacing">
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="document_type" id="radio_document_type_all" value="all" checked/>
                                <label class="form-check-label" for="radio_document_type_all">All files</label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="document_type" id="radio_document_type_dead" value="dead" />
                                <label class="form-check-label" for="radio_document_type_dead">Dead files</label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="document_type" id="radio_document_type_police" value="police" />
                                <label class="form-check-label" for="radio_document_type_police">Police files</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 p-5 border rounded">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="demo-inline-spacing">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="reports_date_type" id="radio_reports_date_type_daily" value="daily" checked/>
                                        <label class="form-check-label" for="radio_reports_date_type_daily">Daily</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="reports_date_type" id="radio_reports_date_type_monthly" value="monthly" />
                                        <label class="form-check-label" for="radio_reports_date_type_monthly">Monthly</label>
                                    </div>
                                </div>
                                <div class="pt-4 daily-fields">
                                    <input type="text" name="reports_date" id="reports_date" class="form-control flatpickr-input pick-date" placeholder="YYYY-MM-DD" id="reports_date" required readonly="readonly">
                                </div>
                                <div class="pt-4 row monthly-fields" style="display:none;">
                                    <div class="col-md-6">
                                        <select name="reports_month" id="reports_month" class="form-control">
                                            <option value="January" selected >January</option>
                                            <option value="February">February</option>
                                            <option value="March">March</option>
                                            <option value="April">April</option>
                                            <option value="May">May</option>
                                            <option value="June">June</option>
                                            <option value="July">July</option>
                                            <option value="Augast">Augast</option>
                                            <option value="September">September</option>
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <select name="reports_year" id="reports_year" class="form-control">
                                            <option value="2023" selected>2023</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 p-5 border rounded">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="demo-inline-spacing ">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="reports_document_type" id="radio_reports_all_documents" value="all_documents" checked/>
                                        <label class="form-check-label" for="radio_reports_all_documents">All</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="reports_document_type" id="radio_reports_department_wise" value="department_wise" />
                                        <label class="form-check-label" for="radio_reports_department_wise">Department Wise</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="reports_document_type" id="radio_reports_doctor_wise" value="doctor_wise" />
                                        <label class="form-check-label" for="radio_reports_doctor_wise">Doctor Wise</label>
                                    </div>
                                </div>
                                <div class="pt-4 department_wise-fields" style="display:none;">
                                    <select name="reports_department_id" id="reports_department_id" class="form-control">
                                        @foreach($departments as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="pt-4 doctor_wise-fields" style="display:none;">
                                    <select name="reports_doctor_id" id="reports_doctor_id" class="form-control">
                                        @foreach($doctors as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 px-5 py-3 border rounded text-center">
                        <button class="btn btn-primary w-100" type="submit">RUN REPORT</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>


@endsection


@section('script')
   <script>
        $('input[name="reports_date_type"]').change(function() {
            var selectedValue = $(this).val();

            // Show/hide input fields based on the selected value
            if (selectedValue === 'daily') {
                $('.daily-fields').show();
                $('.monthly-fields').hide();

                $('#reports_date').prop('required', true); 
                $('#reports_month').prop('required', false); 
                $('#reports_year').prop('required', false); 
            } else if (selectedValue === 'monthly') {
                $('.daily-fields').hide();
                $('.monthly-fields').show();

                $('#reports_date').prop('required', false); 
                $('#reports_month').prop('required', true); 
                $('#reports_year').prop('required', true); 
            }
        });

        $('input[name="reports_document_type"]').change(function() {
            var selectedValue = $(this).val();

            // Show/hide input fields based on the selected value
            if (selectedValue === 'department_wise') {
                $('.department_wise-fields').show();
                $('.doctor_wise-fields').hide();

                $('#reports_doctor_id').prop('required', false); 
                $('#reports_department_id').prop('required', true); 
            } else if (selectedValue === 'doctor_wise') {
                $('.department_wise-fields').hide();
                $('.doctor_wise-fields').show();

                $('#reports_doctor_id').prop('required', true); 
                $('#reports_department_id').prop('required', false); 
            } else if (selectedValue === 'all_documents') {
                $('.department_wise-fields').hide();
                $('.doctor_wise-fields').hide();

                $('#reports_doctor_id').prop('required', false); 
                $('#reports_department_id').prop('required', false); 
            }
        });

   </script>
@endsection