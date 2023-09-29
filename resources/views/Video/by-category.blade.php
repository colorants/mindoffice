@extends ('layouts.navbar')

@section('content')
<section>
    @foreach($category->videos as $video)
        <div>
            <h2>{{$video->title}}</h2>
            <p>{{$video->description}}</p>
        </div>
        @endforeach
</section>
@endsection
