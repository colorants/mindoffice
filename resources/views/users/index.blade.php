
@extends ('layouts.navbar')

@section('content')
    <section>
        <div class="columns is-center">

            @foreach($users as $user)
                <div class="column">
                    <h2>{{$user->name}}</h2>
                    <p>{{$user->email}}</p>
                </div>

            @endforeach

        </div>
    </section>
@endsection
