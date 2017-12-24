<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phone extends Model
{
	use SoftDeletes;

	protected $guarded = [];

	protected $hidden = ['phoneable_id', 'phoneable_type'];

	public function phoneable()
	{
		return $this->morphTo();
	}
}
