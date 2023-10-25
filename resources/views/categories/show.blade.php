@extends('layouts.app')

<!-- show video details -->
@section('content')

    <div class="col-md-8 is-flex" style="margin:auto">

        <div class="column box is-one-quarter overflow-hidden " style="width:25vw;margin:auto">

            @auth()
                @csrf
                <h1>  {{ $category->title }} </h1>
                <p>Created at : {{ $category->created_at}}</p>

            @endauth
            <a href="{{ route('categories.index') }}" class="btn btn-primary">Back</a>
        </div>
    </div>




@endsection
