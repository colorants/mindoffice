
@extends ('layouts.navbar')

@section('content')
    <section>
        <div class="columns is-center">

        @foreach($videos as $video)
                <div class="column is-one-quarter">
                <h2>{{$video->title}}</h2>
                <p>{{$video->description}}</p>
                </div>

        @endforeach

        </div>
    </section>
@endsection
