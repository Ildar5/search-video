@extends('layouts.light')

@section('title', 'Поиск видео с ютуб')

@section('content')
    <div class="container h-100">
        <div id="search">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <h1 class="text-center">
                        Search video's from <strong class="text-danger">YouTube</strong> API
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="d-flex justify-content-center h-100">
                        <div class="searchbar">
                            <input class="search_input" v-model="q" id="q" name="q" type="text" placeholder="Search...">
                            <button class="btn search_icon" @click="handleClick">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-xs-12"></div>
                <div class="col-md-6 col-xs-12">
                    <div id="search-result" v-html="video_list"></div>
                </div>
                <div class="col-md-3 col-xs-12"></div>
            </div>
        </div>
    </div>
@endsection

