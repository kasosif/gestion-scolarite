<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\Notification;

class NotifController extends Controller
{
    public function notifs() {

        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = auth('api')->user();

        if ($user->role == 'ROLE_ETUDIANT' || $user->role == 'ROLE_PROFESSEUR') {
            $notifsUnread = $user->unreadNotifications->count();
            $notifs = $user->notifications;
            return response()->json($notifs);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function allread() {
        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = auth('api')->user();

        if ($user->role == 'ROLE_ETUDIANT' || $user->role == 'ROLE_PROFESSEUR') {
            $user->unreadNotifications->markAsRead();
            return response()->json(['message' => 'success'], 200);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function delete($id) {
        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = auth('api')->user();
        if ($user->notifications->contains($id)){
            $notif = $user->notifications()->find($id);
            $notif->delete();
            return response()->json(['success'=> true]);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

    }
    public function deleteall() {
        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = auth('api')->user();
        $user->notifications()->delete();
        return response()->json(['success'=> true]);

    }
}
