
@extends ('layouts.app')

@section('content')
    <section>
        <h1 class="is-flex is-center ml-2"> Profile  </h1>
        <div class="columns">

                <div class="column box">
                    <ul>

                    <p>Name :  {{ Auth::user()->name }}</p>
            <p > Email : <strong> {{ Auth::user()->email }}</strong></p>
                    </ul>
                </div>

        </div>
    </section>
@endsection
