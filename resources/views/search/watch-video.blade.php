@extends('layouts.light')

@section('title', 'Просмотр видео')

@section('content')
    <div class="container h-100">
        <div class="watch">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div id="search-result">
                        <h2>
                            {!! $title !!}
                        </h2>
                        <p>
                            {!! $description !!}
                        </p>
                        <iframe width="100%"
                            height="450"
                            src="https://www.youtube.com/embed/{{$id}}"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                        >
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

