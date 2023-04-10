<?php

namespace App\Http\Controllers;

use App\Models\NewsArticle;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function index()
    {
        $articles = NewsArticle::orderBy('created_at', 'desc')->get();
        return view('news.index', compact('articles'));
    }
}
