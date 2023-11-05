<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    use Notifiable;

    public function markSelectedAsRead(Request $request){
        
        $selectedIds = $request->input('selectedIds');
        // dd($selectedIds);
        auth()->user()->notifications()->whereIn('id', $selectedIds)->update(['read_at' => now()]);

        $url = route('notifications');

        return $response = [
            'message' => "Notification marked as read.",
            'url' => $url,
        ];
    }

    public function markAsRead(Request $request, $notification)
    {
        $notification = Auth::user()->notifications()->find($notification);

        if ($notification) {
            $notification->markAsRead();
        }

        if($request->route == '#'){
            return redirect()->back();
        }else{
            // Redirect the user to the specified route
            return redirect()->to($request->route);
        }
        
    }
}
