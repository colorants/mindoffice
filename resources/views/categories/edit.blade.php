@extends ('layouts.app')

@section ('content')

    <form action="{{ route('categories.update', $category->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="name is-flex justify-content-center">

            <label for="title" class="form-label">
                Title (max 20 characters)
                <input type= "text" maxlength="25" name = "title" class = "form-control @error('title')  is-invalid @enderror" value="{{old('title' ,$category->title)}}">
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

@endsection
