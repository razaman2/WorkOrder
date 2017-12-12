<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
	use SoftDeletes;

	protected $guarded = [];

	public function users()
	{
		return $this->hasMany(User::class);
	}

	public function emails()
	{
		return $this->morphMany(Email::class, 'emailable');
	}

	public function phones()
	{
		return $this->morphMany(Phone::class, 'phoneable');
	}

	public function addresses()
	{
		return $this->morphMany(Address::class, 'addressable');
	}
}
