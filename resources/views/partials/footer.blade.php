<footer id="footer" class="footer">
    <div class="footer-content">
        <div class="container">

            <div class="row g-5">
                <div class="col-lg-4">
                    <h3 class="footer-heading">About WebBlog</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam ab, perspiciatis beatae autem
                        deleniti voluptate nulla a dolores, exercitationem eveniet libero laudantium recusandae
                        officiis qui aliquid blanditiis omnis quae. Explicabo?</p>
                    <p><a href="/" class="footer-link-more">Learn More</a></p>
                </div>
                <div class="col-6 col-lg-2">
                    <h3 class="footer-heading">Navigation</h3>
                    <ul class="footer-links list-unstyled">
                        <li><a href="/"><i class="bi bi-chevron-right"></i> Home</a></li>
                        <li><a href="/contact"><i class="bi bi-chevron-right"></i> Contact</a></li>
                    </ul>
                </div>
                @php
                    $category = \App\Models\Category::get();
                    $post = \App\Models\Post::orderBy('created_at', 'desc')->take(3)->get();
                @endphp
                <div class="col-6 col-lg-2">
                    <h3 class="footer-heading">Categories</h3>
                    <ul class="footer-links list-unstyled">
                        <li><a href="category-all"><i
                                    class="bi bi-chevron-right"></i>Semua Kategori</a></li>
                        @foreach ($category as $k)
                            <li><a href="category-{{ $k->slug }}"><i
                                        class="bi bi-chevron-right"></i>{{ $k->name }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-lg-4">
                    <h3 class="footer-heading">Recent Posts</h3>

                    <ul class="footer-links footer-blog-entry list-unstyled">
                        @foreach ($post as $item)
                            <li>
                                <a href="post-{{ $item->slug }}" class="d-flex align-items-center">
                                    <img src="{{ Storage::url($item->thumbnail) }}" alt=""
                                        class="img-fluid me-3">
                                    <div>
                                        <div class="post-meta d-block"><span
                                                class="date">{{ $item->category->name }}</span> <span
                                                class="mx-1">&bullet;</span>
                                            <span>{{ $item->created_at->format('M d, Y') }}</span>
                                        </div>
                                        <span>{{ $item->title }}</span>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @php
        $instagram = \App\Models\Content::where('type', 'instagram')->first();
        $twitter = \App\Models\Content::where('type', 'twitter')->first();
        $facebook = \App\Models\Content::where('type', 'facebook')->first();
    @endphp


    <div class="footer-legal">
        <div class="container">

            <div class="row justify-content-between">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <div class="copyright">
                        © Copyright <strong><span>Rkhairulnm</span></strong>. All Rights Reserved
                    </div>

                    <div class="credits">
                        <!-- All the links in the footer should remain intact. -->
                        <!-- You can delete the links only if you purchased the pro version. -->
                        <!-- Licensing information: https://bootstrapmade.com/license/ -->
                        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/herobiz-bootstrap-business-template/ -->
                        Designed by
                        @if ($instagram)
                            <a href="{{ $instagram->content }}">@rkhairulanm</a>
                        @endif
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="social-links mb-3 mb-lg-0 text-center text-md-end">
                        <a href="{{ $twitter->content }}" class="twitter"><i class="bi bi-twitter"></i></a>
                        <a href="{{ $facebook->content }}" class="facebook"><i class="bi bi-facebook"></i></a>
                        <a href="{{ $instagram->content }}" class="instagram"><i class="bi bi-instagram"></i></a>
                    </div>

                </div>

            </div>

        </div>
    </div>
</footer>
