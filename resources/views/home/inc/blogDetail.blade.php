@section('title', $blog->name)
@extends('newLayout')

@section('body')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <h1>{{ $blog->name }}</h1>
        <a href="/" title="Back to the frontpage">Home</a>
        <span aria-hidden="true" class="breadcrumb__sep">/</span>
        <a href="/blogs/news" title="">News</a>
        <span aria-hidden="true" class="breadcrumb__sep">/</span>
        <span>{{ $blog->name }}</span>
    </nav>
    <main class="main-content">
        <div class="dt-sc-hr-invisible-large"></div>
        <div class="wrapper">
            <div class="grid__item">
                <div class="grid blog-design-4 blog-detail-section">
                    <div class="container">
                        <div class="blog-section">
                            <article class="grid__item" itemscope="">


                                <a href="" title=""><img src="{{ $blog->image }}"
                                        alt="Vintage manual Coffee Beans Grinder" class="article__image"></a>

                                <div class="blog-description">

                                    <div class="blog-date">
                                        <div data-datetime="2017-07-25"><span
                                                class="date">{{ date('d', strtotime($blog->created_at)) }}
                                            </span><br><span class="month">
                                                {{ date('M', strtotime($blog->created_at)) }}</span> <span class="year">
                                                {{ date('Y', strtotime($blog->created_at)) }}</span></div>
                                    </div>
                                    <div class="blogs-sub-title">
                                        <p class="author">
                                            <i class="zmdi zmdi-account"></i>
                                            <span>{{ $blog->author }}</span>
                                        </p>
                                        <h4><a
                                                href="#">{{ $blog->name }}</a>
                                        </h4>
                                    </div>
                                    <div class="blog_section_detail">
                                        {!! $blog->content !!}
                                        <hr class="hr--clear hr--small">
                                        <hr class="hr--clear hr--small">
                                    </div>

                                </div>
                            </article>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="dt-sc-hr-invisible-large"></div>
    </main>
@endsection
