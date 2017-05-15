<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Collective\Html\Eloquent\FormAccessible;

class CheckBkController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $base_path = base_path();
        $data['hospcode'] = DB::table('chospital_amp')->select('hoscode','hosname','fname')->get();

        $months = array (1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'May',6=>'Jun',7=>'Jul',8=>'Aug',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dec');
        $m4 = date('m', strtotime("-1 months"));
        $m3 = date('m', strtotime("-2 months"));
        $m2 = date('m', strtotime("-3 months"));
        $m1 = date('m', strtotime("-4 months"));
        $month_name4 = $months[(int)$m4];
        $month_name3 = $months[(int)$m3];
        $month_name2 = $months[(int)$m2];
        $month_name1 = $months[(int)$m1];

        $data['fold_name4'] = 'D:\JHCIS Back UP\Backup FY 2560\\'.date('m', strtotime("-1 months")).date('Y').$month_name4;
        $data['fold_name3'] = 'D:\JHCIS Back UP\Backup FY 2560\\'.date('m', strtotime("-2 months")).date('Y').$month_name3;
        $data['fold_name2'] = 'D:\JHCIS Back UP\Backup FY 2560\\'.date('m', strtotime("-3 months")).date('Y').$month_name2;
        $data['fold_name1'] = 'D:\JHCIS Back UP\Backup FY 2560\\'.date('m', strtotime("-4 months")).date('Y').$month_name1;


        $files = scandir($data['fold_name3'].'\\10589_Sorkreaka');
        $filesName = max($files);
        //$data['dir'] = "D:\JHCIS Back UP\Backup FY 2560".$fold_name;
        //dd($filesName);

        return view('check_backup/index', $data);
    }
}
