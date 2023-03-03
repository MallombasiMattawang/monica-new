<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Sekolah;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{

    public function welcome()
    {
      
        if (Auth::check()) {
            return redirect()->route('dashboard');
        } 
       
        return view('welcome');
    }

   
    public function info()
    {
        return phpinfo();
    }


    public function index()
    {
        $insight = FALSE;
        $pageTitle  = "Selamat Datang <br> ". getUser()->name;      
        $breadcrumb = [
            getUser()->name
        ];

       
        return view('pengguna.pages.dashboard.'.activeGuard().'.dashboard',
            compact('pageTitle','breadcrumb','insight')
        );
    }

    public function presensi()
    {
        $pageTitle  = "Presensi";
        $breadcrumb = [];

        return view('pages.dashboard._presensi',
            compact('pageTitle','breadcrumb')
        );
    }


    public function administrasi()
    {
        $pageTitle  = "Administrasi";
        $breadcrumb = [];

        return view('pages.dashboard._administrasi',
            compact('pageTitle','breadcrumb')
        );
    }

   

}
