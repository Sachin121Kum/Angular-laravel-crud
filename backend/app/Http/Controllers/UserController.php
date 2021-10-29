<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use mysql_xdevapi\Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use App\User;



class UserController extends Controller
{
    public static function add(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'mobile' => 'required',

        ]);

        if($validator->fails()){
            return Response::json(['error' =>$validator->errors()->all()], status == 409);
        }

        $user = new User();
        $user->name->$request->name;
        $user->mobile->$request->mobile;
        $user->save();
        return Response::json(['message'=>'User Successfully Added']);



    }

    public static function update(Request $request){

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
            'mobile' => 'required',

        ]);

        if($validator->fails()){
            return Response::json(['error' =>$validator->errors()->all()], status == 409);
        }

        $user =User::find($request->id);
        $user->name->$request->name;
        $user->mobile->$request->mobile;
        $user->save();
        return Response::json(['message'=>'User Successfully Updated']);



    }

    public static function delete(Request $request){

        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if($validator->fails()){
            return Response::json(['error' =>$validator->errors()->all()], status == 409);
        }

        try{
            $user =User::where('id',$request->id)->delete();
            return Response::json(['message'=>'User Successfully Deleted']);
        }
        catch (exception $e){
            return Response::json(['error'=>['User Cannot Be Deleted']],409);
        }

    }

    public static function show(Request $request){

        session(['key' => $request->keywords]);
        $users = User::where(function($q){
            $value = session('key');
            $q->where('users.id','LIKE'.'%'.$value.'%')
            ->orwhere('users.name','LIKE'.'%'.$value.'%')
            ->orwhere('users.mobile','LIKE'.'%'.$value.'%');
        })->get();
        return Response::json(['users'=>$users]);



    }
}
