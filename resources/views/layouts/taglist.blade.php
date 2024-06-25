@extends('main')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12" data-aos="fade-up">
                    <h3 class="section-title mb-5">All Tags</h3>
                    @if ($taglist->isEmpty())
                        <p>No tags available.</p>
                    @else
                        <ul class="list-unstyled">
                            <ul class="aside-tags list-unstyled">
                                @foreach ($taglist as $tag)
                                    <li><a href="tag-{{ $tag->name }}">{{ $tag->name }}</a></li>
                                @endforeach
                            </ul>
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
