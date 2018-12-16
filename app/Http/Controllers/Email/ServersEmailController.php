<?php

namespace App\Http\Controllers\Email;

use App\Email\ServersDefined;
use App\Http\Controllers\Controller;
use App\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ServersEmailController extends Controller
{
    public function ship(Request $request)
    {
//        Nexmo::sendSMS(env('NEXMO_FROM_PHONE_NUMBER'), "This is a test SMS message");

//        return redirect('/admin/server')->with('msg', 'SMS message was sent successfully');

        $servers = Server::all();

        Mail::to($request->user())->send(new ServersDefined($servers));

        return redirect('/admin/server')->with('msg', 'Email was sent successfully');
    }
}
