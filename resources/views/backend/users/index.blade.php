@extends('backend.layouts.app')

@section('content')



    <div class="bg-light p-4 rounded">
        <h1>Users</h1>
        <div class="lead">
            Manage your users here.
            <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-right">Add new user</a>
        </div>


        <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col" width="1%">#</th>
                <th scope="col" width="15%">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Status</th>
                <th scope="col" width="10%">Username</th>
                <th scope="col" width="10%">Roles</th>
                <th scope="col" class="text-center" width="1%" colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td scope="row">{{ $loop->index+1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->status == 1 ? 'active' : 'inactive' }}</td>
                        <td>{{ $user->username }}</td>
                        <td>
                            @if($user->user_type != 'admin')
                                @if($user->user_type == 'tutor')
                                    <span class="badge bg-info">Tutor</span>
                                @endif
                                @if($user->user_type == 'student')
                                    <span class="badge bg-success">Student</span>
                                @endif
                                @if($user->user_type == 'guardian')
                                    <span class="badge bg-primary">Primary</span>
                                @endif
                            @elseif($user->user_type == 'admin')
                                @foreach($user->getRoleNames() as $role_name)
                                    <span class="badge bg-dark">{{ $role_name }}</span>
                                @endforeach
                            @endif
                        </td>
                        <td><a href="{{ route('users.show', $user->id) }}" class="btn btn-warning btn-sm">Show</a></td>
                        <td><a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-sm">Edit</a></td>
                        <td>
{{--                            {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}--}}
{{--                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}--}}
{{--                            {!! Form::close() !!}--}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>

        <div class="d-flex">
            {!! $users->links() !!}
        </div>

    </div>
@endsection
