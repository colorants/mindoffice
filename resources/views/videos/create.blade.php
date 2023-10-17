@extends ('layouts.app')

@section ('content')

    <form action="{{ route('videos.store') }}" METHOD="POST" enctype="multipart/form-data">

        @csrf

        <!--send user id with submit -->
<div class="pt-1 m-2">


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

        <div class="name is-flex justify-content-center">
            <label for="description" class="form-label">
                Description
                <input type= "text" name ="description" class = "form-control @error('description')  is-invalid @enderror"  value="{{ old('description') }}">
            </label>
            @error('description')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>


        <div class="name is-flex justify-content-center">
            <label for="category_id" class="form-label">
                Category
                <select name ="category_id" class = "form-control @error('category_id')  is-invalid @enderror"  value="{{ old('category_id') }}">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
                </select>
            </label>
            @error('category_id')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>


        <div class="image is-flex justify-content-center">
        <label for="image" class="form-label">Profielfoto</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*"  >
        @error('image')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        </div>
</div>



<div class=" is-flex justify-content-center">
   <button type="submit" class="button ">
         Submit
    </button>
</div>

    </form>

@endsection
