@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h2 class="header-title mb-4">All Page List</h2>
                <div class="table-responsive">
                <table class="table text-center table-bordered table-hover">
                    <tr>
                        <th>Serial</th>
                        <th>Title</th>
                        <th>Banner</th>
                        <th>Created At</th>
                        <th>Last Update</th>
                        <th>Action</th>
                    </tr>
                    @forelse($pages as $page)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $page->title }}</td>
                            <td><img src="{{ asset('storage') }}/{{ $page->banner }}" height="50" alt=""></td>
                            <td>{{ date_format(date_create($page->created_at), 'd-m-Y') }}</td>
                            <td>{{ $page->updated_at->diffForHumans() }}</td>
                            <td>
                                <a href="{{ route('admin_page.edit', $page->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                @if($page->id != 1 && $page->id != 2)
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#delete{{ $page->id }}">
                                    <i class="fa fa-trash"></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="delete{{ $page->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Page</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('admin_page.destroy', $page->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <div class="modal-body">
                                                    <h3>Are you sure to delete this item?</h3>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10">No Pages Found</td>
                        </tr>
                    @endforelse
                </table>
                </div>
            </div>
        </div>
    </div>
@endsection
