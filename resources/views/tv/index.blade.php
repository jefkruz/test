@extends('layouts.tv')
@section('content')

    <!-- SECTION DARK -->


    <!-- end: SECTION DARK -->

    <div class="modal fade" id="loginModal" tabindex="-1" role="modal" aria-labelledby="modal-label"   >
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body py-5 px-sm-5">
                                    <div class="mb-5 text-center">
                                        <h6 class="h3 mb-1">Login</h6>
                                        <p class="text-muted mb-0">Sign in to your account to continue.</p>
                                    </div>

                                    <div class="line"></div>
                                    <a href="https://accounts.kingsch.at/?client_id=com.kingschat&scopes=[%22conference_calls%22]&post_redirect=true&redirect_uri={{route('kcLogin')}}" class="btn btn-outline btn-block text-center">
                                        <img src="https://kingsch.at/h/css/images/favicon.ico" alt=""> Login with KingsChat</a>
                                </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>

@endsection


@section('scripts')
  <form class="form-inline" action="room"  method="post" enctype="multipart/form-data" >
  <div class="form-group mb-12">
    <label for="staticEmail2" class="sr-only">Email</label>
    <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Enter Room">
  </div>
  <div class="form-group mx-sm-3 mb-2">
    <label for="inputPassword2" class="sr-only">post</label>
    <input type="text" class="form-control" name="name" id="inputPassword2" placeholder="Enter Room">
  </div>
  {{ csrf_field() }}
  <button type="submit" class="btn btn-primary mb-2">Enter</button>
</form>
    <script>

        $.ajax({
            method: 'get',
            url: '{{route('authTv')}}',
            success: function (data){

                if(data.auth === false){
                    var myModal = new bootstrap.Modal(document.getElementById("loginModal"), {
                        backdrop: 'static', keyboard: false
                    });
                   myModal.show();
                }
            }
        })
    </script>

@endsection
