@extends('backend.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.css') }}">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card-box">
                <h2 class="header-title">
                    Banner Image  List
                </h2>
                <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <tr>
                        <th>Banner Image</th>
                        <th>Action</th>
                    </tr>
                    @forelse($hireBanners as $title_template)
                    <tr>
                        {{-- <td>{{ $loop->index + 1 }}</td> --}}
                        <td>
                            <img src="{{ asset('storage/' . $title_template->image) }}" alt="Banner Image" width="50">
                        </td>
                        {{-- <td>{{ $title_template->body }}</td> --}}
                        <td class="d-flex justify-content-around">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit_{{ $title_template->id }}">
                                <i class="fa fa-edit"></i>
                            </button>
                            <div class="modal text-left fade" id="edit_{{ $title_template->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update Title Template</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('hire_banner_image.update', $title_template->id) }}" method="POST" enctype="multipart/form-data">
                                            @method("PUT")
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="">Banner Image</label>
                                                    <input type="file" class="form-control" name="image">
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



                            <form action="{{ route('hire_banner_image.destroy', $title_template->id) }}" method="POST">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete this Title Template?')"> <i class="fa fa-trash"></i> </button>
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
                    Add a new Banner Image
                </h2>
                <form action="{{ route('hire_banner_image.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Banner Image</label>
                        <input type="file" class="form-control" name="image">
                    </div>
                
                    
                    {{-- <div class="form-group">
                        <label for="">Type</label>
                        <select name="type" class="form-control" id="">
                            <option value="general">General</option>
                            <option value="guardian_student">Guardian and Student</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Body</label>
                        <textarea name="body" id="" cols="30" rows="10" class="form-control" style="height: 150px"></textarea>
                    </div> --}}
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Add Banner Image</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
    {{-- @section('javascript')
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
@endsection --}}
