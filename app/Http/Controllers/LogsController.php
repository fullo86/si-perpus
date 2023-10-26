<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class LogsController extends Controller
{
    public function index()
    {
        $rentlogs = Activity::with(['user', 'book'])->get();
        return view('v_logs/logs', ['listData' => $rentlogs]);
    }
}
