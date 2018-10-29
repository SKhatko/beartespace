@if($articles->count())
    <div class="app-articles-block">

        @isset($articlesTitle)
            <div class="app-articles-block__title">
                {{ $articlesTitle }}
            </div>
        @endif

        <el-row :gutter="20" class="app-articles-block__row">
            @foreach($articles as $article)
                <el-col :xs="12" :sm="6" :md="6" class="app-articles-block__col">
                    <el-card shadow="hover">
                        <div class="app-articles-block__article">
                            <a href="{{ $article->url }}" class="app-articles-block__image">
                                <img src="/imagecache/fit-290{{ $article->image_url }}">
                            </a>

                            <a href="/article?article-category={{$article->category}}"
                               class="app-articles-block__category">
                                Article
{{--                                {{ trans_input('article-category.' . $article->category) }}--}}
                            </a>

                            <a href="{{ $article->url }}" class="app-articles-block__name">
                                {{ $article->name }}
                            </a>
                        </div>
                    </el-card>
                </el-col>
            @endforeach
        </el-row>
    </div>
@endif