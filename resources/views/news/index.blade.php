@extends('layouts.app')

@section('content')
    <div id="app">
        <news-articles :articles="{{ $articles }}"></news-articles>
    </div>
@endsection
