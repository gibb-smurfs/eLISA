@extends('common.master')

@section('title', 'eLISA')
@section('subtitle', 'Share your idea')

@section('content')
    <div class="container text-light">
        <form onsubmit="event.preventDefault();submitIdea()">
            <div class="form-group">
                <label for="frm_uname">Name</label>
                <input type="email" class="form-control" id="frm_uname" placeholder="Anonymous">
            </div>
            <div class="form-group">
                <label for="frm_mail">Email @include('common.required_indicator')</label>
                <input type="email" class="form-control" id="frm_mail" placeholder="name@example.com" required
                       aria-required="true" autocomplete="on">
            </div>
            <div class="form-group">
                <label for="frm_title">Title @include('common.required_indicator')</label>
                <input type="text" class="form-control" id="frm_title" placeholder="My cool idea!" minlength="10"
                       required aria-required="true" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="frm_content">Description @include('common.required_indicator')</label>
                <textarea class="form-control" id="frm_content" rows="3"
                          placeholder="Use this area to describe your idea in detail..." minlength="100" required
                          aria-required="true" autocomplete="off"></textarea>
            </div>
            <button type="submit" id="frm_submit" class="btn btn-primary">Submit</button>
            <div id="alrt_success" class="alert alert-success mt-3" role="alert" style="display: none">Success!</div>
            <div id="alrt_failure" class="alert alert-danger mt-3" role="alert" style="display: none">Failed to submit
                idea!
            </div>
            <div class="mt-3">
                @include('common.required_indicator') <i>Required fields</i>
            </div>
        </form>
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
                        window.location = `/idea/${id}`;
                    }, 2000)
                } else if (this.readyState === 4) {
                    try {
                        let res = JSON.parse(xhr.responseText);
                        let errorText = "Failed to submit idea.<ul class='mb-0'>";
                        for (let err in res) {
                            for (let i = 0; i < res[err].length; i++) {
                                errorText += `<li>${res[err][i]}</li>`;
                            }
                        }
                        errorText += '</ul>';
                        document.querySelector('#alrt_failure').innerHTML = errorText;
                    } catch (ex) {
                        document.querySelector('#alrt_failure').innerHTML = 'Failed to submit idea';
                    }
                    document.querySelector('#alrt_failure').style = "display:block";
                    document.querySelector("#frm_submit").disabled = false;
                }
            };

            let payload = {
                name: document.querySelector("#frm_uname").value,
                email: document.querySelector("#frm_mail").value,
                title: document.querySelector("#frm_title").value,
                content: document.querySelector("#frm_content").value
            };

            xhr.open('POST', `/api/ideas`, true);
            xhr.setRequestHeader('Content-type', 'application/json');
            xhr.send(JSON.stringify(payload));
        }
    </script>
@endsection
