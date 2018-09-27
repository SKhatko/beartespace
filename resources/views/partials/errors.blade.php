@if ($errors->any())
    @foreach ($errors->all() as $error)
        <el-alert style="margin-bottom: 5px;"
                  title="Error"
                  description="{{ $error }}"
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



@if(session('inline-success'))
    <el-alert style="margin-bottom: 5px;"
              title="Success"
              type="success"
              description="{!! session('inline-success') !!}"
              show-icon>
    </el-alert>
@endif

@if(session('inline-info'))
    <el-alert style="margin-bottom: 5px;"
              title="Info"
              type="info"
              description="{!! session('inline-info') !!}"
              show-icon>
    </el-alert>
@endif

@if(session('inline-error'))
    <el-alert style="margin-bottom: 5px;"
              title="Error"
              type="error"
              description="{!! session('inline-error') !!}"
              show-icon>
    </el-alert>
@endif

@if(session('inline-warning'))
    <el-alert style="margin-bottom: 5px;"
              title="Warning"
              type="warning"
              description="{!! session('inline-warning') !!}"
              show-icon>
    </el-alert>
@endif
