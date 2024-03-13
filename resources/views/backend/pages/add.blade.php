@extends('backend.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.css') }}">
@endsection

@section('content')
<link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.css') }}">
    <form action="{{ route('admin_page.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10">
                <div class="card-box">
                    <h2 class="header-title text-center">Add a New Page</h2>
                    <div class="form-group">
                        <label for="">Page Title</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Page Banner/Thumbnail (1280x720)</label>
                        <input type="file" name="banner" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Page Content</label>
                        <textarea style="height: 300px" rows="5" name="details" class="ckeditor form-control"></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Create Page</button>
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
    

   
@endsection
