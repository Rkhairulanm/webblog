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
                            <img src="{{ Storage::url($post->thumbnail) }}" alt="{{ $post->title }}" class="img-fluid w-75">
                            <figcaption>{{ $post->title }}</figcaption>
                        </figure>

                        {!! $post->content !!}
                    </div><!-- End Single Post Content -->
                </div>
                <div class="col-md-3">
                    <!-- ======= Sidebar ======= -->
                    <div class="aside-block">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-popular" role="tabpanel"
                                aria-labelledby="pills-popular-tab">
                                <!-- You can keep the existing sidebar content here -->
                            </div>
                        </div>
                    </div>
                    <div class="aside-block">
                        <h3 class="aside-title">Categories</h3>
                        <ul class="aside-links list-unstyled">
                            @foreach ($category as $category)
                                <li><a href="#"><i class="bi bi-chevron-right"></i> {{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div><!-- End Categories -->
                </div>
            </div>
        </div>
    </section>
@endsection
