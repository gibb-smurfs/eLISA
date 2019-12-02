<div class="card mb-3 p-1">
    <div class="card-body">
        <h5 class="card-title">{{$avg_rating}} <a href="/idea/{{$id}}">{{$card_title}}</a></h5>
        <p class="card-text">{{ \Illuminate\Support\Str::words($card_content, 30,'....')  }}</p>
        <p class="small mb-0">Posted on {{$created_at}} by {{$author}}</p>
    </div>
</div>
