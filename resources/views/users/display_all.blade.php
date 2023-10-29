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

                            @if ($user->is_admin && $user->id !== auth()->user()->id)
                                <form action="{{ route('users.remove-admin', $user->id) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="button is-danger is-small m-2">Remove Admin</button>
                                </form>
                            @endif

                            @if(!$user->is_admin && $user->id !== auth()->user()->id)
                                <form action="{{ route('users.make-admin', $user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="button is-success is-small m-2">Make Admin</button>
                                </form>
                            @endif
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
