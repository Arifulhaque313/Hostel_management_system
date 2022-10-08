<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function index(){
        return Inertia::render('Frontend/Schedule',['schedule' => Schedule::paginate(9)]);
    }
}
