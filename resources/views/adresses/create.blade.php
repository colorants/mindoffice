@extends('layouts.app')

@section('content')
    <section class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Add an adress</div>
                    <div class="card-body">
                        <form action="{{ route('adresses.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

Type adres
                            <select name="type" class="form-control">
                                    <option value="bezoek">Bezoekadres </option>
                                    <option value="post">Afleveradres </option>
                            </select>

                            <div class="form-group mt-2">
                                <label for="street">Straatnaam</label>
                                <input type="text" maxlength="20" name="street" class="form-control @error('street') is-invalid @enderror" value="{{ old('street') }}" required>
                                @error('street')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group mt-2">
                                <label for="housenumber">Huisnummer</label>
                                <input type="number" name="housenumber" class="form-control @error('housenumber') is-invalid @enderror" rows="4" required>{{ old('housenumber') }}</input>
                                @error('housenumber')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group mt-2">
                                <label for="zipcode">Postcode</label>
                                <textarea name="zipcode" class="form-control @error('zipcode') is-invalid @enderror" rows="4" required>{{ old('zipcode') }}</textarea>
                                @error('zipcode')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group mt-2">
                                <label for="city">Stad</label>
                                <textarea name="city" class="form-control @error('city') is-invalid @enderror" rows="4" required>{{ old('city') }}</textarea>
                                @error('city')
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

                            <div class="form-group mt-2">
                            <label for="company_id">Bedrijf</label>
                            <select name="company_id" class="form-control">
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }} </option>
                                @endforeach
                            </select>
                            </div>



                            <button type="submit" class="btn mt-3 btn-primary">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
