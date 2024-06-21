@extends('main')

@section('content')
    <!-- ======= Hero Slider Section ======= -->
    <section id="hero-slider" class="hero-slider">
        <div class="container-md" data-aos="fade-in">
            <div class="row">
                <div class="col-12">
                    <div class="swiper sliderFeaturedPosts">
                        <div class="swiper-wrapper">
                            @foreach ($post->take(4) as $post)
                                <div class="swiper-slide">
                                    <a href="post-{{ $post->slug }}" class="img-bg d-flex align-items-end"
                                        style="background-image: url('{{ Storage::url($post->thumbnail) }}');">
                                        <div class="img-bg-inner">
                                            <h2>{{ $post->title }}</h2>
                                            <p>{{ \Illuminate\Support\Str::limit($post->content, 150) }}</p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="custom-swiper-button-next">
                            <span class="bi-chevron-right"></span>
                        </div>
                        <div class="custom-swiper-button-prev">
                            <span class="bi-chevron-left"></span>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Hero Slider Section -->

    <!-- ======= Post Grid Section ======= -->
    <section id="posts" class="posts">
        <div class="container" data-aos="fade-up">
            <div class="row g-5">
                <div class="col-lg-12">
                    <div class="row g-5">
                        @foreach ($posts as $post)
                            <div class="col-lg-3 border-start custom-border">
                                <div class="post-entry-1">
                                    <a href="post-{{ $post->slug }}"><img src="{{ Storage::url($post->thumbnail) }}"
                                            alt="" class="img-fluid img-thumbnail"
                                            style="box-shadow: 0px 0px 10px {{ $post->color }};"></a>
                                    <div class="post-meta">
                                        <span class="date">{{ $post->category->name }}</span>
                                        <span class="mx-1">&bullet;</span>
                                        <span>{{ $post->created_at->format('M d, Y') }}</span>
                                    </div>
                                    <h2><a href="post-{{ $post->slug }}">{{ $post->title }}</a></h2>
                                </div>
                            </div>
                            @if ($loop->iteration % 4 == 0 && !$loop->last)
                    </div>
                    <div class="row g-5"> <!-- Close and reopen the row after every 4 posts -->
                        @endif
                        @endforeach
                    </div>
                </div>
            </div> <!-- End .row -->
        </div>
    </section> <!-- End Post Grid Section -->
@endsection
