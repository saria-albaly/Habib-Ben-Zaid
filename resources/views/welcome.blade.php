<form method="POST" action="{{ url('login') }}">
    <div class="form-group row">
        <label for="username" class="col-md-4 col-form-label text-md-right"></label>

        @csrf
        <div class="col-md-6">
            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="" required autocomplete="username" autofocus>

            @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong></strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right"></label>

        <div class="col-md-6">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="" required autocomplete="password" autofocus>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong></strong>
                </span>
            @enderror
        </div>
    </div>
    <input type="submit" name="" value="send">
</form>    