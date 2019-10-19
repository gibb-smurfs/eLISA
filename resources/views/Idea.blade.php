@extends('common.master')

@section('title', 'eLISA')
@section('subtitle', 'A place to share ideas')


@section('content')

    <div class="container">
        <div class="row">
            <h1 class="w-100 p-2">{{$idea->title}}</h1>
            <p class="blockquote-footer ml-5 w-100">by {{$idea->name}}, {{$idea->created_at}} UTC</p>
            <div class="text-justify w-100">{{$idea->content}}</div>
        </div>

        <h2 class="mt-5 mb-2">Comments:</h2>

        <div class="row">
            @if($idea->comments->count() > 0)
                @foreach($idea->comments as $comment)
                    <div class="comment pl-3 pr-2 mt-5">
                        <h3 class="h5 w-100 p-2">{{$comment->title}}</h3>
                        <p class="blockquote-footer pl-5 w-100">by {{$idea->name}}, {{$idea->created_at}} UTC</p>
                        <div class="small text-justify w-100">{{$comment->content}}</div>
                    </div>
                @endforeach
            @else
                <div>
                    No comments found.
                </div>
            @endif
        </div>

    </div>

@endsection
