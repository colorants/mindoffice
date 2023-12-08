@extends('layouts.app')

@section('content')
    <section class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Create a company</div>
                    <div class="card-body">
                        <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf


                            <div class="form-group mt-2">
                                <label for="name">Naam </label>
                                <input type="text" maxlength="20" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group mt-2">
                                <label for="kvk"> KvK </label>
                                <textarea name="kvk" class="form-control @error('kvk') is-invalid @enderror" rows="4" required>{{ old('kvk') }}</textarea>
                                @error('kvk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group mt-2">
                                <label for="btw">BTW</label>
                                <textarea name="btw" class="form-control @error('btw') is-invalid @enderror" rows="4" required>{{ old('btw') }}</textarea>
                                @error('btw')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>


                            <div class="form-group mt-2">
                                <label for="country_id">Land</label>
                                <select name="country_id" class="form-control ">
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }} </option>
                                    @endforeach
                                </select>
                            </div>




                            <button type="submit" class="btn mt-3 btn-primary">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
