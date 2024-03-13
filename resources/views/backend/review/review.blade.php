@extends('backend.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card-box">
                <h2 class="header-title">Urgent Contact List</h2>
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="contactTable">
                        <tr>
                            <th>ID</th>                
                            <th>Date & Time</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>

                        @forelse($user as $number)
                        {{-- @dd($number); --}}
                            <tr>
                                <td>{{ $number->count() - $loop->index }}</td>
                                <td>{{ \Carbon\Carbon::parse($number->created_at)->format('d F Y H:i:s') }}</td>
                                {{-- $date = date_format(date_create($tuition->created_at), 'd-M y'); --}}

                                <td>{{ $number->body }}</td>
                                <td>{{ $number->status }}</td>
                                <td>
                                        @if($number->is_approved)
                                            Approved
                                        @else
                                            <form action="{{ route('approve.review', $number->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                            </form>
                                        @endif
                                        <form action="{{ route('delete.review', $number->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No Data Found</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
