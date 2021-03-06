@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 img-post-view">
            <img src="{{ url('storage/images/' . $folder .'/' . $post->photo . '.jpg') }}">
            @include('components.button')
            <div class="description clearfix">
                <div class="col-xs-3 col-md-1">
                    <div class="avatar-post">
                        @if($post->user->picture != NULL)
                        <div class="avatar" style="background-image: url('{{ url('storage/images/avatars/' . $post->user->picture . '.jpg') }}')"></div>
                        @else
                        <div class="avatar" style="background: #CCCCCC"></div>
                        @endif
                    </div>
                </div>
                <div class="col-xs-9 col-md-11">
                    <div class="description-container">
                        <a href="{{ url('user/' . (is_null($post->user->username) ? $post->user->id : $post->user->username)) }}">
                            <b>{{ $post->user->name }}</b>
                        </a><br>
                        <p>{{ $post->description }}</p>
                    </div>
                </div>
            </div>
            <div class="comments">
                <b><i class="fa fa-commenting" aria-hidden="true"></i> {{ $post->comments->count() }} comments...</b>
                @foreach ($post->comments as $comment)
                <div class="comments-item">
                    <b><a href="{{ url('user/' . (is_null($comment->user->username) ? $comment->user->id : $comment->user->username)) }}">{{ $comment->user->name }}</a></b> {{ $comment->content }}
                </div>
                @endforeach
            </div>
            @if(Auth::check())
            <div class="comments-box">
                <form action="{{ url('comment') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                        <textarea name="comment" class="form-control"></textarea>

                        @if ($errors->has('comment'))
                        <span class="help-block">
                            <strong>{{ $errors->first('comment') }}</strong>
                        </span>
                        @endif
                    </div>

                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <div class="form-group">
                        <input type="submit" value="comment" class="btn btn-success">
                    </div>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection