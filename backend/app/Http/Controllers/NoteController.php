<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NoteRequest;

use App\Models\Note;
use Illuminate\Database\Eloquent\Builder;

class NoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store', 'update', 'destroy', 'bookmark']);
    }

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
     * 全ユーザーのメモ一覧を表示
     * @return view
     *　 
     */
    public function showAll()
    {
        $notes = Note::all();
        return view('notes.index', [
            'notes' => $notes,
        ]);
    }

    /**
     * 作成したメモを登録
     * @param array NoteRequest $request
     */
    public function store(NoteRequest $request)
    {
        $note = new Note();
        $note->fill($request->all());

        $note->user_id = auth()->id();
        
        // YouTube動画IDの登録
        $video_url = $request->video_url;
        $yt_video_id = Note::getYtVideoId($video_url);
        $note->yt_video_id = $yt_video_id;
        
        // YouTube動画再生時間の登録
        $h = $request->start_seconds_h;
        $m = $request->start_seconds_m;
        $s = $request->start_seconds_s;
        $start_seconds = Note::hourToSec($h, $m, $s);
        $note->start_seconds = $start_seconds;
        
        $tags_id = Note::saveTagsAndGetIds($request->tags);

        $note->save(); 
        $note->tags()->sync($tags_id);

        session()->flash('toastr', config('toastr.note.save'));

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

        $this->authorize('update', $note);

        $video_url = $request->video_url;
        $yt_video_id = Note::getYtVideoId($video_url);
        $note->yt_video_id = $yt_video_id;
        
        $h = $request->start_seconds_h;
        $m = $request->start_seconds_m;
        $s = $request->start_seconds_s;
        $start_seconds = Note::hourToSec($h, $m, $s);

        $note->start_seconds = $start_seconds;

        $note->save();

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

        session()->flash('toastr', config('toastr.note.update'));

        return redirect()->route('notes.show', ['id' => $note->id]);
    }


    /**
     * 作成済のメモを削除
     * @param int $id
     */
    public function destroy(int $id)
    {
        $note = Note::find($id);
        
        $this->authorize('update', $note);

        // $note_title = $note->title;
        
        $note->tags()->sync([]);
        $note->delete();

        return redirect()->route('home');
    }

    /**
     * メモの詳細ページを表示
     * @return view
     */
    public function show(int $id)
    {
        $note =  Note::findOrFail($id);

        $start_seconds = Note::secToHour($note->start_seconds);
        return view('notes.show', [
            'note' => $note,
            'start_seconds' => $start_seconds,
        ]);
    }

     /**
      * メモ検索ページを表示
      * @return view
      */
    public function search(Request $request)
    {
        if ($request->keywords) {

        $query = Note::query();

        // 全角スペースを半角スペースに変換し
        $input = mb_convert_kana($request->keywords, 's', 'utf-8');
        // 半角スペースで区切り、配列に挿入
        $keywords = preg_split('/ ++/', $input, -1, PREG_SPLIT_NO_EMPTY);

        foreach ($keywords as $keyword) {
            $query->where(function ($query) use ($keyword) {
                $query->where("title", "like", "%{$keyword}%")
                    ->orWhere("content", "like", "{$keyword}%")
                    ->orWhereHas("tags", function (Builder $query) use ($keyword) {
                        $query->where("name", "like", "%{$keyword}%");
                    });
            });
        }

        $notes = $query->get();

        return view('notes.search', [
            'notes' => $notes,
            'keywords' => $request->keywords,
        ]);

        } else {
            return view('notes.search');
        }
    }

    /**
     * メモをブックマーク
     * @param array $request
     */
    public function bookmark(Request $request)
    {
        $user = \Auth::user();
        $note = Note::find($request->input('note_id'));

        if ($note->is_bookmarked_by_auth_user()) {
            $user->bookmark_notes()->detach($note->id);
        } else {
            $user->bookmark_notes()->attach($note->id);
        }

        return back();
    }
}
