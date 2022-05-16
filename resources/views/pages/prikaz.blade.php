@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}}

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <br>
                    <h3>Prikaz postojećih kamera</h3>

                    @if(count($forms) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th>ID</th>
                                <th></th>
                                <th></th>
                            </tr>
                                @foreach($forms as $form)
                                    <tr>
                                        <td>{{$form->text}}</td>
                                        <td><a href="/posts/{{ $form->id }}/edit" class="btn btn-light ">Edit</a></td>
                                        <td>
                                            {!! Form::open(['action' => ['App\Http\Controllers\PostsController@destroy', $form->id], 'method' => 'DELETE', 'class' => 'pull-right' ]) !!}
                                            {{ Form::submit('Delete',['class' => 'btn btn-dark']) }}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                        </table>
                    @else
                        <p> You have no posts </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection