<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\ContactSendMail;
use App\Http\Requests\SendContact;

use Slack;

class AboutWebsiteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function about_mydailylife()
    {
      return view('home.about_mydailylife');
    }

    public function policy()
    {
      return view('home.policy');
    }

    public function privacy_policy()
    {
      return view('home.privacy_policy');
    }

    public function faqs()
    {
      return view('home.faqs');
    }

// 問い合わせ機能
    public function contact()
    {
      return view('contact');
    }

    public function sendContact(SendContact $request)
    {
      $email = $request->contact_email;
      Mail::to($email)->send(new ContactSendMail($request));

// ！！！504 Gateway Timeoutが発生するためSlack通知は保留！！！
      // // Slack通知内容作成・送信
      // $name = $request->contact_name;
      // $description = $request->contact_contact_description;
      // $post_slack = "お問い合わせがありました。\n▼名前：${name}様\n▼メールアドレス：${email}\n▼メッセージ：{!! nl2br($description) !!}";
      // Slack::send($post_slack);

      //再送信を防ぐためにトークンを再発行
      $request->session()->regenerateToken();

      //送信完了ページのviewを表示
      return redirect()->route('contact')
      ->with('message', 'お問い合わせを受け付けました。ありがとうございます。');
  
  }
