@extends('backend.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.css') }}">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card-box">
                <h2 class="header-title">
                    SMS Template List
                </h2>
                <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <tr>
                        <th>Serial</th>
                        <th>Title</th>
                        <th>Body</th>
                        <th>Action</th>
                    </tr>
                    @forelse($sms_templates as $sms_template)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $sms_template->title }}</td>
                        <td>{{ $sms_template->body }}</td>
                        <td class="d-flex justify-content-around">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit_{{ $sms_template->id }}">
                                <i class="fa fa-edit"></i>
                            </button>
                            <div class="modal text-left fade" id="edit_{{ $sms_template->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update SMS Template</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('sms_templates.update', $sms_template->id) }}" method="POST">
                                            @method("PUT")
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="">Title</label>
                                                    <input type="text" class="form-control" value="{{ $sms_template->title }}" name="title">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Type</label>
                                                    <select name="type" class="form-control" id="">
                                                        <option value="general" {{ $sms_template->type == 'general' ? 'selected' : '' }}>General</option>
                                                        <option value="guardian_student" {{ $sms_template->type == 'guardian_student' ? 'selected' : '' }}>Guardian and Student</option>
                                                    </select>
                                                </div>
                                                <label for="">Body</label>
                                                <textarea name="body" id="body" cols="30" rows="10" class="form-control"  style="height: 150px">{{ $sms_template->body }}</textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>



                            <form action="{{ route('sms_templates.destroy', $sms_template->id) }}" method="POST">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete this SMS Template?')"> <i class="fa fa-trash"></i> </button>
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
                    Add a new SMS Template
                </h2>
                <form action="{{ route('sms_templates.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" class="form-control" name="title">
                    </div>
                    <div class="form-group">
                        <label for="">Type</label>
                        <select name="type" class="form-control" id="">
                            <option value="general">General</option>
                            <option value="guardian_student">Guardian and Student</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Body</label>
                        <textarea name="body" id="" cols="30" rows="10" class="form-control" style="height: 150px"></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Add SMS Template</button>
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
