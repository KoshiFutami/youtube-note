<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Mail\ContactSendmail;

class ContactController extends Controller
{
    /**
     * お問い合わせページを表示
     * @return view
     */
    public function contact()
    {
        return view('contact.form');
    }


    /**
     * 入力内容確認ページを表示
     * @param array $request
     * @return view
     */
    public function confirm(ContactRequest $request)
    {
        // $request->validate([
        //     'username' => 'required',
        //     'email' => 'required|email',
        //     'body'  => 'required',
        // ]);

        $inputs = $request->all();
        return view('contact.confirm', [
            'inputs' => $inputs,
        ]);
    }

    /**
     * 入力内容を送信
     * @param array $request
     */
    public function send(ContactRequest $request)
    {
        // $request->validate([
        //     'username' => 'required',
        //     'email' => 'required|email',
        //     'body'  => 'required',
        // ]);

        $inputs = $request->all();

        //入力されたメールアドレスにメールを送信
        \Mail::to($inputs['email'])->send(new ContactSendmail($inputs));

        //再送信を防ぐためにトークンを再発行
        $request->session()->regenerateToken();

        return view('contact.thanks');

    }

    /**
     * 送信完了ページを表示
     * @return view
     */
    public function showThanks()
    {
        return view('contact.confirm');
    }
}
