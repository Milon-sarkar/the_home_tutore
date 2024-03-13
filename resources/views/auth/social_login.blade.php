
<div class="separator mb-3 text-center">
    <span class="px-3 opacity-60">{{'Or Join With'}}</span>
</div>

<div class="row d-flex justify-content-center">
    <div class="col-md-12 mb-3 text-center">
        <a href="{{ route('social.login', ['provider' => 'facebook']) }}">
            <img src="img/signin_with_facebook.png" alt="Facebook" class="img-fluid">
        </a>
    </div>
    <div class="col-md-12 mb-3 text-center">
        <a href="{{ route('social.login', ['provider' => 'google']) }}">
            <img src="img/signin_with_google.png" alt="Google" class="img-fluid">
        </a>
    </div>
</div>
