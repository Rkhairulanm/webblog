<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

        <a href="index.html" class="logo d-flex align-items-center">
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
                <li class="dropdown ps-4"><span>Categories</span> <i class="bi bi-chevron-down dropdown-indicator"></i>
                    <ul>
                        @foreach ($category as $k)
                            <li><a href="category-{{ $k->slug }}">{{ $k->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li><a href="/contact">Contact</a></li>
            </ul>
        </nav><!-- .navbar -->

        <div class="position-relative">
            <a style="font-size: 25px" href="/admin" class="mx-2"><span class="bi-person"></span></a>
            <a href="#" class="mx-2 js-search-open"></a>
            <i class="bi bi-list mobile-nav-toggle"></i>

            <!-- ======= Search Form ======= -->
            <div class="search-form-wrap js-search-form-wrap">
                <form action="search-result.html" class="search-form">
                    <span class="icon bi-search"></span>
                    <input type="text" placeholder="Search" class="form-control">
                    <button class="btn js-search-close"><span class="bi-x"></span></button>
                </form>
            </div><!-- End Search Form -->

        </div>

    </div>

</header><!-- End Header -->
