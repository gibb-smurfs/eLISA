@extends('common.master')

@section('title', 'eLISA')
@section('subtitle', 'A place to share ideas')

@section('content')
    <div class="p-1">
        @if(count($ideas) === 0)
            <h2 class="no-results text-warning">:(</h2>
            <h3 class="no-results text-light">I'm lost... what were you looking for?</h3>
        @endif
        @foreach($ideas as $idea)
            @include('common.idea_card', array(
            "id" => $idea->id,
            "card_title" => $idea->title,
            "card_content" => $idea->content,
            "avg_rating" => $idea->avg_rating ? $idea->avg_rating : 'N/A',
            "created_at" => $idea->created_at,
            "author" => $idea->name
            ))
        @endforeach
    </div>

    @isset($pagination)
        <div class="d-flex justify-content-center">
            {{$pagination}}
        </div>
    @endisset
@endsection
