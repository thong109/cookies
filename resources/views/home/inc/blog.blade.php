<div id="shopify-section-1499414008495" class="shopify-section">
    <div data-section-id="1499414008495" data-section-type="blog-post-type-1" class="blog-post-type-1">
        <div class="container">
            <div class="blog-post">
                <div class="grid">
                    <div class="section-header section-header--small">
                        <div class="border-title">
                        </div>
                    </div>
                    <div class="dt-sc-hr-invisible-small"></div>
                    <div class="home-blog blog-section" id="artical_carousel">
                        @foreach ($blogs as $blog)
                            <div
                                class="article-item grid__item grid__item wide--one-half post-large--one-half large--one-half">
                                <div class="article">
                                    <div class="home-blog-image">
                                        <a href="{{ route('BlogDetail', ['id' => $blog->id]) }}">
                                            <img src="{{ $blog->image }}" width="553px" height="346px"
                                                alt="Delicious chocolate cupcakes with dry fruits & nuts" />
                                        </a>
                                    </div>
                                    <div class="blog-description">
                                        <div class="blogs-sub-title">
                                            <p class="blog-date" style="color:#000000;">
                                                <span datetime="2017-07-25"><span class="date"><i
                                                            style="color:#000000">{{ date('d', strtotime($blog->created_at)) }}
                                                        </i> &#47; {{ date('M', strtotime($blog->created_at)) }}
                                                    </span></span>
                                            </p>
                                            <p class="author" style="color:#000000">
                                                <i class="zmdi zmdi-account"></i>
                                                <span> {{ $blog->author }}</span>
                                            </p>
                                        </div>
                                        <div class="home-blog-content blog-detail">
                                            <h4><a href="{{ route('BlogDetail', ['id' => $blog->id]) }}"
                                                    style="color:#ff7380;">{{ $blog->name }}</a>
                                            </h4>
                                            <div class="blog-btn">
                                                <a class="btn" style="color:#ffffff;"
                                                    href="{{ route('BlogDetail', ['id' => $blog->id]) }}">{{ __('Readmore') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <style>
                    .blog-post-type-1 .blog-detail h4 a:hover {
                        color: #5ae2dd !important;
                    }

                    .blog-post-type-1 .blog-detail .blog-btn a:hover {
                        background: #ffb0b0;
                        color: #ffffff !important;
                    }

                    .blog-post-type-1 .blog-detail .blog-btn a {
                        border: none;
                        background: #cdad84;
                    }

                    .blog-post-type-1 .comments-count {
                        color: #000000;
                    }

                    .blog-post-type-1 .comments-count:before {
                        background: #000000;
                    }

                    .blog-post-type-1 .blog-description {
                        background: #ffffff;
                    }
                </style>
            </div>
        </div>
        <div class="dt-sc-hr-invisible-large"></div>
    </div>
</div>
