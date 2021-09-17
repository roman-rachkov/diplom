<div class="Middle-top">
    <div class="wrap">
        <div class="Middle-header">
            <h1 class="Middle-title">@yield('title')</h1>
            @if(Breadcrumbs::has())
                <ul class="breadcrumbs Middle-breadcrumbs">
                    @foreach (Breadcrumbs::current() as $crumbs)
                        @if ($crumbs->url() && !$loop->last)
                            <li class="breadcrumb-item">
                                <a href="{{ $crumbs->url() }}">
                                    {{ $crumbs->title() }}
                                </a>
                            </li>
                        @else
                            <li class="breadcrumb-item breadcrumbs-item_current">
                                <span>
                                    {{ $crumbs->title() }}
                                </span>
                            </li>
                        @endif
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
