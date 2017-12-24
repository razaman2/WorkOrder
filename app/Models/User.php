<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    protected $fillable = ['first_name', 'last_name', 'username', 'password'];

    protected $hidden = ['password', 'remember_token'];

	public function setPasswordAttribute($value)
	{
		$this->attributes['password'] = bcrypt($value);
	}

	public function company()
	{
		return $this->belongsTo(Company::class);
	}

    public function addresses()
    {
    	return $this->morphMany(Address::class, 'addressable');
    }

    public function phones()
    {
    	return $this->morphMany(Phone::class, 'phoneable');
    }

    public function emails()
    {
    	return $this->morphMany(Email::class, 'emailable');
    }

    public function roles()
    {
    	return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function findForPassport($identifier)
    {
    	return User::orWhere('username', $identifier)
		    ->orWhereHas('emails', function($query) use ($identifier){
    		$query
			    ->where('type', 'Personal')
			    ->where('email', $identifier);
	    })->first();
    }
}
