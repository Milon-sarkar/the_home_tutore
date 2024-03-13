@extends('backend.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.css') }}">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card-box">
                <h2 class="header-title">
                    Tutor Institute Type List
                </h2>
                <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <tr>
                        <th>Serial</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                    @forelse($tutor_faculties as $tutor_institute_type)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $tutor_institute_type->name }}</td>
                        <td>
                            <form action="{{ route('tutor_institute_type.destroy', $tutor_institute_type->id) }}" method="POST">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit_{{ $tutor_institute_type->id }}">
                                   <i class="fa fa-edit"></i>
                                </button>
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete this Tutor Institute Type?')"> <i class="fa fa-trash"></i> </button>
                            </form>



                            <!-- Modal -->
                            <div class="modal text-left fade" id="edit_{{ $tutor_institute_type->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update Tutor Institute Type</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('tutor_institute_type.update', $tutor_institute_type->id) }}" method="POST">
                                            @method("PUT")
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="">Name</label>
                                                    <input type="text" class="form-control" value="{{ $tutor_institute_type->name }}" name="name">
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
                    Add a new Tutor Institute Type
                </h2>
                <form action="{{ route('tutor_institute_type.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Add Tutor Institute Type</button>
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
