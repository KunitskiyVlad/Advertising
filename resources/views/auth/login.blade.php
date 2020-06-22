<div class="modal-content">
<div class="modal-header text-center">
    <h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body mx-3">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="md-form mb-4">
            <label for="username">{{__('Username')}}</label>
            <input id="username" class="form-control @error('username') is-invalid @enderror" name="username">
            @error('username')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
        <div class="md-form mb-4">
            <label data-error="wrong" data-success="right" for="password">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                   name="password" required autocomplete="current-password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-4 offset-md-8">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember"
                       id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
</div>
