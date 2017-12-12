<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Email extends Model
{
	use SoftDeletes;

	protected $guarded = [];

	public function emailable()
	{
		return $this->morphTo();
	}
}
