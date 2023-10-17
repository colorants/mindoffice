@extends('layouts.app')

<!-- show video details -->
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $video->name }}</div>

                    <div class="card-body">
                        <p>{{ $video->description }}</p>
                        <p>{{ $video->created_at}}</p>
                        <p>{{ $video->updated_at}}</p>
                        <a href="{{ route('videos.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
