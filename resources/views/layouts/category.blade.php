@extends('main')

@section('content')
    <section>
        <div class="container">
            <div class="row">

                <div class="col-md-9" data-aos="fade-up">
                    <h3 class="category-title">Category: {{ $category->name }}</h3>
                    @foreach ($posts as $item)
                        <div class="d-md-flex post-entry-2 half">
                            <a href="post-{{ $item->slug }}" class="me-4 thumbnail">
                                <img src="{{ Storage::url($item->thumbnail) }}"
                                    style="box-shadow: 0px 0px 10px {{ $item->color }};" alt="" class="img-fluid">
                            </a>
                            <div>
                                <div class="post-meta"><span class="date"> {{ $category->name }}</span> <span
                                        class="mx-1">&bullet;</span>
                                    <span>{{ $item->created_at->format('M d, Y') }}</span>
                                </div>
                                <h3><a href="{{ $item->slug }}">{{ $item->title }}</a></h3>
                                <p>{{ \Illuminate\Support\Str::limit($item->content, 150) }}</p>

                                <ul class="aside-tags list-unstyled">
                                    @foreach ($item->tags as $k)
                                        <li><a href="#">{{ $k }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach

                    {{-- <div class="text-start py-4">
                        <div class="custom-pagination">
                            <a href="#" class="prev">Prevous</a>
                            <a href="#" class="active">1</a>
                            <a href="#">2</a>
                            <a href="#">3</a>
                            <a href="#">4</a>
                            <a href="#">5</a>
                            <a href="#" class="next">Next</a>
                        </div>
                    </div> --}}
                </div>

                <div class="col-md-3">
                    <!-- ======= Sidebar ======= -->

                    <div class="aside-block">
                        <h3 class="aside-title">Categories</h3>
                        <ul class="aside-links list-unstyled">
                            @foreach ($listcategory as $k)
                                <li><a href="category-{{ $k->slug }}"><i class="bi bi-chevron-right"></i>
                                        {{ $k->name }}</a></li>
                            @endforeach
                        </ul>
                    </div><!-- End Categories -->
                </div>
            </div>
        </div>
    </section>
@endsection
