<?php
namespace App\Extensions\Auth;

use Illuminate\Contracts\Hashing\Hasher;

class PlainHasher implements Hasher
{
	public function make($value, array $options = [])
	{
		// Return the password as-is (not hashed)
		return $value;
	}

	public function check($value, $hashedValue, array $options = [])
	{
		// Simply compare the plain-text passwords
		return $value === $hashedValue;
	}

	public function needsRehash($hashedValue, array $options = [])
	{
		// No rehashing needed for plain text passwords
		return false;
	}

	public function info($hashedValue)
	{
		return [
			'algo' => 'none',
			'algoName' => 'Plain Text',
			'options' => [],
		];
	}
}
