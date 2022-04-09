<?php

namespace App\Http\Controllers;

use App\Models\RouterosAPI;
use Illuminate\Http\Request;

class UseractiveController extends Controller
{
    public function index()
	{
		$ip = session()->get('ip');
		$user = session()->get('user');
		$password = session()->get('password');
		$API = new RouterosAPI();
		$API->debug = false;

		if($API->connect( $ip, $user, $password)){

			$useractive = $API->comm('/user/active/print');

			$data = [
				'menu' => 'User',
				'useractive' => $useractive,
				'totaluseractive' => count($useractive),
			];

            return view('useractive.index', $data);


		}else{

			return redirect('failed');
		}

	}



	public function useractive()
	{
		$ip = session()->get('ip');
		$user = session()->get('user');
		$password = session()->get('password');
		$API = new RouterosAPI();
		$API->debug = false;

		if($API->connect( $ip, $user, $password)){

			$useractive = $API->comm('/user/active/print');

			$data = [
				'useractive' => $useractive,
			];

            return view('realtime.useractive', $data);

		}else{

			return redirect('failed');
		}

	}
}
