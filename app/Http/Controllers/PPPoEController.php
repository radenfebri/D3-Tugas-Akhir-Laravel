<?php

namespace App\Http\Controllers;

use App\Models\RouterosAPI;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PPPoEController extends Controller
{
    public function secret()
	{
		$ip = session()->get('ip');
		$user = session()->get('user');
		$password = session()->get('password');
		$API = new RouterosAPI();
		$API->debug = false;

		if ($API->connect($ip, $user, $password)) {

			$secret = $API->comm('/ppp/secret/print');
			$profile = $API->comm('/ppp/profile/print');

			$data = [
				'menu' => 'PPPoE',
				'totalsecret' => count($secret),
				'secret' => $secret,
				'profile' => $profile,
			];

            // dd($data);
            return view('pppoe.secret', $data);

		}else{

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

			if($request['localaddress'] == '') {
				$localaddress = '0.0.0.0';
			} else {
				$localaddress = $request['localaddress'];
			}

			if($request['remoteaddress'] == '') {
				$remoteaddress = '0.0.0.0';
			} else {
				$remoteaddress = $request['remoteaddress'];
			}

			$API->comm('/ppp/secret/add', array(
				'name' => $request['user'],
				'password' => $request['password'],
				'service' => $request['service'],
				'profile' => $request['profile'],
				'local-address' => $localaddress,
				'remote-address' => $remoteaddress,
				'comment' => $request['comment'],
			));

            Alert::success('Success', 'Selamat anda Berhasil menambhakan secret PPPoE');
			return redirect('pppoe/secret');

		}else{

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

			$getuser = $API->comm('/ppp/secret/print', array(
				"?.id" => '*' . $id,
			));

			$secret = $API->comm('/ppp/secret/print');
			$profile = $API->comm('/ppp/profile/print');

			$data = [
				'user' => $getuser[0],
				'secret' => $secret,
                'profile' => $profile,
			];

            // dd($data);

            return view('pppoe.edit', $data);

		} else {

			return redirect('failed');
		}
	}



    public function update(Request $request)
	{
        if ($request(null, true)) {
            session()->post()->save();
        } else {

        }


		// $request = $this->input->post(null, true);
		$ip = session()->get('ip');
		$user = session()->get('user');
		$password = session()->get('password');
		$API = new RouterosAPI();
		$API->debug = false;

		$API->connect($ip, $user, $password);

		// PENGECUALIAN
		if($request['localaddress'] == '') {
			$localaddress = '0.0.0.0';
		} else {
			$localaddress = $request['localaddress'];
		}

		if($request['remoteaddress'] == '') {
			$remoteaddress = '0.0.0.0';
		} else {
			$remoteaddress = $request['remoteaddress'];
		}

        if($request['disabled'] == '') {
			$disabled = 'false';
		} else {
			$disabled = $request['disabled'];
		}

		$API->comm("/ppp/secret/set", array(
			".id" => $request['id'],
			'name' => $request['user'],
			'password' => $request['password'],
			'service' => $request['service'],
			'profile' => $request['profile'],
			'disabled' => $request['disabled'],
			'disabled' => $disabled,
			'local-address' => $localaddress,
			'remote-address' => $remoteaddress,
			'comment' => $request['comment'],
		));

        Alert::success('Success', 'Selamat anda Berhasil mengupdate secret PPPoE');
		return redirect('pppoe/secret');
	}



    public function delete($id)
	{
		$ip = session()->get('ip');
		$user = session()->get('user');
		$password = session()->get('password');
		$API = new RouterosAPI();
		$API->debug = false;

		if ($API->connect($ip, $user, $password)) {

			$API->comm('/ppp/secret/remove', array(
				'.id' => '*' . $id
			),);

            Alert::success('Success', 'Selamat anda Berhasil menghapus secret PPPoE');
			return redirect('pppoe/secret');

		}else{

            return redirect('failed');
		}

	}



    public function active()
	{
		$ip = session()->get('ip');
		$user = session()->get('user');
		$password = session()->get('password');
		$API = new RouterosAPI();
		$API->debug = false;

		if ($API->connect($ip, $user, $password)) {

			$secretactive = $API->comm('/ppp/active/print');

			$data = [
				'totalsecretactive' => count($secretactive),
				'active' => $secretactive,
			];

            return view('pppoe.active', $data);

		}else{

            return redirect('failed');
		}
	}
}

error_reporting(0);


