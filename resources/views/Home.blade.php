@extends('common.master')

@section('title', 'eLISA')
@section('subtitle', 'A place to share ideas')

@section('content')
    <div class="p-1">
        @foreach($ideas as $idea)
            @include('common.idea_card', array(
            "id" => $idea->id,
            "card_title" => $idea->title,
            "card_content" => $idea->content,
            "avg_rating" => $idea->avg_rating
            ))
        @endforeach
    </div>

    @isset($pagination)
        <div class="d-flex justify-content-center">
            {{$pagination}}
        </div>
    @endisset
@endsection
