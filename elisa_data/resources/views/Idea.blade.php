@extends('common.master')

@section('title', 'eLISA')
@section('subtitle', 'A place to share ideas')


@section('content')

    <div class="container">
        <div class="row bg-white p-5 rounded">
            <div>
                <input id="rating" name="rating" class="rating rating-loading" data-min="0" data-max="5" data-step="1"
                       data-show-caption="false">
            </div>
            <h1 class="w-100">{{$idea->title}}</h1>
            <p class="blockquote-footer ml-5 w-100">by {{$idea->name}}, {{$idea->created_at}} UTC</p>
            <div class="text-justify w-100">{{$idea->content}}</div>
            <a href="/contact/{{$idea->id}}" class="btn btn-primary mt-5">Contact OP</a>
        </div>

        <h2 class="mt-5 mb-2 text-light">Comments:</h2>

        <div class="row">
            @if($idea->comments->count() > 0)
                @foreach($idea->comments as $comment)
                    <div class="comment p-5 pl-3 mt-5 bg-white border-muted rounded border-left"
                         style="border-width: 0px 0px 0px 10px !important">
                        <h3 class="h5 w-100">{{$comment->title}}</h3>
                        <p class="blockquote-footer pl-5 w-100">by {{$comment->name}}, {{$comment->created_at}} UTC</p>
                        <div class="small text-justify w-100">{{$comment->content}}</div>
                    </div>
                @endforeach
            @else
                <div class="text-light">
                    No comments found.
                </div>
            @endif
        </div>

        <div class="row">
            <div class="container mt-5 text-light">
                <h3>Post a comment</h3>
                <form onsubmit="event.preventDefault();submitIdea()" class="mt-4">
                    <div class="form-group">
                        <label for="frm_uname">Name</label>
                        <input type="text" class="form-control" id="frm_uname" placeholder="Anonymous">
                    </div>
                    <div class="form-group">
                        <label for="frm_title">Title @include('common.required_indicator')</label>
                        <input type="text" class="form-control" id="frm_title" placeholder="Your comment title"
                               minlength="10"
                               required aria-required="true" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="frm_content">Description @include('common.required_indicator')</label>
                        <textarea class="form-control" id="frm_content" rows="3"
                                  placeholder="Use this area to describe your comment in detail..." minlength="100"
                                  required
                                  aria-required="true" autocomplete="off"></textarea>
                    </div>
                    <button type="submit" id="frm_submit" class="btn btn-primary">Submit</button>
                    <div id="alrt_success" class="alert alert-success mt-3" role="alert" style="display: none">
                        Success!
                    </div>
                    <div id="alrt_failure" class="alert alert-danger mt-3" role="alert" style="display: none">Failed
                        to submit
                        comment!
                    </div>
                    <div class="mt-3">
                        @include('common.required_indicator') <i>Required fields</i>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection

@section('scripts')
    <script>
        function submitIdea() {
            document.querySelector('#alrt_failure').style = "display:none";
            document.querySelector("#frm_submit").disabled = true;

            let xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function () {
                if (this.status === 200 && this.readyState === 4) {
                    document.querySelector("#alrt_success").style = "display:block";
                    let id = xhr.responseText;
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000)
                } else if (this.readyState === 4) {
                    try {
                        let res = JSON.parse(xhr.responseText);
                        let errorText = "Failed to submit comment.<ul class='mb-0'>";
                        for (let err in res) {
                            for (let i = 0; i < res[err].length; i++) {
                                errorText += `<li>${res[err][i]}</li>`;
                            }
                        }
                        errorText += '</ul>';
                        document.querySelector('#alrt_failure').innerHTML = errorText;
                    } catch (ex) {
                        document.querySelector('#alrt_failure').innerHTML = 'Failed to submit comment';
                    }
                    document.querySelector('#alrt_failure').style = "display:block";
                    document.querySelector("#frm_submit").disabled = false;
                }
            };

            let payload = {
                idea: window.location.pathname.split('/').pop(),
                name: document.querySelector("#frm_uname").value,
                title: document.querySelector("#frm_title").value,
                content: document.querySelector("#frm_content").value
            };

            xhr.open('POST', `/api/comments`, true);
            xhr.setRequestHeader('Content-type', 'application/json');
            xhr.send(JSON.stringify(payload));
        }
    </script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/css/star-rating.min.css" media="all"
          rel="stylesheet" type="text/css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/themes/krajee-svg/theme.css"
          media="all" rel="stylesheet" type="text/css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/js/star-rating.min.js"
            type="text/javascript"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/themes/krajee-svg/theme.js"></script>
    <style>
        .krajee-icon-clear {
            display: none !important;;
        }
    </style>
    <script>
        $("#rating").rating({'theme': 'krajee-svg', 'showCaptionAsTitle': false,});
        $('#rating').on('rating:change', function (event, value, caption) {
            fetch('/api/ratings', {
                method: 'POST',
                mode: 'cors',
                cache: 'no-cache',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/json'
                },
                redirect: 'follow',
                referrer: 'no-referrer',
                body: JSON.stringify({
                    idea: window.location.href.split('/').pop(),
                    rating: value
                })
            })
        });
    </script>
@endsection

