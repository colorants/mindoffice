
@extends ('layouts.navbar')

@section('content')
    <section>
        <div class="columns">

        @foreach($videos as $video)
                <div class="column mt-4">
                <h2 class="is-flex is-justify-content-center">{{$video->title}}</h2>
                <p class="is-flex is-justify-content-center" >{{$video->description}}</p>
                </div>

        @endforeach

        </div>
    </section>
@endsection
