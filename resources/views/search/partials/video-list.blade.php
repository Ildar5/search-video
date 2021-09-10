<div class="text-center">
    @if ($result)
        @foreach($result as $id => $video)
            <a href="/watch-video?id={{$id}}&title={{$video['title']}}&description={{$video['description']}}" class="video-link" target="_blank" rel="noopener noreferrer">
                <div class="video-description text-left">
                    <span class="text-info">
                        {{$video['title']}}
                    </span>
                </div>
            </a>
        @endforeach
    @endif
</div>