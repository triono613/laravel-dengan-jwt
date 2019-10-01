<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tutorial;
use Illuminate\Http\Response;

class TutorialController extends Controller
{


    public function index(){
        return Tutorial::all();
    }

    public function show( $id ) {

        $tut =  Tutorial::find( $id );

        if( !$tut )
            return response()->json(['error' => 'tutorial tidak ditemukan'], 404);

            return $tut;

    }






    public function store(Request $request){

        $data = $request->all();
// dd($data);
        $this->validate($request ,[
            'title' =>  'required',
            'body' => 'required',
        ]);

       $tutorial = $request->user()->tutorials()->create([
            'title' => $data['title'],
            'slug' => str_slug($data['title']),
            'body' => ( $data['body'] ),
           // 'password' => $data['password'],
        ]);

        return $tutorial;

    }
}
