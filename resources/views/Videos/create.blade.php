@extends ('layouts.navbar')

@section ('content')


    <form action="{{ route('videos.store') }}" METHOD="POST">

        @csrf

        <!--send user id with submit -->
        <input type="hidden" value="">



        <div class="name is-flex justify-content-center">

            <label for="title" class="form-label">

                Titel
                <input type= "text" name = "title" class = "form-control @error('title')  is-invalid @enderror"  value="{{ old('') }}">
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
