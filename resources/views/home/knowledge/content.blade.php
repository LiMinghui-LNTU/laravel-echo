@foreach($oArticles as $article)
    <li>
        <div class="am-gallery-item">
            <a href="/knowledge/{{$article->id}}" class="">
                <div class="customer-case-img">
                    <img src="{{$article->thumb}}"  />
                </div>
                <h3 class="am-gallery-title">
                    @if((strlen($article->title) + mb_strlen($article->title,'utf-8')) / 2 >= 22)
                        {{mb_strimwidth($article->title, 0, 22,'...', 'utf-8' )}}
                    @else
                        {{$article->title}}
                    @endif
                    <i class="am-icon-eye"></i>{{$article->view_count}}
                </h3>
                <div class="am-gallery-desc gallery-words">{{$article->description}}</div>
            </a>
        </div>
    </li>
@endforeach