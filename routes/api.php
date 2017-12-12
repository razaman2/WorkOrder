<?php

	use App\Models\User;
	use Illuminate\Http\Request;
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

Route::middleware('auth:api')->post('/user', function (Request $request) {
	return response()->json(\App\Models\User::with('company')->find(Auth::user()->{'id'}));
//	return response()->json(User::with(['emails', 'phones', 'addresses'])->find($request->{'id'}));
});

Route::middleware('role')->post('/signup','Auth\RegisterController@create');

Route::middleware('auth:api')->post('/test',function(Request $request){
	return response()->json(\App\Models\User::with('company')->find(Auth::user()->{'id'}));
});
