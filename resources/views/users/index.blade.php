
@extends ('layouts.app')

@section('content')
    <section>
        <div class="is-flex pb-0">
        <h1 class="is-flex is-center ml-2"> Profile  </h1>
        <a class="button is-success is-small text-decoration-none m-2" href="{{ route('users.edit', $user->id) }}">     <i style="font-size:24px" class="fa">&#xf040;</i></a>
        </div>

        <div class="columns mt-3 is-multiline is-centered">

            <div class="column box">
                <ul>

                    <p>ID : {{Auth::user()->id}}</p>
                    <p>Name :  {{ Auth::user()->name }}</p>
                    <p > Email : <strong> {{ Auth::user()->email }}</strong></p>
                </ul>

            </div>
        </div>



            <h1 class="is-flex is-center ml-2">  Favorites ({{ count(Auth::user()->favoriteVideos) }})</h1>


             <div class="columns ml-3 mt-3 is-multiline ">
                     @foreach(Auth::user()->favoriteVideos as $favorite)
                    <div class="column box m-1 is-one-quarter overflow-hidden">
                        <div class="is-flex justify-content-center mb-2" >
                            @if($favorite->image)
                                <img
                                    style="width:300px;height:300px" class="image has-border"
                                    src="{{ asset('storage/' . $favorite->image) }}" alt="Video Image">
                            @endif
                        </div>
                        <h2 class="is-flex ml-1">{{$favorite->title}}</h2>

                        <div class="level ml-1 mr-1 mb-0">
                            <p class="is-flex ">{{ $favorite->category->title ?? 'Uncategorized' }}</p>
                            <p class="is-flex ">{{ $favorite->user->name ?? 'Uncategorized' }}</p>
                        </div>
    <a class="button is-info is-small text-decoration-none" href="/videos/{{$favorite->id}}">Info</a>
                    </div>

                 @endforeach




        </div>
    </section>
@endsection
