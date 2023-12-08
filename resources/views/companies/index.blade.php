
@extends ('layouts.app')

@section('content')
    <section>
        <div class="is-flex pb-0">
        <h1 class="is-flex is-center ml-2"> Alle bedrijven </h1>
{{--       --}}
        </div>

        <div class="columns mt-3 is-multiline is-centered">

            @foreach($companies as $company)
                <div class="column box m-1 is-one-quarter overflow-hidden">
                    <div class="is-flex justify-content-center">


            <div class="column box">
                <ul>

                    <p class="is-flex "> Bedrijfsnaam : {{ $company->name ?? 'Uncategorized' }}</p>
                    <p class="is-flex "> KVK : {{ $company->kvk ?? 'Uncategorized' }}</p>
                    <p class="is-flex ">BTW : {{ $company->btw ?? 'Uncategorized' }}</p>
                    <p class="is-flex "> Land : {{ $company->country_id ?? 'Uncategorized' }}</p>
                    <p class="is-flex "> Adres : {{ $company->address_id ?? 'Uncategorized' }}</p>
                    <a class="button is-success is-small text-decoration-none m-2" href="{{ route('companies.edit', $company->id) }}">     <i style="font-size:24px" class="fa">&#xf040;</i></a>

                </ul>
            </div>
                    </div>
            </div>
        </div>
        </div>
    </section>
    @endforeach
@endsection
