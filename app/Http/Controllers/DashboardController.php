<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Speciality;
use App\Models\Doctor;
use App\Models\Department;
use App\Models\Ward;

use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $file_count   = Document::all()->count();
        $speciality_count   = Speciality::all()->count();
        $doctor_count       = Doctor::all()->count();
        $department_count   = Department::all()->count();
        $ward_count         = Ward::all()->count();
        return view('dashboard', compact('file_count', 'speciality_count', 'doctor_count', 'department_count', 'ward_count'));
    }
}
