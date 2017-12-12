<?php

namespace Tests\Unit;

use App\Models\Company;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Eloquent extends TestCase
{
    public function testExample()
    {
    	$phones = [
		    ['type'=>'super', 'phone'=>'1112223333'],
		    ['type'=>'super', 'phone'=>'1112223333'],
		    ['type'=>'super', 'phone'=>'1112223333'],
		    ['type'=>'super', 'phone'=>'1112223333'],
		    ['type'=>'super', 'phone'=>'1112223333'],
		    ['type'=>'super', 'phone'=>'1112223333'],
		    ['type'=>'super', 'phone'=>'1112223333'],
		    ['type'=>'admin', 'phone'=>'5558889999'],
	    ];

	    $phones = collect($phones)->map(function($item){
		    return new \App\Models\Phone($item);
	    });

    	dump(User::create([
    		'first_name'=>'Miyosha',
    		'last_name'=>'Sparkes',
    		'login'=>str_random(19),
    		'email'=>'diamondgyal16@gmail.com',
    		'password'=>'lavtwu16',
	    ])->phones()->saveMany($phones));

        $this->assertTrue(true);
    }

    public function testCreateCompany()
    {
//    	dump(factory(\App\Models\Address::class, 50)->make()->each(function($item){
//    		$user_count = User::all()->count();
//    		$random_user = rand(1, $user_count);
//
//    		dump(User::find($random_user)->addresses()->save(new \App\Models\Address($item->toArray())));
//	    }));

	    factory(\App\Models\Company::class, 5)->create();

	    factory(\App\Models\User::class, 10)->make()->each(function($item){
	    	$user = $item->toArray();
	    	$user['password'] = 'secret';
		    $random_company = random_int(1, \App\Models\Company::all()->count());
		    \App\Models\Company::find($random_company)->users()->save(new \App\Models\User($user));
	    });

	    $this->assertTrue(true);
    }
}
