<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Sekolah;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TranSupervisi;
use Illuminate\Support\Facades\DB;
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
        $pageTitle  = "Selamat Datang <br> " . getUser()->name;
        $breadcrumb = [
            getUser()->name
        ];

        $user_id =  getUser()->id;
        if (activeGuard() == 'waspang') {
            $user = "waspang_id = $user_id ";
        } else if (activeGuard() == 'tim-ut') {
            $user = "tim_ut_id = $user_id ";
        } else {
            $user = "mitra_id = $user_id ";
        }

        $count_project = DB::table('mst_project')
            ->select(
                DB::raw('COUNT(CASE WHEN mitra_id = "' . getUser()->username . '"  THEN id END) AS project')
            )
            ->first();
        $count_supervisi = TranSupervisi::whereRaw("$user")
            ->count();


        return view(
            'pengguna.pages.dashboard.' . activeGuard() . '.dashboard',
            compact('pageTitle', 'breadcrumb', 'count_project', 'count_supervisi', 'insight')
        );
    }
}
