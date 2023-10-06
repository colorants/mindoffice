@extends ('layouts.app')

@section ('content')

    <form action="{{ route('videos.store') }}" METHOD="POST">

        @csrf

        <!--send user id with submit -->

        <div class="name is-flex justify-content-center">
            Title
            <label for="title" class="form-label">
                <input type= "text" name = "title" class = "form-control @error('title')  is-invalid @enderror"  value="{{ old('title') }}">
            </label>

            @error('title')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

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

<div>
    <input type="submit">
</div>

    </form>

@endsection
