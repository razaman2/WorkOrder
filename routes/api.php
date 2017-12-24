<?php

	use App\Models\User;
	use Illuminate\Support\Facades\Auth;
	use Illuminate\Support\Facades\Route;

	/*
	|--------------------------------------------------------------------------
	| API Routes
	|--------------------------------------------------------------------------
	|
	| Here is where you can register API routes for your application. These
	| routes are loaded by the RouteServiceProvider within a group which
	| is assigned the "api" middleware group. Enjoy building your API!
	|
	*/

	Route::middleware('auth:api')->post('/user', function () {
		return response()->json(User::with(['emails','phones','addresses','roles','company'])->find(Auth::user()->{'id'}));
	});

	Route::post('/signup','Auth\RegisterController@create');

	Route::get('/user/{id?}', function($id = null) {
		if(!$id) {
			$users = User::all();
		} else {
			$users = User::whereid($id)->get();
		}
		return response()->json($users);
	});

	Route::get('/company/{id?}', function($id = null) {
		if(!$id) {
			$company = \App\Models\Company::all();
		} else {
			$company = \App\Models\Company::whereid($id)->get();
		}
		return response()->json($company);
	});

	Route::post('/user/password/update', function(\Illuminate\Http\Request $request) {
		return Auth::user()->update(['password'=>$request->password]);
	});

	Route::post('/user/username/update', function(\Illuminate\Http\Request $request) {
		return Auth::user()->update(['username'=>$request->username]);
	});
