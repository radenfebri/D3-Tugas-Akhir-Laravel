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

			$API->comm('/ppp/secret/add', [
				'name' => $request['user'],
				'password' => $request['password'],
				'service' => $request['service'] == '' ? 'any' : $request['service'],
				'profile' => $request['profile'] == '' ? 'default' : $request['profile'],
				'local-address' => $request['localaddress'] == '' ? '0.0.0.0' : $request['localaddress'],
				'remote-address' => $request['remoteaddress'] == '' ? '0.0.0.0' : $request['remoteaddress'],
				'comment' => $request['comment'] == '' ? '' : $request['comment'],
			]);

			// dd($request->all());

			Alert::success('Success', 'Selamat anda Berhasil menambhakan secret PPPoE');
			return redirect('pppoe/secret');
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

			$getuser = $API->comm('/ppp/secret/print', [
				"?.id" => '*' . $id,
			]);

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

		$ip = session()->get('ip');
		$user = session()->get('user');
		$password = session()->get('password');
		$API = new RouterosAPI();
		$API->debug = false;

		$API->connect($ip, $user, $password);

		$API->comm("/ppp/secret/set", [
			".id" => $request['id'],
			'name' => $request['user'] == '' ? $request['user'] : $request['user'],
			'password' => $request['password'] == '' ? $request['password'] : $request['password'],
			'service' => $request['service'] == '' ? $request['service'] : $request['service'],
			'profile' => $request['profile'] == '' ? $request['profile'] : $request['profile'],
			'disabled' => $request['disabled'] == '' ? $request['disabled'] : $request['disabled'],
			'local-address' => $request['localaddress'] == '' ? $request['localaddress'] : $request['localaddress'],
			'remote-address' => $request['remoteaddress'] == '' ? $request['remoteaddress'] : $request['remoteaddress'],
			'comment' => $request['comment'] == '' ? $request['comment'] : $request['comment'],
		]);


		Alert::success('Success', 'Selamat anda Berhasil mengupdate secret PPPoE');
		return redirect()->route('pppoe.secret');
	}

	public function delete($id)
	{
		$ip = session()->get('ip');
		$user = session()->get('user');
		$password = session()->get('password');
		$API = new RouterosAPI();
		$API->debug = false;

		if ($API->connect($ip, $user, $password)) {

			$API->comm('/ppp/secret/remove', [
				'.id' => '*' . $id
			],);

			Alert::success('Success', 'Selamat anda Berhasil menghapus secret PPPoE');
			return redirect('pppoe/secret');
		} else {

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
		} else {

			return redirect('failed');
		}
	}
}

// error_reporting(0);
