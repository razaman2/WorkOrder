<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class test extends TestCase
{
    public function testExample()
    {
//    	\Illuminate\Support\Facades\Auth::login(\App\Models\User::find(10));

	    dump(\App\Models\User::all());

//	    dump($this->post('/signup'));

        $this->assertTrue(true);
    }
}
