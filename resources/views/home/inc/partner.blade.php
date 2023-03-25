<div id="shopify-section-1499409846220" class="shopify-section index-section">
    <div data-section-id="1499409846220" data-section-type="grid-banner-type-9" class="grid-banner-type-9">
        <div class="grid-uniform">
            @foreach ($categories as $category)
                <div class="grid__item wide--one-half post-large--one-half large--one-half medium--grid__item small-grid__item section-wrapper section-wrapper-1499409846220-0"
                    style="background: #d2efee;">
                    <div class="section-inner">
                        <div
                            class="grid__item wide--one-half post-large--one-half large--one-half medium--one-half small-grid__item @if ($category->id % 2 == 1) right @endif">
                            <a href="collections/all.html" class="collection-img">
                                <img src="{{ $category->image }}" alt="{{ $category->name }}" />
                            </a>
                        </div>
                        <div
                            class="grid__item wide--one-half post-large--one-half large--one-half medium--one-half small-grid__item">
                            <div class="collection-info">
                                <h2 style="color:#45dbd5">
                                    <a href="collections/all.html" style="color:#45dbd5">
                                        {{ $category->name }}
                                    </a>
                                </h2>
                                <a href="{{ route('Products', ['category' => $category->slug]) }}"
                                    class="btn">{{ $category->title }} <i class="zmdi zmdi-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="dt-sc-hr-invisible-large"></div>
    </div>
    <style type="text/css">
        .grid-banner-type-9 .section-wrapper-1499409846220-0:hover {
            background: #a6e3e1 !important;
        }

        .grid-banner-type-9 .section-wrapper-1499409846220-0 .btn {
            color: #855a04;
            background: none;
            padding: 0;
        }

        .grid-banner-type-9 .section-wrapper-1499409846220-0 .btn:hover {
            color: #45dbd5;
        }

        .grid-banner-type-9 .section-wrapper-1499409846220-0 .btn:hover:before {
            background: #45dbd5;
        }

        .grid-banner-type-9 .section-wrapper-1499409846220-0 .btn:before {
            background: #855a04;
        }
    </style>
    <style type="text/css">
        .grid-banner-type-9 .section-wrapper-1499409846220-1:hover {
            background: #d7eb97 !important;
        }

        .grid-banner-type-9 .section-wrapper-1499409846220-1 .btn {
            color: #855a04;
            background: none;
            padding: 0;
        }

        .grid-banner-type-9 .section-wrapper-1499409846220-1 .btn:hover {
            color: #acd03c;
        }

        .grid-banner-type-9 .section-wrapper-1499409846220-1 .btn:hover:before {
            background: #acd03c;
        }

        .grid-banner-type-9 .section-wrapper-1499409846220-1 .btn:before {
            background: #855a04;
        }
    </style>
    <style type="text/css">
        .grid-banner-type-9 .section-wrapper-1499409908876:hover {
            background: #fce7bc !important;
        }

        .grid-banner-type-9 .section-wrapper-1499409908876 .btn {
            color: #855a04;
            background: none;
            padding: 0;
        }

        .grid-banner-type-9 .section-wrapper-1499409908876 .btn:hover {
            color: #dbbb67;
        }

        .grid-banner-type-9 .section-wrapper-1499409908876 .btn:hover:before {
            background: #dbbb67;
        }

        .grid-banner-type-9 .section-wrapper-1499409908876 .btn:before {
            background: #855a04;
        }
    </style>
    <style type="text/css">
        .grid-banner-type-9 .section-wrapper-1499409916570:hover {
            background: #f4bac4 !important;
        }

        .grid-banner-type-9 .section-wrapper-1499409916570 .btn {
            color: #855a04;
            background: none;
            padding: 0;
        }

        .grid-banner-type-9 .section-wrapper-1499409916570 .btn:hover {
            color: #e17285;
        }

        .grid-banner-type-9 .section-wrapper-1499409916570 .btn:hover:before {
            background: #e17285;
        }

        .grid-banner-type-9 .section-wrapper-1499409916570 .btn:before {
            background: #855a04;
        }
    </style>
</div>
