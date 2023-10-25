
@extends ('layouts.app')

@section('content')

    <h1 class="is-flex is-center m-3"> Categories </h1>
    <section>
        <div class="columns is-multiline is-centered" >

            @foreach($categories as $category)

                <div class="column mt-3 box m-1 is-one-quarter">
                    <a >
                        <h2 class="is-flex is-justify-content-center">{{$category->title}}</h2>
                    </a>
                    <p class="is-flex is-justify-content-center" >{{$category->description}}</p>
                    <div class="buttons is-centered mt-3">
                        @auth()
                            @csrf
                            <a class="button is-success is-small" href="{{ route('categories.edit', $category->id) }}">Edit</a>
                        @endauth

                        <a class="button is-info is-small" href="/categories/{{$category->id}}" >Info</a>

                        @auth()

                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
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
