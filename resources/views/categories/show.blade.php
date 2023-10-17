@extends('layouts.app')

<!-- show video details -->
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header has-color-black">
                        <h1> {{ $category->title }} </h1>
                    </div>

                    <p>Created at : {{$category->created_at}}</p>
                        <a href="{{ route('categories.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
