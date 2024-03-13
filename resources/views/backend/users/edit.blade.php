@extends('backend.layouts.app')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Update user</h1>
        <div class="lead">

        </div>

        <div class="container mt-4">
            <form method="post" action="{{ route('users.update', $user->id) }}">
                @method('patch')
                <input type="hidden" name="id" value="{{ $user->id }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input value="{{ $user->name }}"
                        type="text"
                        class="form-control"
                        name="name"
                        placeholder="Name" required>

                    @if ($errors->has('name'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input value="{{ $user->email }}"
                        type="email"
                        class="form-control"
                        name="email"
                        placeholder="Email address" required>
                    @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input value="{{ $user->phone }}"
                        type="phone"
                        class="form-control"
                        name="phone"
                        placeholder="Email address" required>
                    @if ($errors->has('phone'))
                        <span class="text-danger text-left">{{ $errors->first('phone') }}</span>
                    @endif
                </div>
{{--                <div class="mb-3">--}}
{{--                    <label for="username" class="form-label">Username</label>--}}
{{--                    <input value="{{ $user->username }}"--}}
{{--                        type="text"--}}
{{--                        class="form-control"--}}
{{--                        name="username"--}}
{{--                        placeholder="Username" required>--}}
{{--                    @if ($errors->has('username'))--}}
{{--                        <span class="text-danger text-left">{{ $errors->first('username') }}</span>--}}
{{--                    @endif--}}
{{--                </div>--}}
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input value="{{ old('password') }}"
                        type="text"
                        class="form-control"
                        name="password"
                        placeholder="Password" >
                    @if ($errors->has('password'))
                        <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-control"
                        name="role" required>
                        <option value="">Select role</option>
                        @foreach($roles as $role)
                            @php $role_name = strtolower($role->name) @endphp
                            @if($role_name == 'tutor' || $role_name == 'student' || $role_name == 'guardian')
                                @continue
                            @endif
                            <option value="{{ $role->id }}"
                                {{ in_array($role->name, $userRole)
                                    ? 'selected'
                                    : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('role'))
                        <span class="text-danger text-left">{{ $errors->first('role') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control"
                        name="status" required>
                        <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="2" {{ $user->status == 0 ? 'selected' : '' }}>In-active</option>
                    </select>
                    @if ($errors->has('status'))
                        <span class="text-danger text-left">{{ $errors->first('status') }}</span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Update user</button>
                <a href="{{ route('users.index') }}" class="btn btn-default">Cancel</a>
            </form>
        </div>

    </div>
@endsection
