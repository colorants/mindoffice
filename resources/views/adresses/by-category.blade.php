@extends ('layouts.navbar')

@section('content')
<section>
    @foreach($category->adresss as $adress)
        <div>
            <h2>{{$adress->title}}</h2>
            <p>{{$adress->description}}</p>
        </div>
        @endforeach
</section>
@endsection
