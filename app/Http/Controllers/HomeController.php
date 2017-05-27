<?php

namespace App\Http\Controllers;
use App\Series;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jumlah_series = Series::count();
        return view('admin/home', [
          'adm_title' => 'Dashboard',
          'jumlah_series' => $jumlah_series
        ]);
    }
}
