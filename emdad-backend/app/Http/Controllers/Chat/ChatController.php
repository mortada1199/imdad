<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Services\ChatService;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    
    public function establishaChat(Request $request,ChatService $chatService)
    {
        # code...
        $chatService->establishaChat($request);
    }
}
