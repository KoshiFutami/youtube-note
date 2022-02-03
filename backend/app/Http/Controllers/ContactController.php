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
        // 「送信する」 or 「修正する」を確認
        $action = $request->input('action');
         
        $inputs = $request->except('action');

        if ($action !== 'submit') {
            // 「修正する」場合はフォーム入力ページに飛ばす
            return redirect()->route('contact.form')->withInput($inputs);
        } else {
            // 「送信する」場合の処理を実行
            //フォーム送信者と運営者にメールを送信
            \Mail::to($inputs['email'])->send(new ContactSendmail($inputs));
            \Mail::to(env('MAIL_ADMIN'))->send(new ContactSendmail($inputs));
    
            //再送信を防ぐためにトークンを再発行
            $request->session()->regenerateToken();
    
            return view('contact.thanks');
        }

    }

}
