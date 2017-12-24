<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'username' => 'required|string|max:25',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(Request $request)
    {
    	$user = null;

    	DB::transaction(function() use ($request, &$user) {
    		$user = \App\Models\Company::first()->users()->save(new User(
    			collect($request->user)->only(['first_name','last_name','username','password'])->toArray()
		    ));

    		$user->emails()->saveMany(collect($request->user['emails'])->map(function($email) {
    			return new \App\Models\Email(
    				collect($email)->only(['type','email'])->toArray()
			    );
		    }));

		    $user->phones()->saveMany(collect($request->user['phones'])->map(function($phone) {
			    return new \App\Models\Phone(
			    	collect($phone)->only(['type','phone'])->toArray()
			    );
		    }));

		    $user->addresses()->saveMany(collect($request->user['addresses'])->map(function($address) {
			    return new \App\Models\Address(collect($address)->except('edit')->toArray());
		    }));

		    if(count($request->user['roles'])) {
			    $user->roles()->attach($request->user['roles']);
		    } else {
		    	$user->roles()->attach(\App\Models\Role::whereRole('user')->first());
		    }
	    });

	    return response()->json(User::with(['emails', 'phones', 'addresses', 'roles'])->find($user->{'id'}));
    }
}
