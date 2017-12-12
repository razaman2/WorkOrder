<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
	    factory(\App\Models\Company::class, 5)->create();

	    factory(\App\Models\User::class, 10)->make()->each(function($item){
		    $user = $item->toArray();
		    $user['password'] = 'secret';
		    $random_company = random_int(1, \App\Models\Company::all()->count());
		    \App\Models\Company::find($random_company)->users()->save(new \App\Models\User($user));
	    });
    }
}
