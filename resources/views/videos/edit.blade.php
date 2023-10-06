@extends('layouts.app')

@section('content')

<form action="{{ route('videos.update') }}" METHOD="POST">

    @csrf

    <!--send user id with submit -->

    <div class="name is-flex justify-content-center">

        <label for="title" class="form-label">
            <input type= "text" name = "title" class = "form-control @error('title')  is-invalid @enderror"  value="{{ old('title') }}">
        </label>

        @error('title')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>

    <div class="description is-flex justify-content-center">
        <label for="description" class="form-label">
            Description
        </label>
        <input type= "text" name = "description" class = "form-control @error('description')  is-invalid @enderror" value="{{ old('email') }}">
        @error('email')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>

    <div class="description is-flex justify-content-center">
        <label for="category_id" class="form-label">
            category
        </label>
        <input type= "text" name = "category_id" class = "form-control @error('category_id')  is-invalid @enderror" value="{{ old('email') }}">
        @error('category_id')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>

    <div>
        <input type="submit">
    </div>

</form>

@endsection
