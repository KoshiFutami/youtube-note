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
     * @param array NoteRequest $request
     */
    public function store(NoteRequest $request)
    {
        $note = new Note();
        $note->fill($request->all());

        $video = new Video();
        $video->fill($request->all());
        
        $video_url = $request->video_url;
        $yt_video_id = Note::getYtVideoId($video_url);
        $video->yt_video_id = $yt_video_id;
        
        $h = $request->start_seconds_h;
        $m = $request->start_seconds_m;
        $s = $request->start_seconds_s;
        $start_seconds = Note::hourToSec($h, $m, $s);

        $video->start_seconds = $start_seconds;
        
        $video->save(); 

        $tags_id = Note::saveTagsAndGetIds($request->tags);

        $note->video_id = $video->id;
        $note->user_id = auth()->id();
        $note->save(); 
        $note->tags()->sync($tags_id);

        return redirect()->route('notes.show', ['id' => $note->id]);
    }


    /**
     * 作成済のメモを更新
     * @param array NoteRequest　$request
     * @param int $id
     */
    public function update(NoteRequest $request, int $id)
    {
        $note = Note::find($id);
        $video = Video::find($note->video_id);

        $video_url = $request->video_url;
        $yt_video_id = Note::getYtVideoId($video_url);
        $video->yt_video_id = $yt_video_id;
        
        $h = $request->start_seconds_h;
        $m = $request->start_seconds_m;
        $s = $request->start_seconds_s;
        $start_seconds = Note::hourToSec($h, $m, $s);

        $video->start_seconds = $start_seconds;

        $video->save();

        $tags_id = Note::saveTagsAndGetIds($request->tags);

        // このメモにもともと紐付いていたタグの処理
        if ($request->current_tags) {
            $current_tags = $request->current_tags;
            foreach($current_tags as $tag) {
                array_push($tags_id, $tag);
            }
        }

        $note->title = $request->title;
        $note->content = $request->content;
        $note->save(); 
        $note->tags()->sync($tags_id);

        return redirect()->route('notes.show', ['id' => $note->id]);
    }


    /**
     * 作成済のメモを削除
     * @param int $id
     */
    public function destroy(int $id)
    {
        $note = Note::find($id);
        $video = Video::find($note->video_id);
        
        $note_title = $note->title;
        
        $note->tags()->sync([]);
        $note->delete();
        $video->delete();

        // Todo: リダイレクト先をユーザーのメモ一覧ページに修正
        return redirect()->route('home');
    }

    /**
     * メモの詳細ページを表示
     * @return view
     */
    public function show(int $id)
    {
        $note =  Note::find($id);

        $start_seconds = Note::secToHour($note->video->start_seconds);
        return view('notes.show', [
            'note' => $note,
            'start_seconds' => $start_seconds,
        ]);
    }
}
