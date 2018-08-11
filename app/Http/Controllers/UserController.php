<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    function ListUsers(Request $req){
        //Eloquent
        if($req->isJson()){
        $user = User::all();
        return response()->json($user, 200);
        }
        return response()->json(['error'=>'Unauthorized'], 401,[]);

    }

    function CreateUser(Request $req){
        //Eloquent
        if($req->isJson()){
         //Create user in DB
            $data = $req->json()->all();
            $user = User::create([
                'name'=> $data['name'],
                'username'=> $data['username'],
                'email'=> $data['email'],
                'password'=> Hash::make($data['password']),
                'api_token'=> str_random(60)
            ]);
        return response()->json($user, 201);
        }
        return response()->json(['error'=>'Unauthorized e'], 401,[]);
    }

    function SelectUser(Request $req){
        //Eloquent
        if($req->isJson()){
             $data = $req->json()->all();
            $user = User::where('email',$data['email'])->first();
            if ($user){
                return response()->json($user,200);
            }
        }
        return response()->json(['error'=>'Unauthorized'], 401,[]);
    }

    function AlterUser(Request $req){
        //Eloquent
        if($req->isJson()){
            //Alter user in DB
            try{
            $data = $req->json()->all();
            $user = User::find($data['id']);
                $user->name = $data['name'];
                $user->username =  $data['username'];
                $user->email =  $data['email'];
                $user->save();
            }
            catch (\Exception $e){
                return response()->json(['error'=>'Update did NOT work'], 401,[]);
            }
        return response()->json($user, 201);   
        }
        return response()->json(['error'=>'Unauthorized'], 401,[]);
    }

    function DeleteUser(Request $req){
        //Eloquent
        if($req->isJson()){
            //Alter user in DB
            try{
            $data = $req->json()->all();
            $user = User::find($data['id']);
            $user->delete();
            }
            catch (\Exception $e){
                return response()->json(['error'=>'Delete did NOT work'], 401,[]);
            }
        return response()->json('User deleted', 201);   
        }
        return response()->json(['error'=>'Unauthorized'], 401,[]);
    }

    function getToken(Request $req){
        if($req->isJson()){
            try{
                $data = $req->json()->all();
                $user = User::where('email', $data['email'])->first();

                if ($user && Hash::check($data['password'], $user->password)){
                    $user->api_token =  str_random(60);
                    $user->save();
                    return response()->json($user,200);
                }else{
                    return response()->json(['error1'=>'Check user and password'],406);
                }
            }
            catch(ModelNotFoundException $e){
                return response()->json(['error2'=>'No content'],406);
            }
        }
        return response()->json(['erro3r'=>'Unauthorized'], 401,[]);
    }
}
