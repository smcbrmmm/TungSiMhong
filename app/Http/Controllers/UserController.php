<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('id','=',Auth::user()->id)->get();
        $addresses = Address::where('user_id','=',Auth::user()->id)->get();
        return view('user.index' , [
            'user'  => $user,
            'addresses' => $addresses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('user.edit',[
            'user' => $user
        ]);
    }

    public function click(){
        return ['click_add'=> true];
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
        $request->validate([
            'name' => 'required|min:5',
            'email'=>'required|email',
            'tel' => 'required|regex:/[0][0-9]{9}/',
            'new_password' => 'nullable|min:8',
            'confirm_password' => ['same:new_password'],
            'accept_password' => ['required', function ($attribute, $value, $fail) {
                if (!\Hash::check($value, Auth::user()->password)) {
                    return $fail(__('The current password is incorrect.'));
                }
            }],
        ]);


        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->tel = $request->input('tel');
        $user->email = $request->input('email');


        if($request->input('new_password')==null && Hash::check($request->input('accept_password'),Auth::user()->password)){
            $user->save();
            return redirect()->route('user.index');
        }else{
            $user->password = Hash::make($request->input('new_password'));
            $user->save();
            return redirect()->route('user.index');
        }

//        if(Hash::check($request->input('accept_password'),$user->password)){
//            return redirect()->route('user.index' );
//        }




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
