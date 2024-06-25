@extends('main')

@section('content')
    <section class="single-post-content">
        <div class="container">
            <div class="row">
                <div class="col-md-9 post-content" data-aos="fade-up">
                    <!-- ======= Single Post Content ======= -->
                    <div class="single-post">
                        <div class="post-meta">
                            <span class="date">{{ $post->category->name }}</span>
                            <!-- Assuming category is a relationship -->
                            <span class="mx-1">&bullet;</span>
                            <span>{{ $post->created_at->format('M d, Y') }}</span>
                        </div>
                        <h1 class="mb-5">{{ $post->title }}</h1>

                        <!-- Adding the image -->
                        <figure class="my-4">
                            <img src="{{ Storage::url($post->thumbnail) }}" alt="{{ $post->title }}"
                                class="img-fluid w-75">
                        </figure>

                        {!! $post->content !!}
                    </div><!-- End Single Post Content -->
                </div>
                <div class="col-md-3">
                    <!-- ======= Sidebar ======= -->
                    <div class="aside-block">
                        <h3 class="footer-heading">Related Posts</h3>
                        <ul class="footer-links footer-blog-entry list-unstyled">
                            @foreach ($related as $item)
                                <li class="d-flex mb-3">
                                    <a href="post-{{ $item->slug }}" class="d-flex align-items-center">
                                        <img src="{{ Storage::url($item->thumbnail) }}" alt=""
                                            class="img-fluid me-3 thumbnail-img w-25">
                                        <div>
                                            <div class="post-meta">
                                                <span class="date">{{ $item->category->name }}</span>
                                                <span class="mx-1">&bullet;</span>
                                                <span>{{ $item->created_at->format('M d, Y') }}</span>
                                            </div>
                                            <span class="post-title">{{ $item->title }}</span>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div><!-- End Recent Posts -->

                    <div class="aside-block">
                        <h3 class="aside-title">Categories</h3>
                        <ul class="aside-links list-unstyled">
                            @foreach ($listcategory->take(10) as $k)
                                <li><a href="category-{{ $k->slug }}"><i class="bi bi-chevron-right"></i>
                                        {{ $k->name }}</a></li>
                            @endforeach
                        </ul>
                    </div><!-- End Categories -->

                    <div class="aside-block">
                        <h3 class="aside-title">Tags</h3>
                        <ul class="aside-tags list-unstyled">
                            @foreach ($taglist as $tag)
                                <li><a href="tag-{{ $tag->name }}">{{ $tag->name }}</a></li>
                            @endforeach
                        </ul>
                    </div><!-- End Tags -->
                </div>
            </div>
        </div>
    </section>
@endsection
