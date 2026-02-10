<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    public function index()
    {
        $logs = ActivityLog::with('user')->latest()->get();
        return view('admin.activity.index', compact('logs'));
    }
}
