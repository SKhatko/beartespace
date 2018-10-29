@if($articles->count)
    <div class="app-articles-block">
        <el-row :gutter="20" class="app-articles-block__row">
            @foreach($articles as $article)
                <el-col :xs="12" :sm="6" :md="6" class="app-articles-block__col">
                    <el-card shadow="hover">
                        <div class="app-articles-block__article">
                            <a href="{{ $article->url }}" class="app-articles-block__image">
                                <img src="/imagecache/fit-290{{ $article->image_url }}">
                            </a>

                            <div class="app-articles-block__category">
                                {{ trans_input('article-category.' . $article->category) }}
                            </div>

                            <div class="app-articles-block__name">
                                {{ $article->name }}
                            </div>
                        </div>
                    </el-card>
                </el-col>
            @endforeach
        </el-row>
    </div>
@endif