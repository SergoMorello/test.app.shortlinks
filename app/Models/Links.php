<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
    use HasFactory;

	private static function hasKey($link) {
		$links = self::select('hash')->get();
		return is_numeric(array_search($link, array_column($links->toArray(), 'hash'))) ? true : false;
	}

	private static function genKey() {
		$key = '';
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

		for($step = 4;$step <= 50; $step++) {
			$pass = [];
			$alphaLength = strlen($alphabet) - 1;
			for ($i = 0; $i < $step; $i++) {
				$n = rand(0, $alphaLength);
				$pass[] = $alphabet[$n];
			}
			$key = implode($pass);
			if (self::hasKey($key))
				$key = '';
			else
				break;
		}
		return $key;
	}

	public static function createLink($link) {
		$newLink = new self;
		$newLink->hash = self::genKey();
		$newLink->link = $link;
		if ($newLink->save()) {
			return $newLink->hash;
		}
	}

	public static function getLink($hash) {
		return self::select('link')->where('hash', $hash)->first()->link ?? null;
	}
}
