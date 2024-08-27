<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InstagramAuthController extends Controller
{

    public function show() {
        $profile = \Dymantic\InstagramFeed\Profile::find(1);

        return view('dashboard.admin.instagram.get-auth', ['instagram_auth_url' => $profile->getInstagramAuthUrl()]);
    }

    public function complete() {
        $was_successful = request('result') === 'success';

        return view('dashboard.admin.instagram.response', ['was_successful' => $was_successful]);
    }

    public function validateCredentials(Request $request){

       $code = $request->query('code');
       $state = $request->query('state');

       dd($code);
    }
}
