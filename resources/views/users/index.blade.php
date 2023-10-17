
@extends ('layouts.app')

@section('content')
    <section>
        <h1 class="is-flex is-center ml-2"> Users </h1>
        <div class="columns">

            @foreach($users as $user)
                <div class="column box">
                    <ul>
                    <p>Name : {{$user->name}}</p>
            <p > Email : <strong>{{$user->email}}</strong></p>
                   <p> Admin : {{$user->is_admin}}</p>
                    </ul>
{{--                    <form method="POST" action="{{ route('users.update', $user->id) }}">--}}
{{--                        @csrf--}}
{{--                        @method('PUT')--}}

{{--                        <div class="form-group">--}}
{{--                            <label for="is_admin">Set as Admin:</label>--}}
{{--                            <input type="checkbox" name="is_admin" {{ $user->is_admin ? 'checked' : '' }}>--}}
{{--                        </div>--}}

{{--                        <button type="submit">Save</button>--}}
{{--                    </form>--}}

                    <button class="ml-2 is-flex button is-danger is-small" type="submit">Delete</button>
                </div>

            @endforeach

        </div>
    </section>
@endsection
