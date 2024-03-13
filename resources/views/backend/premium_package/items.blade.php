@extends('backend.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.css') }}">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card-box">
                <h2 class="header-title">
                    Premium Package Items
                </h2>
                <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <tr>
                        <th style="width: 5%;">No.</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    @forelse($premium_package_items as $premium_package_item)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $premium_package_item->name }}</td>
                        <td>{!! $premium_package_item->status == 1 ? '<span class="badge badge-info badge-sm">Active</span>' : '<span class="badge badge-danger badge-sm">In-Active</span>' !!}</td>
                        <td>
                            <form action="{{ route('premium_package_items.destroy', $premium_package_item->id) }}" method="POST">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit_{{ $premium_package_item->id }}">
                                   <i class="fa fa-edit"></i>
                                </button>
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete this Premium Package?')"> <i class="fa fa-trash"></i> </button>
                            </form>



                            <!-- Modal -->
                            <div class="modal text-left fade" id="edit_{{ $premium_package_item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update Premium Package</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('premium_package_items.update', $premium_package_item->id) }}" method="POST">
                                            @method("PUT")
                                            @csrf
                                            <div class="modal-body">

                                                <div class="form-group">
                                                    <label for="">Name</label>
                                                    <input type="text" class="form-control" name="edit_name" value="{{ $premium_package_item->name }}">
                                                    @error('edit_name')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Status</label>
                                                    <select name="edit_status" id="" class="form-control select2">
                                                        <option value="1">Active</option>
                                                        <option value="0">In-Active</option>
                                                    </select>
                                                    @error('edit_status')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="10">No Data Found</td>
                        </tr>
                    @endforelse
                </table>
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="card-box">
                <h2 class="header_title">
                    Add a new Premium Package Items
                </h2>
                <form action="{{ route('premium_package_items.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" id="" class="form-control select2">
                            <option value="1">Active</option>
                            <option value="0">In-Active</option>
                        </select>
                        @error('status')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Add Premium Package</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
    @section('javascript')
    <script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>

    <script>
        jQuery(document).ready(function() {
            $('.summernote').summernote({
                height: 530,                 // set editor height
                toolbar: [
                    [ 'style', [ 'style' ] ],
                    [ 'font', [ 'bold', 'italic', 'underline'] ],
                    [ 'fontsize', [ 'fontsize' ] ],
                    [ 'color', [ 'color' ] ],
                    [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
                    [ 'table', [ 'table' ] ],
                    [ 'insert', [ 'link'] ],
                    [ 'view', [ 'undo', 'redo', 'fullscreen', ] ]
                ]
            });
        })
    </script>
@endsection
