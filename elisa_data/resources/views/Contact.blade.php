@extends('common.master')

@section('title', 'eLISA')
@section('subtitle', 'A place to share ideas')


@section('content')

    <div class="container">
        <form method="GET" action="/mailer">
            <h2>{{$idea->title}}</h2><br>
            <input type="hidden" name="id" value="{{$idea->id}}" />
            <div><label>Your Name:</label></div>
            <div><input type="text" name="name" class="form-control" /></div>
            <div><label>Your Email:</label></div>
            <div><input type="text" name="email" class="form-control" /></div>

            <div><label>Message:</label></div>
            <div><textarea cols="40" rows="5" name="msg" class="form-control"></textarea></div>
            <div class="float-right mt-2">
                <input type="submit" value="Send" class="btn btn-primary" />
            </div>
        </form>
    </div>

@endsection
