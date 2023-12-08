@extends('layouts.app')

<!-- show video details -->
@section('content')
            <div class="col-md-8 is-flex" style="margin:auto">

                <div class="column box is-one-quarter overflow-hidden " style="width:25vw;margin:auto">
                    Straat :
                    {{ $adress->street }}
                        <p>{{ $adress->housenumber }}</p>
                        @auth()
                            @csrf
                        <p> Created at {{ $adress->created_at}}</p>
                        @endauth
                    <a href="javascript:history.back()" class="btn btn-primary">Back</a>

                </div>
        </div>




@endsection
