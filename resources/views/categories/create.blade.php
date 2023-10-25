@extends ('layouts.app')

@section ('content')

<h1 class="m-3"> Create a category</h1>
<section>
    <form action="{{ route('categories.store') }}" METHOD="POST">

        @csrf
        <div class="name is-flex justify-content-center">
            <label for="title" class="form-label">
                Title (max 20 characters)
                <input type= "text" maxlength="25" name = "title" class = "form-control @error('title')  is-invalid @enderror" value="{{ old('title') }}">
            </label>

            @error('title')

            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>


        <div>
            <button type="submit" class="button">
                Submit
            </button>
        </div>

    </form>
</section>
@endsection
