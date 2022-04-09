<?php

namespace App\Models;
namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

use function Symfony\Component\String\b;

class ReportController extends Controller
{
    public function index()
    {
        return view('report.traffic-up');
    }



    public function search(Request $request)
    {
        $tgl_awal = $request->tgl_awal;
        $tgl_akhir = $request->tgl_akhir;

        $data = Report::orderBy('created_at','desc')->where('created_at','>=',$tgl_awal. ' 00:00:00')->where('created_at','<=',$tgl_akhir. '23:59:59')->get();

        $view_tgl = "List data Mulai tanggal: $tgl_awal, Sampai tanggal: $tgl_akhir";


        return view('report.search-traffic',compact('data', 'view_tgl'));
    }


    public function load()
    {
        $data = Report::orderBy('created_at','desc')->limit('20')->get();

        return view('realtime.load', compact('data'));
    }



    public function up(){

        $post = new Report();
        $post->text = 'Traffic Internet Melebihi Dari 50 Mbps';
        $post->save();

        return response()->json($post, 200);
    }



    public function down(){

        $post = new Report();
        $post->text = 'Traffic Internet Stabil, Kurang Dari 50 Mbps';
        $post->save();

        return response()->json($post, 200);
    }
}
