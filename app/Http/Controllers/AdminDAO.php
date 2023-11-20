<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AdminDAO extends Controller
{
    public function storeAnnouncement(Request $request){

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required'],
        ],[
            'title.required' => 'Please fill in the title.',
            'body.required' => 'Please fill in the body.',
        ]);

        if($request->status_id == 'on'){
            $status_id = 2;
        }else{
            $status_id = 3;
        }

        $data = [
            'title' => $request->title,
            'body' => $request->body,
            'status_id' => $status_id,
            'created_by' => $request->user_id,
        ];

        $announcement = Announcement::create($data);

        if($announcement){
            return $respones = [
                'message' => 'Announcement saved successfully.',
            ];
        }else{
            return $respones = [
                'message' => 'Something went wrong.',
            ];
        }
    }

    public function ckeditorUpload(Request $request){

        if ($request->hasFile('upload')) {
            
            $announcement = new Announcement();
            $announcement->id = 0;
            $announcement->exists = true;
            $image = $announcement->addMediaFromRequest(key:'upload')->toMediaCollection(collectionName:'images');

            return response()->json([
                'url' => $image->getUrl(),
            ]);

        }
    }

    public function updateAnnouncement(Request $request){

        $announcement_id = $request->announcement_id;

        $announcement = Announcement::find($announcement_id);

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required'],
        ],[
            'title.required' => 'Please fill in the title.',
            'body.required' => 'Please fill in the body.',
        ]);

        if($request->status_id == 'on'){
            $status_id = 2;
        }else{
            $status_id = 3;
        }

        $data = [
            'title' => $request->title,
            'body' => $request->body,
            'status_id' => $status_id,
        ];

        $announcement->update($data);

        if($announcement){
            return $respones = [
                'message' => 'Announcement updated successfully.',
            ];
        }else{
            return $respones = [
                'message' => 'Something went wrong.',
            ];
        }
    }
}
