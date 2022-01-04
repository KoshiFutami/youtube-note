<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NoteRequest;

use App\Models\Note;
use App\Models\Video;

class NoteController extends Controller
{
    /**
     * メモ作成画面を表示
     * @return view
     *　 
     */
    public function create()
    {
        return view('notes.create');
    }

    /**
     * 作成したメモを登録
     * @param array $request
     */
    public function store(Request $request)
    {
        $note = new Note();
        $note->fill($request->all());

        $video = new Video();
        $video->fill($request->all());
        
        $video_url = $request->video_url;
        $yt_video_id = Note::getYtVideoId($video_url);
        $video->yt_video_id = $yt_video_id;
        
        if (!empty($request->start_seconds)) {
            $video->start_seconds = $request->start_seconds;
        } else {
            $video->start_seconds = 0;
        }
        $video->save(); 

        $note->video_id = $video->id;
        $note->user_id = auth()->id();
        $note->save(); 

        $video->note_id = $note->id;
        $video->save();

        return redirect()->route('notes.show', ['id' => $note->id]);
    }


    /**
     * メモの詳細ページを表示
     * @return view
     */
    public function show(int $id)
    {
        $note =  Note::find($id);
        return view('notes.show', [
            'note' => $note,
        ]);
    }
}
