<div class="col-lg-4">
    <div class="card-header bg-dark text-light h3">User Information</div>
    <div class="card-box">
        <table class="table">
            <tr>
                <td>Full Name</td>
                <td>{{ $tuition->user->name ?? '' }}</td>
            </tr>
            <tr>
                <td>User Type</td>
                <td>{{ $tuition->user->user_type ?? '' }}</td>
            </tr>
            <tr>
                <td>Email address</td>
                <td>{{ $tuition->user->email ?? '' }}</td>
            </tr>
            <tr>
                <td>Phone</td>
                <td>{{ $tuition->user->phone ?? '' }}</td>
            </tr>
            <tr>
                <td>Student/Guardian</td>
                <td>
                    @foreach ($users as $user)
                        {{ $tuition->user_id ==$user->id ? $user->name:'' }}
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>Status</td>
                <td>
                    {!! $tuition->user->status =='1'? '<span class="badge badge-info badge-sm">Active</span>':'' !!}
                    {!! $tuition->user->status =='0'? '<span class="badge badge-danger badge-sm">In-active</span>':'' !!}
                </td>
            </tr>
            <tr>
                <td>Photo</td>
                <td>
                    @if(!empty($tuition->user->avatar ?? ''))
                        <img style="width: 50px;height:50px" src="{{ $tuition->user->avatar }}" alt="">
                    @endif
                </td>
            </tr>
            <tr>
                <td>NID</td>
                <td>
                    @if(!empty($tuition->user->nid ?? ''))
                        <img style="width: 50px;height:50px" src="{{ $tuition->user->nid }}" alt="">
                    @endif
                </td>
            </tr>
        </table>

    </div>
</div>
