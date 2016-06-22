<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\ContactSendRequest;
Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');


Route::get('/contact',['middleware'=>'auth',function(){
    return view('pages.contact');
}]);

// Normally I would have used a custom validator.

Route::post('/contact',['middleware'=>'auth',function(Request $request){
    $contact = App\Contact::where('user_id',Auth::user()->id)->where('id',$request->input('contact'))->first();
    if($contact){
        // user Owns the contact.
        Session::flash('message_sent', true);
    } else{
        //user does not own the contact.
        Session::flash('message_sent', false);
    }
    return redirect('/contact');
}]);


// ideally I would just group these in auth group..

Route::get('/contact/insert',['middleware'=>'auth', function(){
    return view('pages.insertcontact');
}]);

// ideally I would have had it's own controller...
Route::post('/contact/insert',['middleware'=>'auth', function(Request $request){
    App\Contact::create([
      'user_id'=>Auth::user()->id,
      'title'=>$request->input('title'),
      'email'=>$request->input('email')
    ]);
    return redirect('/contact');
}]);

Route::get('/contacts',['middleware'=>'auth', function(){
    // Normally I would set up a Request controller to validate, but I will skip that for now
    // And this would be a middleware instead of a simple return...
    try {

        if (! $user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }

    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

        return response()->json(['token_expired'], $e->getStatusCode());

    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

        return response()->json(['token_invalid'], $e->getStatusCode());

    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

        return response()->json(['token_absent'], $e->getStatusCode());

    }
    $contacts = $user->contacts;
    return response()->json(compact('contacts'));
}]);