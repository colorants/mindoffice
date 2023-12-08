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
{{--                            <li>Company:{{ $user->company_id->name}}</li>--}}
                            <li>Email: <strong>{{ $user->email }}</strong></li>
                            <li>Admin:
                                @if ($user->is_admin)
                                    <strong>Yes</strong>
                                @else
                                    <strong>No</strong>
                                @endif
                            </li>

                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="button is-danger is-small " type="submit">Delete</button>
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
        <script>
            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', () => {
                    location.reload();
                });
            });
        </script>
    </section>
@endsection
