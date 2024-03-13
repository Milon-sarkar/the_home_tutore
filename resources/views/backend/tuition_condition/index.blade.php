@extends('backend.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.css') }}">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card-box">
                <h2 class="header-title">
                    Tuition Condition Template List
                </h2>
                <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <tr>
                        <th>Serial</th>
                        <th>Title</th>
                        <th>Body</th>
                        <th>Action</th>
                    </tr>
                    @forelse($tuition_conditions as $tuition_condition)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $tuition_condition->title }}</td>
                        <td>{{ $tuition_condition->body }}</td>
                        <td class="d-flex justify-content-around">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit_{{ $tuition_condition->id }}">
                                <i class="fa fa-edit"></i>
                            </button>
                            <div class="modal text-left fade" id="edit_{{ $tuition_condition->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update Tuition Condition Template</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('tuition_condition_templates.update', $tuition_condition->id) }}" method="POST">
                                            @method("PUT")
                                            @csrf
                                            <input type="hidden" name="tuition_condition_id" value="{{ $tuition_condition->id }}">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="">Title</label>
                                                    <input type="text" class="form-control" value="{{ $tuition_condition->title }}" name="title">
                                                </div>
                                                <label for="">Body</label>
                                                <textarea name="body" id="body" cols="30" rows="10" class="form-control"  style="height: 150px">{{ $tuition_condition->body }}</textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <form action="{{ route('tuition_condition_templates.destroy', $tuition_condition->id) }}" method="POST">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete this Tuition Condition Template?')"> <i class="fa fa-trash"></i> </button>
                            </form>


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
                    Add a new Tuition Condition Template
                </h2>
                <form action="{{ route('tuition_condition_templates.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" class="form-control" name="title">
                    </div>
                    <div class="form-group">
                        <label for="">Body</label>
                        <textarea name="body" id="" cols="30" rows="10" class="form-control" style="height: 150px"></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Add Tuition Condition Template</button>
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
