@extends('backend.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.css') }}">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card-box">
                <h2 class="header-title">
                    Subject List
                </h2>
                <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <tr>
                        <th>Serial</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Code</th>
                        <th>Action</th>
                    </tr>
                    @forelse($subjects as $subject)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $subject->name }}</td>
                        <td>{{ $subject->description }}</td>
                        <td>{{ $subject->code }}</td>
                        <td>
                            <form action="{{ route('subject.destroy', $subject->id) }}" method="POST">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit_{{ $subject->id }}">
                                   <i class="fa fa-edit"></i>
                                </button>
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete this Subject?')"> <i class="fa fa-trash"></i> </button>
                            </form>



                            <!-- Modal -->
                            <div class="modal text-left fade" id="edit_{{ $subject->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update Subject</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('subject.update', $subject->id) }}" method="POST">
                                            @method("PUT")
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="">Name</label>
                                                    <input type="text" class="form-control" value="{{ $subject->name }}" name="name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Description</label>
                                                    <textarea name="description" class="summernote form-control">{{ $subject->description }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Code</label>
                                                    <input type="number" class="form-control" value="{{ $subject->code }}" name="code">
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
                    Add a new Subject
                </h2>
                <form action="{{ route('subject.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" class="summernote form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Code</label>
                        <input type="text" class="form-control" name="code">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Add Subject</button>
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
