@extends('backend.layouts.app')

@section('content')


    <div class="bg-light p-4 rounded">
        <h2>Permissions</h2>
        <div class="lead">
            Manage your permissions here.
            <a href="{{ route('permissions.create') }}" class="btn btn-primary btn-sm float-right">Add permissions</a>
        </div>


        <div class="table-responsive">
        <table class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap" cellspacing="0" width="100%" id="datatable-buttons">
            <thead>
            <tr>
                <th scope="col" width="15%">Name</th>
                <th scope="col">Guard</th>
                <th scope="col" colspan="3" width="1%">Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->guard_name }}</td>
                        <td><a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-info btn-sm">Edit</a></td>
                        <td>
                            {!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permission->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>

    </div>
    <script src="{{ asset('backend/js/ajax_jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable').DataTable({

            });

            //Buttons examples
            var table = $('#datatable-buttons').DataTable({
                "order": [[ 1, "desc" ]],
                lengthChange: false,
                "pageLength": 30,
                buttons: ['copy',
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: ':visible'
                        },
                        orientation: 'landscape',
                    }, 'colvis'],
                "columnDefs": [
                    {
                        "targets": [7,8,9,10],
                        "visible": false
                    },
                ]
            });

            table.buttons().container()
                .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
        } );


    </script>
@endsection
