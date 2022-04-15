<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index(){
        $list=array();
        $pirmas = 0;
        for($d=1; $d<=31; $d++)
        {
            $time=mktime(12, 0, 0, date('m'), $d, date('Y'));
            if (date('m', $time)==date('m'))
                $list[]=date('Y-m-d-D', $time);
        }

        return view('testMap', [
            'list' => $list,
            'pirmas' => $pirmas
        ]);
    }
}
