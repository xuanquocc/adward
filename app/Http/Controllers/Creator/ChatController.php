<?php

namespace App\Http\Controllers\Creator;

use App\Events\MessageEvent;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function getContact() {
        $users = User::where('id', '!=', Auth::id())
            ->where('type', 'creator')->get();
    
        return response()->json($users);
    }
  
}
