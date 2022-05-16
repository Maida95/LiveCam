@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>{{ __('Korisnici') }}</h5>
                </div>

                <div class="card-body">

                    <table class="table table-striped">
{{-- setting colum width: <th class="col-sm-3"> --}}
                                    <tr>
                                        <th>#</th>
                                        <th>Ime korisnika</th>
                                        <th>E-mail</th>
                                        <th>Privilegija</th>
                                        <th>Akcija</th>
                                    </tr>
                                        @foreach($users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</td>
                                                {{-- loop through all the roles attached to the user and print them, comma separated  --}}
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('admin.users.edit', $user->id) }}"><button type="button" class="btn btn-light btn-sm mr-10">Edit</button></a>
                                                        <form action="{{ route('admin.users.destroy', $user) }}" method="DELETE">
                                                            <button type="button" class="btn btn-dark btn-sm">Delete</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                        </table>
                        
            </div>

                </div>
            </div>
        </div>
    </div>
@endsection
