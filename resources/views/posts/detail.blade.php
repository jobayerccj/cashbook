@extends('layouts/master')

@section('content')

    <div class="col-md-8 blog-main">

        <div class="blog-post">
        <h2 class="blog-post-title">
          
            {{ $post->title }}
          
        </h2>
        <p class="blog-post-meta">{{ $post->created_at->toFormattedDateString() }} <a href="#">Mark</a></p>

        <p>
          {{ $post->body }}
        </p>

        <div class="comments">
          <ul class="list-group">
            @foreach($post->comments as $comment)
              <li class="list-group-item">
                <strong>{{ $comment->created_at->diffForHumans() }} by {{ $comment->user->name }}: </strong>
                {{ $comment->body }}
                
              </li>
            @endforeach
          </ul>
        </div>
       
       <hr/>

       <div class="card">
          <div class="card-block">
            <form method="POST" action="/cashbook/posts/{{ $post->id }}/comments">
              {{ csrf_field() }}
              <div class="form-group">
                <textarea class="form-control" name="body" placeholder="Your Comment"></textarea>
              </div>

               <div class="form-group">
                <button type="submit" class="btn btn-primary">Add Comment</button>
              </div>
            </form>
          </div>
       </div>

      </div><!-- /.blog-post -->

    </div><!-- /.blog-main -->

    @include('layouts.sidebar')
    
@endsection('content')