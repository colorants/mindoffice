@extends ('layouts.app')

@section ('content')

    <form action="{{ route('adresses.update', $adress->id) }}" method="POST">

    @csrf
@method('PUT')

        <div class="box" style="width: 25vw;margin:auto">
        <div class="name is-flex justify-content-center">

            <label for="street" class="form-label">
                Title (max 20 characters)
                <input type= "text" maxlength="25" name = "street" class = "form-control @error('street')  is-invalid @enderror" value="{{ old('title', $adress->street) }}">
            </label>

            @error('title')

            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="name is-flex justify-content-center" >
            <label for="housenumber" class="form-label">
                housenumber
                <input type= "text" name ="housenumber" class = "form-control @error('housenumber')  is-invalid @enderror"  value="{{ old('housenumber', $adress->housenumber) }}">
            </label>
            @error('housenumber')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>


<div class="field-group is-flex justify-content-between">
            <div class="is-field btn is-flex is-align-items-flex-end is-inline">
                <a href="{{ route('adresses.index') }}" class="btn btn-primary">Back</a>
            </div>



    <div class="is-field btn is-flex is-align-items-flex-start is-inline">
        <button type="submit" class="btn btn-warning "> Submit </button>
    </div>



</div>
        </div>

    </form>

@endsection
