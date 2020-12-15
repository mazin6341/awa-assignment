<title>NotFacebook</title>
@extends('layouts.app')

@section('content')
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
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
                    <form action = "{{route('post.create')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" placeholder="What's on your mind?" name="description" rows="3" require></textarea>
                        </div>
                        <div class="form-group">
                            <input type="file" name="image"></input>
                        </div>
                        <button class="btn btn-primary" type="submit">Post</button>
                    </form>
                </div>
            </div>
            <br><br>
                @foreach($posts as $post)
                <div class="card">
                    <div class="card-header">
                        <span style="font-weight: bold;">
                            {{$post->user->name}}
                        </span>
                        @if(auth()->user()->id == $post->user_id)
                        <span class="dropdown show" style="margin-left: 95% !important;">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="showpost/{{$post->id}}">Edit</a>
                                <a class="dropdown-item" href="deletepost/{{$post->id}}">Delete</a>
                            </div>
                        </span>
                        @endif
                        <br>
                        <p>{{$post->description}}</p>
                        @if($post->image)
                        <img src="{{asset('images')}}/{{$post->image}}">
                        @endif
                        <p><small>{{$post->created_at->diffForHumans()}}</small></p>
                        
                    </div>
                    @foreach ($post->comment as $comment)
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div>
                                <span style="font-weight: bold;">{{$comment->user->name}}</span>
                                @if(auth()->user()->id == $comment->user_id)
                                <span class="dropdown show" style="margin-left: 95% !important;">
                                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="showcomment/{{$comment->id}}">Edit</a>
                                        <a class="dropdown-item" href="deletecomment/{{$comment->id}}">Delete</a>
                                    </div>
                                </span>
                                @endif
                            </div>
                            <p>{{$comment->comment_text}}</p>
                            <p><small>{{$comment->created_at->diffForHumans()}}</small></p>
                        </li>
                    </ul>
                    @endforeach
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <form action = "{{route('comment.create')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Write a comment!" name="comment_text" rows="1" require></textarea>
                                </div>
                                <input type="hidden" name="post_id" value="{{$post->id}}">
                                <button class="btn btn-primary" type="submit">Comment</button>
                            </form>
                        </li>
                    </ul>
                </div>
                <br>
                @endforeach
        </div>
    </div>
</div>
@endsection