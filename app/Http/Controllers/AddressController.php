<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\TechPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses = Address::where('user_id','LIKE',Auth::user()->id)->get();
        return view('address.index',[
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
        return view('address.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $img = $request->file('img_path');
        $input = time().'-'.$img->getClientOriginalExtension();
        $des = public_path('/images/');
        $img->move($des,$input);

        $address = new Address();
        $address->user_id = Auth::user()->id;
        $address->place_name = $request->input('place_name');
        $address->receiver_name = $request->input('receiver_name');
        $address->house_no = $request->input('house_no');
        $address->address = $request->input('address');
        $address->province = $request->input('province');
        $address->postal = $request->input('postal');
        $address->save();

        return redirect()->route('user.index' );

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
        $address = Address::findOrFail($id);
        return view('address.edit', [
            'address' => $address
        ]);
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
        $address = Address::findOrFail($id);
        $address->place_name = $request->input('place_name');
        $address->receiver_name = $request->input('receiver_name');
        $address->house_no = $request->input('house_no');
        $address->address = $request->input('address');
        $address->province = $request->input('province');
        $address->postal = $request->input('postal');

        $address->save();
        return redirect()->route('user.index' );

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
