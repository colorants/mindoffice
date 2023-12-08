@extends('layouts.app')

@section('content')
    <section>
        <h1 class="is-flex is-center m-3"> All companies </h1>
        <div class="row m-1">
            @foreach($companies as $company)

                <div class="col-md-3">
                    <div class="box m-1 {{ $company->is_admin ? 'admin-border' : '' }}">
                        <ul>
                            <li>Name: {{ $company->name }}</li>
                            <li>Email: <strong>{{ $company->email }}</strong></li>
                            <li>Admin: {{ $company->is_admin }}</li>

                            @if ($company->is_admin && $company->id !== auth()->company()->id)
                                <form action="{{ route('companies.remove-admin', $company->id) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="button is-danger is-small m-2">Remove Admin</button>
                                </form>
                            @endif

                            @if(!$company->is_admin && $company->id !== auth()->company()->id)
                                <form action="{{ route('companies.make-admin', $company->id) }}" method="POST">
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
