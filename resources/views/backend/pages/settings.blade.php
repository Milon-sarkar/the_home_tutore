@extends('backend.layouts.app')

@section('title')
SETTINGS
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card-box">
                <h4 class="m-t-0 m-b-30 header-title">Update your profile</h4>

                <form method="POST" enctype="multipart/form-data" action="">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" value="{{ Auth::user()->name }}" name="name" id="name" placeholder="Enter your name"> 
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" id="email" placeholder="Enter email"> 
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" class="form-control" name="phone" value="{{ Auth::user()->phone }}" id="phone" placeholder="Enter your phone number"> 
                    </div> 
                    <div class="form-group">
                        <label for="profile_pic">Profile Picture (200x200)</label>
                        <input type="file" name="profile_picture" class="form-control" id="profile_pic" > 
                    </div> 
                    <p class="alert alert-danger">Change Password (Danger Zone)</p>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="old_password">Old Password</label>
                                <input type="password" name="old_password" class="form-control" id="old_password" placeholder="Old Password">
                            </div>
                            <div class="col-md-6">
                                <label for="new_password">New Password</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password">
                            </div>
                        </div>
                    </div> 
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
        <!-- end col --> 
    </div>
@endsection