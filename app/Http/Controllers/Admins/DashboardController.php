<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function Dashboard(Request $request)
    {
        // dd("Admins Dashboard");
        return view('page/admins/test/index',[
        ]);
    }
}
