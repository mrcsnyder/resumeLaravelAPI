<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function sendFromContact(SendContactEmailRequest $request){

        //sends to site owner
        \Mail::send('emails.contact',
            array(
                'user_message' => $request->get('message')
            ), function($message)
            {
                $message->from('resume@thisdudecodes.com', 'resume.thisdudecodes.com');
                $message->to('snyder.chris.m@gmail.com', 'resume.thisdudecode')->subject('Resume Contact!');


            });

        return response()->json(['success'=>true]);
    }
}
