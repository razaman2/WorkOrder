<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class test extends TestCase
{
    public function testExample()
    {
    	\Illuminate\Support\Facades\Auth::login(\App\Models\User::find(11));

        $this->assertTrue(true);
    }
}
