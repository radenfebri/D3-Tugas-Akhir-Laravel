<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\RouterosAPI;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function index()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new RouterosAPI();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {

            $hotspotactive = $API->comm('/ip/hotspot/active/print');
            $resource = $API->comm('/system/resource/print');
            $secret = $API->comm('/ppp/secret/print');
            $secretactive = $API->comm('/ppp/active/print');
            $interface = $API->comm('/interface/ethernet/print');
            $routerboard = $API->comm('/system/routerboard/print');
            $identity = $API->comm('/system/identity/print');


            $data = [
                'totalsecret' => count($secret),
                'totalhotspot' => count($hotspotactive),
                'hotspotactive' => count($hotspotactive),
                'secretactive' => count($secretactive),
                'cpu' => $resource[0]['cpu-load'],
                'uptime' => $resource[0]['uptime'],
                'version' => $resource[0]['version'],
                'interface' => $interface,
                'boardname' => $resource[0]['board-name'],
                'freememory' => $resource[0]['free-memory'],
                'freehdd' => $resource[0]['free-hdd-space'],
                'model' => $routerboard[0]['model'],
                'identity' => $identity[0]['name'],
            ];


            return view('dashboard', $data);
        } else {

            return redirect('failed');
        }
    }



    public function cpu()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new RouterosAPI();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {

            $cpu = $API->comm('/system/resource/print');

            $data = [
                'cpu' => $cpu['0']['cpu-load'],
            ];

            return view('realtime.cpu', $data);
        } else {

            return view('failed');
        }
    }



    public function uptime()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new RouterosAPI();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {

            $uptime = $API->comm('/system/resource/print');

            $data = [
                'uptime' => $uptime['0']['uptime'],
            ];

            return view('realtime.uptime', $data);
        } else {

            return view('failed');
        }
    }




    public function traffic($traffic)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new RouterosAPI();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {
            $traffic = $API->comm('/interface/monitor-traffic', array(
                'interface' => $traffic,
                'once' => '',
            ));

            $rx = $traffic[0]['rx-bits-per-second'];
            $tx = $traffic[0]['tx-bits-per-second'];

            $data = [
                'rx' => $rx,
                'tx' => $tx,
            ];

            // dd($data);

            return view('realtime.traffic', $data);
        } else {

            return view('failed');
        }
    }



    public function load()
    {
        $data = Report::orderBy('created_at', 'desc')->limit('2')->get();

        return view('realtime.load', compact('data'));
    }
}

error_reporting(0);
