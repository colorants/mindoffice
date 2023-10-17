@extends ('layouts.app')

@section ('content')

    <form action="{{ route('categories.store') }}" METHOD="POST">

        @csrf

        <!--send user id with submit -->

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
            <button type="submit" class="button is-center">
                Submit
            </button>
        </div>

    </form>

@endsection
