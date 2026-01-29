<?php

namespace App\Http\Controllers;

use App\Models\Institute;
use App\Models\Trade;
use App\Models\Course;
use App\Models\Student;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'institutesCount' => Institute::count(),
            'tradesCount'     => Trade::count(),
            'coursesCount'    => Course::count(),
            'studentsCount'   => Student::count(),

            'activeStudents'  => Student::where('status', 'active')->count(),
            'inactiveStudents'=> Student::where('status', 'inactive')->count(),
        ]);
    }
}


