@extends('layouts.app')

@section('content')
    <section>
        <h1 class="is-flex is-center m-3"> All Users </h1>
        <div class="row m-1">
            @foreach($users as $user)
                <div class="col-md-3">
                    <div class="box m-1 {{ $user->is_admin ? 'admin-border' : '' }}">
                        <ul>
                            <li>Name: {{ $user->name }}</li>
                            <li>Email: <strong>{{ $user->email }}</strong></li>
                            <li>Admin: {{ $user->is_admin }}</li>
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
