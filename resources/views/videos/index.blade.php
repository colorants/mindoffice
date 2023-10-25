@extends ('layouts.app')

@section('content')
    <section>
        <div>

            <div class=" m-3 is-flex justify-content-between">

                <h1> Homepage </h1>

                <form action="{{ route('videos.search') }}" method="GET">
                    <input type="text" name="query" placeholder="Search videos...">
                    <button type="submit">Search</button>
                </form>

            </div>
        </div>





        <div class="columns is-multiline is-centered">

            @foreach($videos as $video)

                <div class="column box m-1 is-one-quarter overflow-hidden">
                    <div class="is-flex justify-content-center">
                        @if($video->image)
                            <img
                                style="width:300px;height:300px" class="image has-border"
                                src="{{ asset('storage/' . $video->image) }}" alt="Video Image">
                        @endif
                    </div>
                    <h2 class="is-flex mt-2">{{$video->title}}</h2>
                    <div class="level ml-1 mr-1 mb-0">
                        <p class="is-flex ">{{ $video->category->title ?? 'Uncategorized' }}</p>
                        <p class="is-flex ">{{ $video->user->name ?? 'Uncategorized' }}</p>
                    </div>

                    <div class="buttons is-centered ">

                        @auth()
                            @if(Auth::user()->id === $video->user_id || Auth::user()->is_admin == 1)
                                @csrf
                                <a class="button is-success is-small text-decoration-none" href="{{ route('videos.edit', $video->id) }}">Edit</a>
                            @endauth
                        @endif

                        <a class="button is-info is-small text-decoration-none" href="/videos/{{$video->id}}">Info</a>
                        @auth()
                            @if(Auth::user()->id === $video->user_id || Auth::user()->is_admin == 1)
                                <form action="{{ route('videos.destroy', $video->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="button is-danger is-small " type="submit">Delete</button>
                                    @endauth
                                    @endif

                                </form>
                                @if(auth()->check())
                                    @if (Auth::user()->favoriteVideos->doesntcontain($video))
                                        <form action="{{ route('videos.favorite.toggle', $video->id) }}" method="POST">
                                            @csrf
                                            <button class="button is-warning is-small " type="submit">Favorite</button>
                                        </form>
                                    @endif

                                    @if (Auth::user()->favoriteVideos->Contains($video))
                                        <form action="{{ route('videos.favorite.toggle', $video->id) }}" method="POST">
                                            @csrf
                                            <button class="button is-warning is-small " type="submit">Un-Favorite</button>
                                        </form>
                                    @endif
                                @endif

                    </div>
                </div>

            @endforeach

        </div>
    </section>
@endsection
