@extends('website.layouts.app')
@section('title', $news->title)
@section('content')
<div class="container mx-auto px-4 pt-24 pb-8">
    <h1 class="text-3xl font-bold mb-4">{{ $news->title }}</h1>
    <div class="mb-4">
        <span class="inline-block bg-yellow-400 text-gray-800 px-2 py-1 rounded text-sm">{{ $news->category }}</span>
        <p class="text-sm text-gray-600 inline-block ml-2"><i class="fas fa-calendar-alt text-gray-500"></i> {{ $news->published_at->format('M d, Y') }}</p>
        <p class="text-sm text-gray-600 inline-block ml-2"><i class="fas fa-user text-gray-500"></i> {{ $news->user->name }}</p>
    </div>
    <img src="{{ $news->image_url }}" alt="{{ $news->title }}" class="w-full h-96 object-cover rounded-lg mb-4" />
    <div class="prose max-w-none">{!! nl2br(e($news->description)) !!}</div>
</div>
@endsection