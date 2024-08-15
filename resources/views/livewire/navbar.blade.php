<div>

    <!-- partial:partia/__mobile-nav.html -->
    <aside class="sigma_aside sigma_aside-left">

        <a class="navbar-brand" href="/"> <img width="300px" src="{{ asset('assets/img/logo.png') }}" alt="logo">
        </a>

        <!-- Menu -->
        <ul class="navbar-nav">
            <li class="menu-item">
                <a href="/">Home</a>
            </li>

            @if ($speeaches->count() > 0)

                <li class="menu-item menu-item-has-children">
                    <a href="#">Dharma Deshana</a>
                    <ul class="sub-menu">

                        @if ($videos->count() > 0)
                            <li class="menu-item"> <a href="/dhammdeshana/videos">Videos</a> </li>
                        @endif
                        @if ($youtube->count() > 0)
                            <li class="menu-item"> <a href="/dhammdeshana/youtube">Youtube</a> </li>
                        @endif
                        @if ($books->count() > 0)
                            <li class="menu-item"> <a href="/dhammdeshana/books">Books</a> </li>
                        @endif
                        @if ($audio->count() > 0)
                            <li class="menu-item"> <a href="/dhammdeshana/audio">Audio</a> </li>
                        @endif


                    </ul>
                </li>

            @endif

            <li class="menu-item">
                <a href="/events">Events</a>
            </li>
            <li class="menu-item">
                <a href="/projects">Projects</a>
            </li>
            <li class="menu-item">
                <a href="/calendar">Calendar</a>
            </li>
            <li class="menu-item">
                <a href="/gallery">Gallery</a>
            </li>
            <li class="menu-item">
                <a href="/about-us">About Us</a>
            </li>
            <li class="menu-item">
                <a href="/contact">Contact</a>
            </li>
        </ul>

    </aside>
    <div class="sigma_aside-overlay aside-trigger-left"></div>


    <!-- partial:partia/__header.html -->
    <header class="sigma_header header-4 can-sticky header-absolute">

        <!-- Top Header Start -->
        <div class="sigma_header-top">
            <div class="container-fluid">
                <div class="sigma_header-top-inner">
                    <ul class="sigma_header-top-links">
                        <li class="menu-item"> <a href="tel:+94766101085"> <i class="fal fa-phone"></i>+94 766 1010 85 /
                                +94 70 518 5010 / +94 77 1010 199</a> </li>
                        <li class="menu-item"> <a href="mailto:mathangaaranya@gmail.com"> <i
                                    class="fal fa-envelope"></i>
                                mathangaaranya@gmail.com</a> </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Top Header End -->

        <!-- Middle Header Start -->
        <div class="sigma_header-middle">
            <div class="container-fluid">
                <nav class="navbar" style="border-radius: 10px;">

                    <!-- Logo Start -->
                    <div class="sigma_logo-wrapper">
                        <a class="navbar-brand" href="/">
                            <img width="242px" src="{{ asset('assets/img/logo.png') }}" alt="logo">
                        </a>
                    </div>
                    <!-- Logo End -->

                    <!-- Menu -->
                    <ul class="navbar-nav">
                        <li class="menu-item">
                            <a href="/">Home</a>
                        </li>

                        @if ($speeaches->count() > 0)

                            <li class="menu-item menu-item-has-children">
                                <a href="#">Dharma Deshana</a>
                                <ul class="sub-menu">

                                    @if ($videos->count() > 0)
                                        <li class="menu-item"> <a href="/dhammdeshana/videos">Videos</a> </li>
                                    @endif
                                    @if ($youtube->count() > 0)
                                        <li class="menu-item"> <a href="/dhammdeshana/youtube">Youtube</a> </li>
                                    @endif
                                    @if ($books->count() > 0)
                                        <li class="menu-item"> <a href="/dhammdeshana/books">Books</a> </li>
                                    @endif
                                    @if ($audio->count() > 0)
                                        <li class="menu-item"> <a href="/dhammdeshana/audio">Audio</a> </li>
                                    @endif


                                </ul>
                            </li>

                        @endif


                        <li class="menu-item">
                            <a href="/events">Events</a>
                        </li>
                        <li class="menu-item">
                            <a href="/projects">Projects</a>
                        </li>
                        <li class="menu-item">
                            <a href="/calendar">Calendar</a>
                        </li>
                        <li class="menu-item">
                            <a href="/gallery">Gallery</a>
                        </li>
                        <li class="menu-item">
                            <a href="/about-us">About Us</a>
                        </li>
                        <li class="menu-item">
                            <a href="/contact">Contact</a>
                        </li>
                    </ul>

                    <!-- Controls -->
                    <div class="sigma_header-controls style-2">

                        <ul class="sigma_header-controls-inner">


                            <!-- Mobile Toggler -->
                            <li class="aside-toggler style-2 aside-trigger-left">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </li>
                        </ul>

                    </div>

                </nav>
            </div>
        </div>
        <!-- Middle Header End -->

    </header>

</div>
