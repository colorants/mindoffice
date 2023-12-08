@extends('layouts.app')

@section('content')
    <section>



        <div class="columns is-multiline is-centered m-2">

            @foreach($adresses as $adress)
                <div class="column box m-1 is-one-quarter overflow-hidden">
                    <div class="is-flex justify-content-center">
                        @if($adress->image)
                            <img
                                style="width:300px;height:300px" class="image"
                                src="{{ asset('storage/' . $adress->image) }}" alt="adress Image">
                        @endif
                    </div>
                    <h2 class="is-flex mt-2">{{$adress->name}}</h2>
                    <div class="level ml-1 mr-1 mb-0">

                        <p class="is-flex "> Straat : {{ $adress->street ?? 'Uncategorized' }}</p>
                        <p class="is-flex ">Huisnummer : {{ $adress->housenumber ?? 'Uncategorized' }}</p>
                        <p class="is-flex ">Postcode : {{ $adress->zipcode ?? 'Uncategorized' }}</p>
                        <p class="is-flex" >Stad : {{ $adress->city ?? 'Uncategorized' }}</p>
                        <p class="is-flex" >Land : {{ $adress->country->name  ?? 'Uncategorized' }}</p>


                    </div>

                    <div class="buttons is-centered ">

                                <a class="button is-success is-small text-decoration-none" href="{{ route('adresses.edit', $adress->id) }}">Edit</a>

                        <a class="button is-info is-small text-decoration-none" href="/adresses/{{$adress->id}}">Info</a>

                                <form action="{{ route('adresses.destroy', $adress->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf

                                    <button class="button is-danger is-small " type="submit">Delete</button>
                                </form>

                    </div>
                </div>
            @endforeach
    </section>
@endsection
