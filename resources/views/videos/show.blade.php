@extends('layouts.app')

<!-- show video details -->
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $videos->name }}</div>

                    <div class="card-body">
                        <p>{{ $videos->description }}</p>
                        <a href="{{ route('videos.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
