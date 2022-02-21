<?php

namespace App\Http\Controllers;

use App\Message;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatsController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }
    
    /**
     * Show chats
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('chat');
    }
    
    /**
     * Fetch all messages
     *
     * @return Message
     */
    public function fetchMessages()
    {
      return Message::with('user')->get();
    }
    
    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return Response
     */
    public function sendMessage(Request $request)
    {
      $user = Auth::user();
    
      $message = $user->messages()->create([
<<<<<<< HEAD
        'message' => $request->input('message')
=======
        'messages' => $request->input('messages')
>>>>>>> 09bf3e838aa2e1061a51813c59c27e88e6a00ccc
      ]);
    
      broadcast(new MessageSent($user, $message))->toOthers();
    
      return ['status' => 'Message Sent!'];
    }
}
