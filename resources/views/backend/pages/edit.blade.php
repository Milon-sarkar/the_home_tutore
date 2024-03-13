@extends('backend.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.css') }}">
@endsection

@section('content')
    <form action="{{ route('admin_page.update', $page->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10">
                <div class="card-box">
                    <h2 class="header-title text-center">Update Page</h2>
                    <div class="form-group">
                        <label for="">Page Title</label>
                        <input type="text" value="{{ $page->title }}" name="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Page Banner/Thumbnail (1280x720)</label>
                        <input type="file" name="banner" class="form-control">
                        <span><img style="width: 50px;height:50px" src="{{ $page->banner }}" alt=""> </span>
                    </div>
                    <div class="form-group">
                        <label for="">Page Content</label>
                        <textarea name="details" class="ckeditor form-control">{{ $page->details }}</textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Update Page</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script src="{{ asset('backend/js/ajax_jquery.min.js') }}"></script>
    <script src="{{ asset('backend/js/ckeditor.js') }}"></script>
    <script>
        ClassicEditor
        .create( document.querySelector( '.ckeditor' ) )
        .catch( error => {
        console.error( error );
        } );
        </script>
@endsection


@section('javascript')
    <script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>

    <script>
        jQuery(document).ready(function() {
            $('.summernote').summernote({
                height: 470,                 // set editor height
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
