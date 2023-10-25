@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">{{ __('Welcome to Blips') }}</div>

                    <p class="m-2">
                        Cupcake ipsum dolor sit amet carrot cake. Pie fruitcake icing lemon drops shortbread marshmallow pie tiramisu. Oat cake chocolate tart marzipan tiramisu sugar plum I love. Ice cream dragée soufflé I love lollipop chocolate soufflé. Wafer cotton candy I love marshmallow I love lollipop chocolate bar cookie. Cotton candy liquorice cookie tootsie roll jujubes biscuit. I love donut cake danish candy icing carrot cake toffee. Toffee gummies I love gummi bears tootsie roll donut soufflé.
                    </p>



                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <a href="{{ route('videos.index') }}" class="btn btn-primary">Go Videos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
