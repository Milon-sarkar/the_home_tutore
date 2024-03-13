@extends('backend.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.css') }}">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card-box">
                <h2 class="header-title">
                    Home page video
                </h2>
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Home video</th>
                            <th>Action</th>
                        </tr>

                        @forelse($HomeVideos as $title_template)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>
                                        <img src="{{ asset('storage/' . $title_template->image) }}" alt="Banner Image" width="50">
                                    </td>
                                <td>
                                    <video width="50" controls>
                                        <source src="{{ asset('storage/' . $title_template->video) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </td>

                                {{-- <td>{{ $title_template->body }}</td> --}}
                                <td class="d-flex justify-content-around">
                                    {{-- <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#edit_{{ $title_template->id }}">
                                        <i class="fa fa-edit"></i>
                                    </button> --}}
                                    <div class="modal text-left fade" id="edit_{{ $title_template->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Update Title Template
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('home_page_video.update', $title_template->id) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="video">Video:</label>
                                                            <input type="file" name="video" accept="video/*" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="video">Image:</label>
                                                            <input type="file" name="image"  required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>



                                    <form action="{{ route('home_page_video.destroy', $title_template->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure to delete this Title Video?')"> <i
                                                class="fa fa-trash"></i> </button>
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
                    Add a new Home Video
                </h2>
                <form action="{{ route('home_page_video.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="video">Video:</label>
                        <input type="file" name="video" accept="video/*" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Image:</label>
                        <input type="file" name="image" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Add Video</button>
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
