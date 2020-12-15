<title>NotFacebook - Edit Post</title>
@extends('layouts.app')

@section('content')
<div class="container">
    <br>
        @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{session()->get('success')}}
        </div>
        @endif
        @if(session()->has('danger'))
            <div class="alert alert-danger" role="alert">
                {{session()->get('danger')}}
            </div>
        @endif
        <form action = "{{route('post.edit')}}" method="POST">
            @csrf
            <div class="form-group">
                <input type="hidden" value="{{$post->id}}" name="id">
                <textarea class="form-control" placeholder="What's on your mind?" name="description" rows="3" require>{{$post->description}}</textarea>
            </div>
            <button class="btn btn-primary" type="submit">Save Changes</button>
        </form>
</div>
@endsection