@if ($errors->any())
    @foreach ($errors->all() as $error)
        <el-alert
                title="{{ $error }}"
                type="error"
                show-icon>
        </el-alert>
    @endforeach
@endif

@if(session('success'))
    <div class="alert alert-success">
        {!! session('success') !!}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {!! session('error') !!}
    </div>
@endif
