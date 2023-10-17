@extends ('layouts.app')

@section ('content')

    <form action="{{ route('videos.update', $video->id) }}" method="POST">

    @csrf
@method('PUT')
        <!--send user id with submit -->

        <div class="name is-flex justify-content-center">

            <label for="title" class="form-label">
                Title (max 20 characters)
                <input type= "text" maxlength="25" name = "title" class = "form-control @error('title')  is-invalid @enderror" value="{{ old('title', $video->title) }}">
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
                <input type= "text" name ="description" class = "form-control @error('description')  is-invalid @enderror"  value="{{ old('description', $video->description) }}">
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
                <<select name="category_id" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $video->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>


            </label>
            @error('category_id')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

<div class="field-group">
        <div class="is-field btn is-flex is-align-items-flex-start is-inline">
            <button type="submit" class="btn btn-warning "> Submit </button>
        </div>


            <div class="is-field btn is-flex is-align-items-flex-end is-inline">
                <a href="{{ route('videos.index') }}" class="btn btn-primary">Back</a>
            </div>

    <div class="form-group">
        <label for="active">Active:</label>
        <input type="checkbox" name="active" {{ $video->active ? 'checked' : '' }}>
    </div>

</div>

    </form>

@endsection
