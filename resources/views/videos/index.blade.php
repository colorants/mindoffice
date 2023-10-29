@extends('layouts.app')

@section('content')
    <section>


            <form action="{{ route('videos.index') }}" method="GET" class=" d-flex align-items-center form-inline w-100">
                <div class="form-group ml-2 mr-2 mb-2 is-flex ">
                    <input type="text" name="query" class="form-control w-100" placeholder="Search videos..." value="{{ $query }}">
                </div>

                <div class="form-group mr-2 mb-2">
                    <select name="sort_by" class="form-control">
                        <option value="created_at" {{ $sort_by == 'created_at' ? 'selected' : '' }}>Created at</option>
                        <option value="title" {{ $sort_by == 'title' ? 'selected' : '' }}>Title</option>
                    </select>
                </div>

                <div class="form-group mr-2 mb-2">
                    <select name="sort_order" class="form-control">
                        <option value="desc" {{ $sort_order == 'desc' ? 'selected' : '' }}>Descending</option>
                        <option value="asc" {{ $sort_order == 'asc' ? 'selected' : '' }}>Ascending</option>
                    </select>
                </div>


                <button type="submit" class="btn btn-primary mb-2 ml-2">Search</button>
            </form>




    @if(!$sort_by || !$sort_order || $query)
            <div class="alert alert-info  ml-2 w-50 mb-4 is-flex">
                <div>
                    @if($query)
                        Showing results for : <strong>{{ $query }}</strong>
                    @endif
                </div>

                <div class="is-flex justify-items-end">
                    @if($sort_by && $query)
                        , Sorted by : ⠀ <strong>{{ ucfirst($sort_by) }}</strong>⠀
                    @elseif($sort_by)
                        Sorting by :⠀ <strong>{{ ucfirst($sort_by) }}</strong>⠀
                    @endif
                </div>

                <div class="is-flex justify-items-end">
                    @if($sort_by && $query && $sort_order)
                        , Order :   ⠀<strong>{{ ucfirst($sort_order) }}</strong>⠀
                    @elseif($sort_by)
                       Order :  ⠀<strong>{{ ucfirst($sort_order) }}</strong>⠀
                    @endif
                </div>
            </div>
        @endif





        <div class="columns is-multiline is-centered m-2">

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
