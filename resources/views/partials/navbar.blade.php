<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

        <a href="/" class="logo d-flex align-items-center">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <h1>WebBlog</h1>
        </a>
        @php
            $category = \App\Models\Category::get();
        @endphp
        <nav id="navbar" class="navbar">
            <ul>
                <li><a href="/">Blog</a></li>
                <li class="dropdown"><a href="/category-all"><span>Categories</span> <i
                            class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>
                        <li><a href="category-all">Semua Kategori</a></li>
                        @foreach ($category as $k)
                            <li><a href="category-{{ $k->slug }}">{{ $k->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li><a href="/taglist">Tags List</a></li>
                <li><a href="/contact">Contact</a></li>
            </ul>
        </nav><!-- .navbar -->

        <div class="position-relative">
            <a href="#" class="mx-2 js-search-open mb-2" style="font-size: 20px"><span
                    class="bi-search"></span></a>
            <a style="font-size: 25px" href="/admin" class="mx-2"><span class="bi-person"></span></a>
            <i class="bi bi-list mobile-nav-toggle"></i>

            <!-- ======= Form Pencarian ======= -->
            <div class="search-form-wrap js-search-form-wrap">
                <form action="/search" method="GET"
                    class="search-form">
                    <span class="icon bi-search"></span>
                    <input type="text"
                        placeholder="Cari Post"
                        name="keyword" class="form-control">
                    <button type="button" class="btn js-search-close"><span class="bi-x"></span></button>
                </form>
            </div><!-- Akhir Form Pencarian -->
        </div>
        <script>
            $(document).ready(function() {
                $('.mobile-nav-toggle').on('click', function() {
                    $('body').toggleClass('mobile-nav-active');
                    $('#navbar').toggleClass('navbar-mobile');
                    $(this).toggleClass('bi-list bi-x');
                });

                $('.navbar .dropdown > a').on('click', function(e) {
                    if ($('.navbar').hasClass('navbar-mobile')) {
                        e.preventDefault();
                        $(this).next('.dropdown-menu').slideToggle(300);
                    }
                });

                $('.js-search-open').on('click', function(e) {
                    e.preventDefault();
                    $('.search-form-wrap').addClass('active');
                });

                $('.js-search-close').on('click', function(e) {
                    e.preventDefault();
                    $('.search-form-wrap').removeClass('active');
                });
            });
        </script>
    </div>

</header><!-- End Header -->
