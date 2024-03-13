@extends('backend.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.css') }}">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <tr>
                        <th style="width: 5%">Serial</th>
                        <th>User</th>
                        <th style="width: 60%">Body</th>
                        <th>Sent at</th>
                    </tr>
                    @forelse($sent_notifications as $sent_notification)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td><a href="{{ route('users.show',$sent_notification->user->id ) }}">{{ $sent_notification->user->name ?? '' }}</a></td>
                        <td class="text-left">
                            <h5>{{ $sent_notification->notification_title ?? '' }}</h5>
                            {{ $sent_notification->notification_body ?? '' }}
                        </td>
                        <td>{{ date_format(date_create($sent_notification->created_at), 'd-M-Y') ?? '' }}</td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="10">No Data Found</td>
                        </tr>
                    @endforelse
                </table>
                    {{ $sent_notifications->links() }}
                </div>

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
