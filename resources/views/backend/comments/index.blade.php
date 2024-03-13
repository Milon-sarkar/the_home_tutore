@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="header-title m-b-15 m-t-0">Manage Tuitions</h4>
                <div class="table-responsive">
                <table class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap" cellspacing="0" width="100%" id="datatable">
                    <thead>
                    <tr>
                        <th>Tuition</th>
                        <th>Commentor's Name</th>
                        <th>Comment</th>
                        <th>Status</th>
                        <th>Verified</th>
                        <th>Anonymous</th>
                        <th>Created Date</th>
                        <th class="hidden-sm">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @if($comments)
                    @forelse ($comments as $comment)
                    <tr>
                        <td><a href="{{ route('tuitions.show', $comment->tuition['id'] ?? '') }}">{{ $comment->tuition['job_id'] ?? '' }}</a></td>
                        <td>{{ $comment->user['name'] ?? '' }}</td>
                        <td>{{ shortText($comment->body, 100) }}</td>
                        <td>{!! $comment->status == 1 ? '<spam class="badge badge-info">Active</spam>' : '<spam class="badge badge-warning">Inactive</spam>' !!} </td>
                        <td class="text-center">{!! $comment->verified == 1 ? '<span class="fa fa-check-circle text-success"></span>' : '-' !!} </td>
                        <td class="text-center">{!! $comment->anonymous == 1 ? '<i class="mdi mdi-lock text-danger"></i>' : '<i class="mdi mdi-earth text-info"></i>' !!} </td>

                        <td>{{ date('d-m-Y',strtotime($comment->created_at)) }}</td>
                        <td>
                            <div class="btn-group dropdown">
                                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <a class="dropdown-item" href="{{ route('tuition_comment.edit',$comment->id) }}"><i class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>Edit</a>
                                    <a class="dropdown-item" href="{{ route('tuition_comment.status') }}?comment_id={{ $comment->id }}"><i class="mdi mdi-check-all m-r-10 text-muted font-18 vertical-middle"></i>{{ $comment->status==1 ?'InActive':'Active' }}</a>
                                    <a class="dropdown-item" href="{{ route('tuition_comment.verified') }}?comment_id={{ $comment->id }}"><i class="mdi mdi-check-circle m-r-10 text-muted font-18 vertical-middle"></i>{{ $comment->verified==1 ?'Un-Verified':'Verified' }}</a>
                                    {!! Form::open(['method' => 'DELETE','route' => ['tuition_comment.destroy', $comment->id],'style'=>'display:inline']) !!}
									{{ Form::button('<i class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>Delete', ['type' => 'submit', 'class' => 'dropdown-item'] )  }}
							     	{!! Form::close() !!}
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty

                    @endforelse
                    @endif
                    </tbody>
                </table>
                </div>
            </div>
        </div><!-- end col -->
    </div>
    <!-- end row -->
    <script src="{{ asset('backend/js/ajax_jquery.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#datatable').dataTable();
        });
    </script>

@endsection
