@extends('common.master')

@section('title', 'eLISA')
@section('subtitle', 'A place to share ideas')


@section('content')

    <div class="container text-light">
        <form onsubmit="event.preventDefault();sendMessage()">
            <h2>{{$idea->title}}</h2><br>
            <input id="frm_id" type="hidden" name="id" value="{{$idea->id}}"/>
            <div class="form-group">
                <label for="name">Your Name @include('common.required_indicator')</label>
                <input id="frm_name" type="text" name="name" class="form-control" required aria-required="true"/>
            </div>
            <div class="form-group">
                <label for="email">Your Email @include('common.required_indicator')</label>
                <input id="frm_email" type="email" name="email" class="form-control" required aria-required="true"/>
            </div>
            <div class="form-group">
                <label for="msg">Message @include('common.required_indicator')</label>
                <textarea id="frm_msg" cols="40" rows="5" name="msg" class="form-control" required
                          aria-required="true"></textarea>
            </div>
            <button type="submit" id="frm_submit" class="btn btn-primary">Submit</button>
            <div id="alrt_success" class="alert alert-success mt-3" role="alert" style="display: none">Success!</div>
            <div id="alrt_failure" class="alert alert-danger mt-3" role="alert" style="display: none">
                Failed to send message!
            </div>
            <div class="mt-3">

                <div class="mt-3">
                    @include('common.required_indicator') <i>Required fields</i>
                </div>
        </form>
    </div>

@endsection


@section('scripts')
    <script>
        function sendMessage() {
            document.querySelector('#alrt_failure').style = "display:none";
            document.querySelector("#frm_submit").disabled = true;

            let xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function () {
                if (this.status === 200 && this.readyState === 4) {
                    document.querySelector("#alrt_success").style = "display:block";
                    let id = xhr.responseText;
                    setTimeout(() => {
                        window.location = `/idea/${id}`;
                    }, 2000)
                } else if (this.readyState === 4) {
                    try {
                        let res = JSON.parse(xhr.responseText);
                        let errorText = "Failed to send message.<ul class='mb-0'>";
                        for (let err in res) {
                            for (let i = 0; i < res[err].length; i++) {
                                errorText += `<li>${res[err][i]}</li>`;
                            }
                        }
                        errorText += '</ul>';
                        document.querySelector('#alrt_failure').innerHTML = errorText;
                    } catch (ex) {
                        document.querySelector('#alrt_failure').innerHTML = 'Failed to send message';
                    }
                    document.querySelector('#alrt_failure').style = "display:block";
                    document.querySelector("#frm_submit").disabled = false;
                }
            };

            let payload = {
                id: document.querySelector('#frm_id').value,
                name: document.querySelector("#frm_name").value,
                email: document.querySelector("#frm_email").value,
                msg: document.querySelector("#frm_msg").value,
            };

            xhr.open('POST', `/contact`, true);
            xhr.setRequestHeader('Content-type', 'application/json');
            xhr.send(JSON.stringify(payload));
        }
    </script>
@endsection

