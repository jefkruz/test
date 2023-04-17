@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <form class="form-inline" action="{{route('room')}}"  method="post" enctype="multipart/form-data" >

                            <div class="form-group mx-sm-3 mb-2">
                                <label for="inputPassword2" class="sr-only">Enter Room</label>
                                <input type="text" class="form-control" name="name" id="inputPassword2" placeholder="">
                            </div>
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary mb-2">Enter</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
