<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Training;
use App\Models\skill;
use App\Models\category;

class CityController extends Controller
{
    //
    public function index()
    {
        // $cities = auth()->user()->posts;
 
        // return response()->json([
        //     'success' => true,
        //     'data' => $cities
        // ]);

         $cities = City::all();
        return response([ 'cities' =>  $cities, 
        'message' => 'Successful'], 200);
    }
    public function store(Request $request)
    {
        //$request['user_id']=Auth()->user()->id;
        $request->validate([
            'name'=>'required',
             ]);
        $input=$request->all();

       
        $event=City::create($input);
        return response()->json([
            'message' => 'Successfully created City!' ], 201);  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (City::where('id', $id)->exists()) {
            $City = City::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($City, 200);
          } else {
            return response()->json([
              "message" => "City not found"
            ], 404);
          }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (City::where('id', $id)->exists()) {
            $City = City::find($id);
    
            $City->name = is_null($request->name) ? $City->name : $request->name;
           
            $City->save();
    
            return response()->json([
              "message" => "records updated successfully".$request->name
            ], 200);
          } else {
            return response()->json([
              "message" => "City not found"
            ], 404);
          }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(City::where('id', $id)->exists()) {
            $City = City::find($id);
            $City->delete();
    
            return response()->json([
              "message" => "records deleted"
            ], 202);
          } else {
            return response()->json([
              "message" => "City not found"
            ], 404);
          }
    }
}

