<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Emails;

class NewsController extends Controller
{
    public function news(Request $request)
    {
        $news = News::all();
        $emails = Emails::all();
    return view('admin.news',compact('news', 'emails'));
        
    }
    public function add_news(Request $request)
    {
        $news = new News();
        $news->title = $request->title;
        $news->subject = $request->subject;
        $news->news = $request->desc;
        $news->save();

        return response()->json(['status'=>1]);
        // return redirect()->back();
    }
}
