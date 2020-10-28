<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

     //User
    public function userIndex($id = null)
    {
        $getUser = User::skip(1)->take(2)->get();
        if(!empty($id)){
            $editUser = User::find($id);
        }else{
            $editUser = '';
        }
        return view('admin.user.index', compact('getUser', 'editUser'));
    }

    public function userStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email:rfc,dns',
            'password' => 'min:4|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:4'
        ]);

        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->save();
        return redirect()->back()->with('success', 'Added Successfully');
    }

    public function userUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email:rfc,dns',
            'password' => 'min:4|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:4'
        ]);

        $data = User::find($request->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->save();
        return redirect()->back()->with('success', 'Edited Successfully');
    }

     public function userDestroy($id)
    {
        $data = User::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Deleted Successfully');
    }
}
