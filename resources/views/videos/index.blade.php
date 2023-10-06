
@extends ('layouts.app')

@section('content')
    <section>
        <div class="columns is-multiline is-centered" >

        @foreach($videos as $video)

                <div class="column mt-3 box m-1 is-one-quarter">
                    <a >
                <h2 class="is-flex is-justify-content-center">{{$video->title}}</h2>
                    </a>
                <p class="is-flex is-justify-content-center" >{{$video->description}}</p>
                    <div class="buttons is-centered mt-3">

                        <a class="button is-success is-small" href="/videos/{{$video->id}}/edit" >Edit</a>
                        <a class="button is-info is-small" href="/videos/{{$video->id}}" >Info</a>

                        @auth()

                        <form action="{{ route('videos.destroy', $video->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="button is-danger is-small " type="submit">Delete</button>
                            @endauth
                        </form>

                    </div>
                </div>




        @endforeach

        </div>
    </section>
@endsection
