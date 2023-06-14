<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

use App\Models\Doctor;
use App\Models\Speciality;


class DoctorController extends Controller
{
    function __construct()
    {
        $this->middleware('role:Super Admin', ['only' => ['destroy']]);
    }
    // Display a listing of the resource & return response for ajax request.
    public function index(Request $request)
    {
        $specialities = Speciality::where('status', 1)->get();
        if($request->ajax()){
            $doctors = Doctor::where('id', '>', 0);
            return DataTables::of($doctors)
            ->addColumn('speciality', function($row){
                return $row->speciality->name;
            })
            ->addIndexColumn()->make(true);
        }
        return view('doctors.index', compact('specialities'));
    }

    // Store a newly created resource in storage & return json response
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'speciality_id'          => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success'   => false,
                'type'      => 'info',
                'title'     => 'Info!',
                'message'   => $validator->messages()->all()[0],
            ]);
        }

        $doctor = Doctor::create([
            'name' => $request->name,
            'speciality_id' => $request->speciality_id,
            'created_by' => auth()->id(),
        ]);

        if($doctor){
            return response()->json([
                'success'   => true,
                'type'      => 'success',
                'title'     => 'Success!',
                'message'   => 'Stored successfully',
            ]);
        }else{
            return response()->json([
                'success' => false,
                'type'    => 'error',
                'title'   => 'Error!',
                'message' => "Store failed",
            ]);
        }
        
    }

    //Find the specified resource in storage & return json response
    public function findById($id)
    {
        $doctor = Doctor::findOrFail($id);
        if($doctor){
            return response()->json([
                'success'       => true,
                'data'     => $doctor,
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
        $doctor = Doctor::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'speciality_id'          => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success'   => false,
                'type'      => 'info',
                'title'     => 'Info!',
                'message'   => $validator->messages()->all()[0],
            ]);
        }

        $doctor->name = $request->name;
        $doctor->speciality_id = $request->speciality_id;
        $doctor->save();
      
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
        $doctor = Doctor::findOrFail($id);
        $doctor->status = !$doctor->status;
        $doctor->save();
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
        Doctor::destroy($id);

        return response()->json([
            'success'   => true,
            'type'      => 'success',
            'title'     => 'Success!',
            'message' => "Removed successfully!!",
        ]);
    }
}
