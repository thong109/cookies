@extends('layouts.app')
@section('title', __('Home'))
@section('body')
    @include('home.inc.banner')
    <main class="main-content">
        <div class="grid__item">
            @include('home.inc.home')
            @include('home.inc.partner')
            @include('home.inc.arrivals')
            @include('home.inc.new')
            @include('home.inc.viewCollection')
            @include('home.inc.blog')
            @include('home.inc.manufacturers')
            @include('home.inc.subscribe')
        </div>
    </main>
@stop
