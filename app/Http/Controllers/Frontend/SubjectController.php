<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function index(){
        return Inertia::render('Frontend/Subject',['subjects'=>Subject::paginate(9)]);
    }
}
