@extends('backend.layouts.app')

@section('content')


    <div class="bg-light p-4 rounded">
        <h1>Users</h1>
        <div class="lead">
            Manage your users here.
            <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-right">Add new user</a>
        </div>
        


        <table class="table table-bordered" id="user_table">
            <thead>
            <tr>
                <th scope="col" width="1%">#</th>
                <th scope="col" width="15%">Name</th>
                <th scope="col">Email</th>
                <th scope="col" width="10%">Username</th>
                <th scope="col" width="10%">Roles</th>
                <th scope="col" class="text-center" width="1%" colspan="3">Action</th>    
            </tr>
            </thead>
            <tbody>
               
            </tbody>
        </table>

        

    </div>
    <script src="{{ asset('backend/js/ajax_jquery.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#user_table').DataTable({
                responsive: true,
                deferRender: true,
                serverSide: true,
                processing: true,
                bLengthChange: true,
                searchDelay: 500,
                pageLength: 10,
                ajax: "{{ url('users-list') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'username', name: 'username'},
                    {data: 'roles', name: 'roles'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
            });
        });
    </script>
@endsection
