<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Input;
use Redirect;
use Validator;
use App\User;

class UserSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        old('name', Auth::user()->name);

        return view('settings', array("name" => Auth::user()->name));
    }

    public function settingsSave(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:255',
                'password' => 'same:password_confirmation',
                'password_confirmation' => 'required_with:password',
            ]);

        if ($validator->fails()) {
            return Redirect::route('settings')->withErrors($validator)->withInput();
        }

        $name = $request->input('name');
        $password = $request->input('password');

        if ($password != "") {
            if (strlen($password) < 8) {
                $validator->errors()->add('password', 'Password must be at least 8 characters');
            }
        }

        try {
            $user = User::find(Auth::user()->id);
        } catch (Illuminate\Database\QueryException $ex) {
            $request->session()->flash('error', $ex->getMessage());
            return back()->withInput();
        } catch (\PDOException $pdoEx) {
            $request->session()->flash('error', $pdoEx->getMessage());
            return back()->withInput();
        }

        $user->name = $name;

        if ($password != "") {
            $user->password = bcrypt($password);
        }

        try {
            $user->save();
        } catch (Illuminate\Database\QueryException $ex) {
            $request->session()->flash('error', $ex->getMessage());
            return back()->withInput();
        } catch (\PDOException $pdoEx) {
            $request->session()->flash('error', $pdoEx->getMessage());
            return back()->withInput();
        }

        $request->session()->flash('message', "User settings have been saved successfully");

        return Redirect::route('home');
    }
}
