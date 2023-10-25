@extends('layouts.app')

<!-- show video details -->
@section('content')
            <div class="col-md-8 is-flex" style="margin:auto">
                <div class="column box is-one-quarter overflow-hidden " style="width:25vw;margin:auto">
                    {{ $video->name }}
                        <p>{{ $video->description }}</p>
                        @auth()
                            @csrf
                        <p>{{ $video->created_at}}</p>
                        <p>{{ $video->updated_at}}</p>
                        @endauth
                        <a href="{{ route('videos.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
                </div>



@endsection
