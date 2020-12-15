<title>NotFacebook - Edit Comment</title>
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
        <form action = "{{route('comment.edit')}}" method="POST">
            @csrf
            <div class="form-group">
                <input type="hidden" value="{{$comment->id}}" name="id">
                <textarea class="form-control" placeholder="Add a comment" name="comment_text" rows="3" require>{{$comment->comment_text}}</textarea>
            </div>
            <button class="btn btn-primary" type="submit">Save Changes</button>
        </form>
</div>
@endsection