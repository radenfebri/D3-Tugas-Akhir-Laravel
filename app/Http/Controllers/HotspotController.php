<?php

namespace App\Http\Controllers;

use App\Models\RouterosAPI;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class HotspotController extends Controller
{
    public function users()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new RouterosAPI();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {

            $hotspotuser = $API->comm('/ip/hotspot/user/print');
            $server = $API->comm('/ip/hotspot/print');
            $profile = $API->comm('/ip/hotspot/user/profile/print');


            $data = [
                'totalhotspotuser' => count($hotspotuser),
                'hotspotuser' => $hotspotuser,
                'server' => $server,
                'profile' => $profile,
            ];

            return view('hotspot.user', $data);

        } else {

            return redirect('failed');
        }
    }



    public function add(Request $request)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new RouterosAPI();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {

            if ($request['timelimit'] == '') {
                $timelimit = '0';
            } else {
                $timelimit = $request['timelimit'];
            }

            $API->comm('/ip/hotspot/user/add', array(
                'name' => $request['user'],
                'password' => $request['password'],
                'server' => $request['server'],
                'profile' => $request['profile'],
                'limit-uptime' => $timelimit,
                'comment' => $request['comment'],
            ));

            Alert::success('Success', 'Selamat anda Berhasil menambhakan user Hotspot');
            return redirect('hotspot/users');

        } else {

            return redirect('failed');
        }
    }



    public function edit($id)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new RouterosAPI();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {

            $getuser = $API->comm('/ip/hotspot/user/print', array(
                "?.id" => '*' . $id,
            ));
            $server = $API->comm('/ip/hotspot/print');
            $profile = $API->comm('/ip/hotspot/user/profile/print');


            $data = [
                'menu' => 'Hotspot',
                'user' => $getuser[0],
                'server' => $server,
                'profile' => $profile,
            ];

            return view('hotspot.edit', $data);

        } else {

            return redirect('failed');
        }
    }




    public function update(Request $request)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new RouterosAPI();
        $API->debug = false;

        $API->connect($ip, $user, $password);

        // PENGECUALIAN
        if ($request['timelimit'] == "") {
            $timelimit = "0";
        } else {
            $timelimit = $request['timelimit'];
        }

        $API->comm("/ip/hotspot/user/set", array(
            ".id" => $request['id'],
            'name' => $request['user'],
            'password' => $request['password'],
            'server' => $request['server'],
            'profile' => $request['profile'],
            'disabled' => $request['disabled'],
            'limit-uptime' => $timelimit,
            'comment' => $request['comment'],
        ));

        Alert::success('Success', 'Selamat anda Berhasil mengupdate user Hotspot');
        return redirect('hotspot/users');
    }




    public function active()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new RouterosAPI();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {

            $hotspotactive = $API->comm('/ip/hotspot/active/print');

            $data = [
                'menu' => 'Hotspot',
                'totalhotspotactive' => count($hotspotactive),
                'hotspotactive' => $hotspotactive,
            ];

            return view('hotspot.active', $data);

        } else {

            return redirect('failed');
        }
    }
}

error_reporting(0);
