<div class="card mb-3 p-1">
    <div class="card-body">
        <h5 class="card-title"><a href="/idea/{{$id}}">{{$card_title}}</a></h5>
        <p class="card-text">{!! \Illuminate\Support\Str::words($card_content, 30,'....')  !!}</p>
    </div>
</div>
