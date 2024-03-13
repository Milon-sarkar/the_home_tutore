@extends('backend.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.css') }}">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card-box">
                <h2 class="header-title">
                    Sent SMS List
                </h2>
                <div class="card-body">
                    <h2>Follow these steps</h2>
                    <ul>
                        <li><strong>#1</strong> Login to <a href="https://bulksmsbd.net/login" target="_blank">Bulk SMS</a></li>
                        <li><strong>#2</strong> Click on <strong>Reports</strong> menu to the left side.</li>
                        <li><strong>#2</strong> Click on <strong>SMS Log</strong></li>
                    </ul>
                    <h2>If you are log in, just click one the following link</h2>
                    <a href="https://bulksmsbd.net/sms-logs/list" target="_blank">Direct Link</a>
                </div>
{{--                <div class="table-responsive">--}}
{{--                <table class="table table-bordered text-center">--}}
{{--                    <tr>--}}
{{--                        <th>Serial</th>--}}
{{--                        <th>User</th>--}}
{{--                        <th>Phone</th>--}}
{{--                        <th>SMS</th>--}}
{{--                        <th>Sent at</th>--}}
{{--                    </tr>--}}
{{--                    @forelse($sent_smses as $sent_sms)--}}
{{--                    <tr>--}}
{{--                        <td>{{ $loop->index + 1 }}</td>--}}
{{--                        <td><a href="{{ route('users.show',$sent_sms->user->id ) }}">{{ $sent_sms->user->name ?? '' }}</a></td>--}}
{{--                        <td>{{ $sent_sms->phone_number ?? '' }}</td>--}}
{{--                        <td>{{ $sent_sms->sms_body ?? '' }}</td>--}}
{{--                        <td>{{ date_format(date_create($sent_sms->created_at), 'd-M-Y') ?? '' }}</td>--}}
{{--                    </tr>--}}
{{--                    @empty--}}
{{--                        <tr>--}}
{{--                            <td colspan="10">No Data Found</td>--}}
{{--                        </tr>--}}
{{--                    @endforelse--}}
{{--                </table>--}}
{{--                </div>--}}

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
