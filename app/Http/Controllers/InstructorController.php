<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instructor;

class InstructorController extends Controller
{
    public function index()
    {
        $instructors = Instructor::orderBy('created_at', 'desc')->get();
        return view('instructors.index', compact('instructors'));
    }
}
