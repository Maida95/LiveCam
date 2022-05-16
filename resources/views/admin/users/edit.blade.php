@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Izmijenite privilegije korisnika "{{ $user->name }}"</h5>
                </div>

                <div class="card-body">

                    {!! Form::open(['action' => ['App\Http\Controllers\Admin\UsersController@update', $user], 'method' => 'PUT']) !!}
                        
                        <div class="row mb-3">
                            <label for="email" class="col-md-2 col-form-label text-md-end">E-mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-2 col-form-label text-md-end">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label for="roles" class="col-md-2 col-form-label text-md-end">Roles</label>
                            <div class="col-md-6">
                            @foreach($roles as $role)
                                    <div class="form-check">
                                        <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                        @if($user->hasRole($role->name)) checked @endif>
                                        <label>{{ $role->name }}</label>
                                    </div>    
                            @endforeach
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            {{Form::submit('Update', ['class' => 'btn btn-primary pull-right' ])}}
                        </div>
                             
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
                    