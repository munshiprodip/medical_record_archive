<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Storage;
use App\Models\Document;
use App\Models\Doctor;
use App\Models\Department;
use App\Models\Ward;
class DocumentController extends Controller
{
    function __construct()
    {
        $this->middleware('role:Super Admin', ['only' => ['destroy']]);
    }
    // Display a listing of the resource & return response for ajax request.
    public function index(Request $request)
    {
        $doctors        = Doctor::where('status', 1)->get();
        $departments    = Department::where('status', 1)->get();
        $wards          = Ward::where('status', 1)->get();
        if($request->ajax()){
            $documents = Document::where('id', '>', 0);
            return DataTables::of($documents)
            ->addColumn('doctor', function($row){
                return $row->doctor->name;
            })
            ->addColumn('department', function($row){
                return $row->department->name;
            })
            ->addColumn('ward', function($row){
                return $row->ward->name;
            })
            ->addColumn('speciality', function($row){
                return $row->doctor->speciality->name;
            })
            ->addIndexColumn()->make(true);
        }
        return view('documents.index', compact('doctors', 'departments', 'wards'));
    }

    public function isDead(Request $request)
    {
        $doctors        = Doctor::where('status', 1)->get();
        $departments    = Department::where('status', 1)->get();
        $wards          = Ward::where('status', 1)->get();
        if($request->ajax()){
            $documents = Document::where('is_dead', 1);
            return DataTables::of($documents)
            ->addColumn('doctor', function($row){
                return $row->doctor->name;
            })
            ->addColumn('department', function($row){
                return $row->department->name;
            })
            ->addColumn('ward', function($row){
                return $row->ward->name;
            })
            ->addColumn('speciality', function($row){
                return $row->doctor->speciality->name;
            })
            ->addIndexColumn()->make(true);
        }
        return view('documents.is_dead', compact('doctors', 'departments', 'wards'));
    }

    public function isPoliceCase(Request $request)
    {
        $doctors        = Doctor::where('status', 1)->get();
        $departments    = Department::where('status', 1)->get();
        $wards          = Ward::where('status', 1)->get();
        if($request->ajax()){
            $documents = Document::where('is_police_case', 1);
            return DataTables::of($documents)
            ->addColumn('doctor', function($row){
                return $row->doctor->name;
            })
            ->addColumn('department', function($row){
                return $row->department->name;
            })
            ->addColumn('ward', function($row){
                return $row->ward->name;
            })
            ->addColumn('speciality', function($row){
                return $row->doctor->speciality->name;
            })
            ->addIndexColumn()->make(true);
        }
        return view('documents.is_police_case', compact('doctors', 'departments', 'wards'));
    }

    // Store a newly created resource in storage & return json response
    public function store(Request $request)
    {

        $inputs = $request->all();
        $validator = Validator::make($inputs, [
            'name'                 => ['required'],
            'hn'                   => ['required'],
            'an'                   => ['required'],
            'department_id'         => ['required'],
            'doctor_id'             => ['required'],
            'ward_id'               => ['required'],

            'pdf_file'             => 'required|mimes:pdf|max:10240',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'success'   => false,
                'type'      => 'info',
                'title'     => 'Info!',
                'message'   => $validator->messages()->all()[0],
            ]);
        }

        $patientFile = new Document;



        if($request->file('pdf_file')) {
            $fileName = 'patients_files/'.time().'_'.$request->file('pdf_file')->getClientOriginalName();
            $success = Storage::disk('ftp')->put($fileName, file_get_contents($request->file('pdf_file')));

            if (!$success) {
                return response()->json([
                    'success' => false,
                    'type'    => 'error',
                    'title'   => 'Error!',
                    'message' => "FTP Server error",
                ]);
            }

            $patientFile->name                  = $inputs['name'];
            $patientFile->hn                    = $inputs['hn'];
            $patientFile->an                    = $inputs['an'];
            $patientFile->department_id         = $inputs['department_id'];
            $patientFile->doctor_id             = $inputs['doctor_id'];
            $patientFile->ward_id               = $inputs['ward_id'];

            $patientFile->is_police_case        = $request->is_police_case? $request->is_police_case : "0";
            $patientFile->is_dead               = $request->is_dead? $request->is_dead : "0";
            $patientFile->created_by            = auth()->user()->id;

            $patientFile->file_path     =  $fileName;

            $patientFile->save();

            return response()->json([
                'success'   => true,
                'type'      => 'success',
                'title'     => 'Success!',
                'message'   => 'Stored successfully',
            ]);
        }

        return response()->json([
            'success' => false,
            'type'    => 'error',
            'title'   => 'Error!',
            'message' => "Store failed",
        ]);
  
    }

    //Find the specified resource in storage & return json response
    public function findById($id)
    {
        $document = Document::findOrFail($id);
        if($document){
            return response()->json([
                'success'       => true,
                'data'     => $document,
            ]);
        }else{
            return response()->json([
                'success' => false,
                'type'    => 'error',
                'title'   => 'Error!',
                'message' => "Data not found.",
            ]);
        }
    }

    //Update the specified resource in storage & return json response
    public function update(Request $request, $id)
    {
        $inputs = $request->all();
        $patientFile = Document::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name'                 => ['required'],
            'hn'                   => ['required'],
            'an'                   => ['required'],
            'department_id'         => ['required'],
            'doctor_id'             => ['required'],
            'ward_id'               => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success'   => false,
                'type'      => 'info',
                'title'     => 'Info!',
                'message'   => $validator->messages()->all()[0],
            ]);
        }

        $patientFile->name                  = $inputs['name'];
        $patientFile->hn                    = $inputs['hn'];
        $patientFile->an                    = $inputs['an'];
        $patientFile->department_id         = $inputs['department_id'];
        $patientFile->doctor_id             = $inputs['doctor_id'];
        $patientFile->ward_id               = $inputs['ward_id'];

        $patientFile->is_police_case        = $request->is_police_case? $request->is_police_case : "0";
        $patientFile->is_dead               = $request->is_dead? $request->is_dead : "0";

        $patientFile->save();
      
        return response()->json([
            'success'   => true,
            'type'      => 'success',
            'title'     => 'Success!',
            'message'   => 'Updated successfully',
        ]);
        
    }

    //Change the current status of specified resource from storage & return json response.
    public function changeStatus($id)
    {
        $document = Document::findOrFail($id);
        $document->status = !$document->status;
        $document->save();
        return response()->json([
            'success'   => true,
            'type'      => 'success',
            'title'     => 'Success!',
            'message' => 'Status changed successfully'
        ]);
    }

    //Remove the specified resource from storage & return json response.
    public function destroy($id)
    {
        $document = Document::findOrFail($id);
        $success = Storage::disk('ftp')->delete($document->file_path);

        if ($success) {
            Document::destroy($id);

            return response()->json([
                'success'   => true,
                'type'      => 'success',
                'title'     => 'Success!',
                'message' => "Removed successfully!!",
            ]);
        } else {
            return response()->json([
                'success'   => true,
                'type'      => 'success',
                'title'     => 'Success!',
                'message' => "Failed to delete, try again after sometime!!",
            ]);
        }
    }
}
