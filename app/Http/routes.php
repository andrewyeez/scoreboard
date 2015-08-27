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

/*

	For demonstration purposes, I have inserted all my backed codes in my routes file instead of 
	creating a controller.	

*/

//	This will route to your welcome page with data from the database, 
//	if not connected then you will be directed to a blank page with a message.
	
Route::get('/', function () {
	if( DB::table('scoreboard') ){
		$data = DB::table('scoreboard')->orderBy('rank','ASC')->get();
		return view('welcome')->with('data',$data);
	}
	return "Not connected to a database or cannot find scoreboard table!";
    
});

Route::post('/', function () {
	$data = Request::all();
	$table = DB::table('scoreboard')->orderBy('rank','ASC')->get();

	$newscore = Input::get('score');
	$newname = Input::get('name');
	$rankToReplace = null;

	if( isset($table) ){
		foreach( $table as $rows ){
			if( $newscore >= $rows->score ){
				$rankToReplace = $rows->rank;
				break;
			}
		}
	}

	if( isset($rankToReplace) ){

		DB::table('scoreboard')
			->where('rank','=', 10)
            ->update(
            	array(
            		'score' => 	$newscore,
            		'name' 	=>	$newname
            		)
            );

        DB::table('scoreboard')
        	->where('rank','>=',$rankToReplace)
        	->increment('rank', 1);

        DB::table('scoreboard')
        	->where('rank','=',11)
        	->update(
        		array(
        			'rank' => $rankToReplace
        			)
        		);

        $table = DB::table('scoreboard')->orderBy('rank','ASC')->get();

	}

	return Response::json( $table );
});
Route::get('/example' , function(){return view('example');});
