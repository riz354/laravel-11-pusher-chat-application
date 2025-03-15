<?php

namespace App\Http\Controllers;

use App\Events\MessageDeletedEvent;
use App\Events\MessageEvent;
use App\Events\UserStatusEvent;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {

        $data = [
            'LoggedUserInfo' => Auth::user(),
            'users' => User::whereNot('id',Auth::user()->id)->get(),
            
        ];
        return view('whatsup.index', $data);
    }

    public function saveChat(Request $request)
    {
        try {
            $chat = Chat::create([
                'sender_id' => $request->sender_id,
                'receiver_id' => $request->receiver_id,
                'message' => $request->message,
            ]);

            event(new MessageEvent($chat));
            return response()->json([
                'success' => true,
                'data'=>$chat
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function loadChats(Request $request)
    {
        try {
            $chats = Chat::where(function($q)use ($request){
                $q->where('sender_id',$request->sender_id)->orWhere('sender_id',$request->receiver_id);
            })->where(function($q2) use ($request){
                $q2->where('receiver_id',$request->sender_id)->orWhere('receiver_id',$request->receiver_id);
            })->get();

            // dd($chats);
            return response()->json([
                'success' => true,
                'data'=>$chats
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }



    public function deleteChat(Request $request)
    {
        try {
            $chats = Chat::where('id',$request->id)->delete();

            event(new MessageDeletedEvent($request->id));

            // dd($chats);
            return response()->json([
                'success' => true,
                'data'=>$chats
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }



}
