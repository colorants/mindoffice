
@extends ('layouts.app')

@section('content')

    <h1 class="is-flex is-center"> Homepage </h1>
    <section>
        <div class="columns is-multiline is-centered" >

        @foreach($videos as $video)



                <div class="column box m-1 is-one-quarter">
                    @if($video->image)
                        <img height="200" width="200"
                             class="image has-border" src="{{ asset('storage/' . $video->image) }}" alt="Video Image">
                    @endif
                <h2 class="is-flex ">{{$video->title}}</h2>
                        <div class="level ml-1 mr-1 mb-0">



                    <p class="is-flex " >{{ $video->category->title ?? 'Uncategorized' }}</p>
                        <p class="is-flex " >{{ $video->user->name ?? 'Uncategorized' }}</p>
                        </div>

                        <div class="buttons is-centered ">
@auth()
    @csrf
                            <a class="button is-success is-small" href="{{ route('videos.edit', $video->id) }}">Edit</a>
@endauth

                        <a class="button is-info is-small" href="/videos/{{$video->id}}" >Info</a>
                        @auth()

                        <form action="{{ route('videos.destroy', $video->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="button is-danger is-small " type="submit">Delete</button>
                            @endauth
                        </form>
        <a href="#" class="favorite-button" data-video-id="{{ $video->id }}">Favorite</a>

                    </div>
                </div>




        @endforeach

        </div>
    </section>
@endsection
