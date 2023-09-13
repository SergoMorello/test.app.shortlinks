<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Links;

class MainController extends Controller
{
    public function home() {
		return view('home');
	}
	
	public function createLink(Request $req) {
		$req->validate([
			'value' => 'required'
		]);
		$hash = Links::createLink($req->value);
		return [
			'hash' => $hash,
			'link' => route('get-link',[$hash])
		];
	}

	public function getLink(Request $req) {
		$hash = $req->route('hash');
		return response()->redirectTo(Links::getLink($hash));
	}
}
