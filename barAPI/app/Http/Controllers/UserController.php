<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(User::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;
        $user->user_name = $request->input('user_name');
        $user->user_firstname = $request->input('user_firstname');
        $user->user_email = $request->input('user_email');
        $user->user_password = bcrypt($request->input('user_password'));
        $user->user_position = $request->input('user_position');
        if ($user->save()) {
            return response()->json($user, 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if(!$user)
            return response()->json(array('error' => true), 400);
        else {
            return response()->json($user, 200);
        }
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
        $user = User::find($id);

        if(!$user)
            return response()->json(array('error' => true), 400);
        else {

            if ($user->update($request->all())) {
                return response()->json($user, 200);
            }
            else {
                return response()->json(array('error' => true), 400);
            }
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
        $user = User::find($id);
        if(!$user)
            return response()->json(array('error' => true), 400);
        else {
            $user->delete();
            return response()->json(null, 204);
        }
    }

    // public function login($email, $password) {
    //     $user = User::find($email);
    //     if(!$user)
    //         return response()->json(array('error' => true), 400);
    //     else {
    //
    //     }
    // }
}
