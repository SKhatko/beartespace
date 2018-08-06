@if ($errors->any())
    @foreach ($errors->all() as $error)
        <el-alert style="margin-bottom: 5px;"
                title="{{ $error }}"
                type="error"
                show-icon>
        </el-alert>
    @endforeach
@endif

@if(session('success'))
    <el-alert style="margin-bottom: 5px;"
              title="{!! session('success') !!}"
              type="success"
              show-icon>
    </el-alert>
@endif

@if(session('error'))
    <el-alert style="margin-bottom: 5px;"
              title="{!! session('error') !!}"
              type="error"
              show-icon>
    </el-alert>
@endif
