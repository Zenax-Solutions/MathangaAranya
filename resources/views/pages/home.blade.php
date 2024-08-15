@extends('layouts.master')

@section('content')
    <!-- Banner Start -->
    <div class="sigma_banner dark-overlay banner-1 bg-cover bg-center bg-norepeat"
        style="transition: background-image 1s ease;">

        <video autoplay loop muted>

            <source src="{{ asset('assets/images/home/video.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.

        </video>
        <div class="sigma_banner-slider">

            <!-- Banner Item Start -->
            <div class="sigma_banner-slider-inner">
                <div class="sigma_banner-text">
                    <div class="container position-relative">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="sigma_box primary-bg banner-cta">
                                    <h1 class="text-white title">මාතංග ආරණ්‍ය සේනාසනය</h1>
                                    <p class="blockquote light light-border mb-0">මතාංග ආරණ්‍ය සේනාසනය කුරුණෑගල
                                        දිස්ත්‍රික්කයේ වාරියපොල ප්‍රාදේශීය ලේකම් කාර්යාලයට අයත් තිස්සව ග්‍රාමසේවක වසමට අයත්
                                        වන අතර .මෙය දෙවැනි පෑතිස් රජු සමයේ ඔහු විසින් පරිහරණය කරන ලද මෙම භූමි භාගය එනම්
                                        ක්‍රිස්තු පූර්ව දෙවැනි සියවස දක්වා පැරණි අතීතයක් ඇති ස්ථානයක් වන අතර එහි ගල් ලෙනක්
                                        සහිත මෙම භූමි භාගය පිරිසිදු කර නැවතත් පූජනීය ස්ථානයක් ලෙස බෞද්ධ කටයුතු
                                        දෙපාර්තමේන්තුවේ ලියාපදිංචි සේනාසනයක් බවට පත්වී ඇත.
                                    </p>

                                    <style>
                                        @media (max-width: 768px) {
                                            .mobile-btn {
                                                display: grid !important;
                                                gap: 20px !important;
                                            }
                                        }
                                    </style>


                                    <div class="section-button d-flex align-items-center mobile-btn">

                                        <a href="#Daily-contribution" class="ms-3 sigma_btn-custom light text-white">Daily
                                            contribution<i class="far fa-arrow-right"></i> </a>

                                        <a href="#Daily-alms" class="ms-3 sigma_btn-custom light text-white">Daily alms<i
                                                class="far fa-arrow-right"></i> </a>


                                        <a href="https://wa.link/xbwh8r" target="_blank"
                                            class="ms-3 sigma_btn-custom light text-white"
                                            style="background-color: rgba(62, 214, 54, 0.45)">WhatsApp<i
                                                class="far fa-arrow-right"></i> </a>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-6">
                                <style>
                                    .slider-container {
                                        width: 100%;
                                        overflow: hidden;
                                        position: relative;
                                    }

                                    .slider {
                                        display: flex;
                                        transition: transform 0.5s ease-in-out;
                                        will-change: transform;
                                        gap: 15px;
                                    }

                                    .slider img {
                                        width: 100%;
                                        height: auto;
                                        object-fit: cover;
                                        border-radius: 10px;
                                    }
                                </style>

                                <div style="background-color: transparent" class="sigma_box primary-bg banner-cta">
                                    <div class="slider-container">

                                        <div class="slider">
                                            @forelse ($gallery as $data)
                                                <img style="position: relative" src="{{ \Storage::url($data->image) }}">


                                            @empty
                                                <div style="display: flex; justify-content:center">

                                                    <h2 style="text-align: center;">No Images in Gallery<br>(ගැලරියේ පින්තූර
                                                        නැත)</h2>

                                                </div>
                                            @endforelse

                                        </div>

                                    </div>
                                </div>

                                <script>
                                    const slider = document.querySelector('.slider');
                                    const slides = document.querySelectorAll('.slider img');

                                    let currentIndex = 0;
                                    const slideWidth = slides[0].clientWidth;

                                    function nextSlide() {
                                        currentIndex = (currentIndex + 1) % slides.length;
                                        updateSlider();
                                    }

                                    function updateSlider() {
                                        slider.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
                                    }

                                    setInterval(nextSlide, 3000); // Change slide every 3 seconds (adjust as needed)
                                </script>


                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <!-- Banner Item End -->

            {{-- <div class="sigma_banner-slider-inner">
                <div class="sigma_banner-text">
                    <div class="container position-relative">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="sigma_box primary-bg banner-cta">
                                    <h1 class="text-white title">Mathanga Aranya Senasanaya</h1>
                                    <p class="blockquote light light-border mb-0">Matanga Aranya Senasana belongs to Tissava
                                        Gramsevaka domain belonging to Wariyapola Divisional Secretariat of Kurunegala
                                        District. This land used by King Pathis II during his reign, i.e. a place with an
                                        ancient history up to the second century BC, and this land with a stone cave is
                                        clean. Kara has again become a registered Senasana of the Department of Buddhist
                                        Affairs as a place of worship.</p>
                                    <div class="section-button d-flex align-items-center">

                                        <a href="#Daily-contribution" class="ms-3 sigma_btn-custom light text-white">Daily contribution<i class="far fa-arrow-right"></i> </a>

                                        <a href="#Daily-alms" class="ms-3 sigma_btn-custom light text-white">Daily alms<i class="far fa-arrow-right"></i> </a>

                                        <a href="https://wa.link/xbwh8r" target="_blank"
                                            class="ms-3 sigma_btn-custom light text-white"
                                            style="background-color: rgba(62, 214, 54, 0.45)">WhatsApp<i
                                                class="far fa-arrow-right"></i> </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div> --}}

        </div>
    </div>
    <!-- Banner End -->





    <!-- holi Start -->
    <div class="section section-padding">
        <div class="container">

            <div class="row">

                <div class="col-lg-4 col-md-6" id="Daily-contribution">
                    <a href="/donate/daily-contribution" class="sigma_service border text-center style-1"
                        style="background-color:#d5b456">
                        <div class="sigma_service-thumb">
                            <img width="64" height="64"
                                src="https://img.icons8.com/external-victoruler-linear-colour-victoruler/64/external-temple-buildings-victoruler-linear-colour-victoruler.png"
                                alt="external-temple-buildings-victoruler-linear-colour-victoruler" />
                            <span></span>
                            <span></span>
                        </div>
                        <div class="sigma_service-body">
                            <h5 class="text-white">Daily contribution <br> (දෛනික නඩත්තු සදහා දායකත්වය)</h5>
                            <p class="text-white">මතාංග ආරණ්‍ය සේනාසනයේ දෛනිකව නඩත්තු කිරීම් අතරට මෙහි නේවාසිකව වැඩ වසන
                                ස්වාමීන් වහන්සේලාට බෙහෙත්, ඖෂධ සදහාත්, ප්‍රවාහන වියදම් සදහාත් සහ ආරණ්‍යයේ යම් ප්‍රතිසංස්කරණ
                                කටයුතු සදහාත් යන වියදම් අයත් වන අතර මෙම දෛනික නඩත්තු කිරීම් සදහා පින්වත් ඔබ සැමට ඒ වෙනුවෙන්
                                තමන් කැමති දිනයක් වෙන්කර මේ මහගු සත් ක්‍රියාව සමග අත් වැල් බැඳ ගත හැක.</p>
                        </div>
                        <br>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6" id="Daily-alms">
                    <a href="https://wa.link/xbwh8r" target="_blank"
                        class="sigma_service border text-center style-1 primary-bg">
                        <div class="sigma_service-thumb">
                            <img width="100" height="100"
                                src="https://img.icons8.com/plasticine/100/black-sesame-seeds.png"
                                alt="black-sesame-seeds" />
                            <span></span>
                            <span></span>
                        </div>
                        <div class="sigma_service-body">
                            <h5 class="text-white">Daily alms <br> (දාන දායකත්වය ලබා ගැනිම සදහා)</h5>
                            <p class="text-white">පින්වත් ඔබ සැමට මතාංග ආරණ්‍ය සේනාසනයේ වැඩ වසන ස්වාමීන් වහන්සේලා වෙනුවෙන්
                                මාසිකව දානය පිරිනැමීම සදහා දිනයක් ලබා ගැනිමට අවස්ථාව ඇත. මෙහි සදහන් කර ඇති ලින්ක් එක භාවිතා
                                කිරිමෙන් පින්වත් ඔබ කැමති දිනයක් වෙන්කර ගත හැකිය. </p>
                        </div>
                        <br>
                        <br>
                        <br>
                        <br>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6">
                    <a href="/donate" class="sigma_service border text-center style-1 secondary-bg">
                        <div class="sigma_service-thumb">
                            <img width="64" height="64"
                                src="https://img.icons8.com/external-kiranshastry-gradient-kiranshastry/64/external-donation-charity-kiranshastry-gradient-kiranshastry.png"
                                alt="external-donation-charity-kiranshastry-gradient-kiranshastry" />
                            <span></span>
                            <span></span>
                        </div>
                        <div class="sigma_service-body">
                            <h5 class="text-white">Donation <br> (පරිත්‍යාග කිරීම) </h5><br>
                            <p class="text-white">ඔබගේ යම් අවශ්‍යතාවයක් මත ආරණ්‍යයේ පැවැත්ම උදෙසා කුමන හෝ අවස්ථාවකදී යම් පරිත්‍යාගයක් කිරීම සඳහා
                            </p>
                        </div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        
                    </a>
                </div>

            </div>

        </div>
    </div>
    <!-- holi End -->

    <!-- About Start -->
    <section class="section pt-0">
        <div class="container">

            <div class="row">
                <div class="col-lg-7 d-none d-lg-block">

                    <div>
                            <iframe width="100%" height="400px" style="border-radius:5px" src="https://www.youtube.com/embed/uU-jwqHomoo?si=pzJZwMkEOVfkwHuH" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>

                    <div style="margin-top: 20px;">

                        <div>
                            <h5 style="background: black;padding: 10px; border-radius: 5px;">ත්‍රිපිටකයට පිවිසෙන්න</h5>
                        </div>

                        <a href="https://www.thripitakaya.org/" target="_blank">
                            <img style="border-radius: 5px"
                                src="https://4.bp.blogspot.com/-BmhVQCKJt1Q/XuCWCoyPwSI/AAAAAAAAAF0/IGKNaEpzO5ssAYsBz2IkfkgAQbheQX1gwCK4BGAYYCw/s1600/tripita.jpg"
                                alt="" srcset="">
                        </a>
                    </div>



                </div>
                <div class="col-lg-5">
                    <div class="me-lg-30">
                        <div class="section-title mb-0 text-start">

                            <h4 class="title">Make a Donation to Help Community</h4>
                        </div>
                        <p class="blockquote bg-transparent">The Mathanga Aranya Senasana Monastery in Sri Lanka is a
                            serene
                            retreat, where monks and seekers immerse themselves in meditation, study, and the preservation
                            of Buddhist wisdom amidst the island's natural beauty. </p>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="sigma_icon-block icon-block-3">
                                    <div class="icon-wrapper">
                                        <img width="64" height="64"
                                            src="https://img.icons8.com/external-victoruler-linear-colour-victoruler/64/external-temple-buildings-victoruler-linear-colour-victoruler.png"
                                            alt="external-temple-buildings-victoruler-linear-colour-victoruler" />
                                    </div>
                                    <div class="sigma_icon-block-content">
                                        <h5>Temple </h5>
                                        <p>Your temple donation upholds faith, spirituality, and cultural heritage.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="sigma_icon-block icon-block-3">
                                    <div class="icon-wrapper">
                                        <img width="64" height="64"
                                            src="https://img.icons8.com/external-kiranshastry-gradient-kiranshastry/64/external-donation-charity-kiranshastry-gradient-kiranshastry.png"
                                            alt="external-donation-charity-kiranshastry-gradient-kiranshastry" />
                                    </div>
                                    <div class="sigma_icon-block-content">
                                        <h5>Donation </h5>
                                        <p>Your donation of alms spreads kindness and transforms lives.</p>
                                    </div>
                                </div>
                            </div>
                        </div>


                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- About End -->



    <!-- Broadcast Start -->

    @if ($speeaches->count() > 0)



        <div class="section section-padding pt-0">
            <div class="container">
                <div class="section-title text-center">
                    <h4 class="title">Dharma Deshana <br> ධර්ම දේශනා</h4>
                </div>


                @if ($videos->count() > 0)
                    <div class="row sigma_broadcast-video">

                        <div class="section-title text-start flex-title">
                            <div>
                                <h5 class="title mb-lg-0">Videos</h5>
                                <a href="/dhammdeshana/videos" class="sigma_btn-custom light">View More <i
                                        class="far fa-arrow-right"></i></a>
                            </div>

                        </div>

                        @foreach ($videos as $video)
                            <div class="col-lg-3 col-sm-6 mb-30">

                                <video style="width: 100%;" controls>
                                    <source src="{{ \Storage::url($video->data) }}" type="video/mp4">
                                    <source src="{{ \Storage::url($video->data) }}" type="video/mov">
                                    Your browser does not support the video tag.
                                </video>


                                <h6 class="mb-0 mt-3">{{ $video->title }}</h6>
                            </div>
                        @endforeach


                    </div>
                @endif


                @if ($youtube->count() > 0)
                    <br>
                    <br>
                    <div class="row sigma_broadcast-video">

                        <div class="section-title text-start flex-title">
                            <div>
                                <h5 class="title mb-lg-0">YouTube</h5>
                                <a href="/dhammdeshana/youtube" class="sigma_btn-custom light">View More <i
                                        class="far fa-arrow-right"></i></a>
                            </div>

                        </div>

                        @foreach ($youtube as $youtube)
                            <div class="col-lg-6 col-sm-6 mb-30">

                                <style>
                                    .y-video iframe {
                                        width: 100% !important;
                                    }
                                </style>

                                <div class="y-video">


                                    {!! $youtube->description !!}



                                </div>
                                <h6 class="mb-0 mt-3">{{ $youtube->title }}</h6>
                            </div>
                        @endforeach


                    </div>
                @endif




                @if ($books->count() > 0)
                    <br>
                    <br>

                    <div class="row sigma_broadcast-video">

                        <div class="section-title text-start flex-title">
                            <div>
                                <h5 class="title mb-lg-0">Books</h5>
                                <a href="/dhammdeshana/books" class="sigma_btn-custom light">View More <i
                                        class="far fa-arrow-right"></i></a>
                            </div>

                        </div>


                        @foreach ($books as $book)
                            <div class="col-lg-3 col-sm-6 mb-30">
                                <div class="sigma_portfolio-item">
                                    <img style="height: 300px;
                        object-fit: contain;
                        border-radius: 10px;"
                                        src="{{ \Storage::url($book->image) }}" alt="portfolio">
                                    <div class="sigma_portfolio-item-content">
                                        <div class="sigma_portfolio-item-content-inner">
                                            <h5><a href="{{ \Storage::url($book->data) }}">{{ $book->title }}</a> </h5>
                                        </div>
                                        <a href="{{ \Storage::url($book->data) }}"><i class="fal fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach



                    </div>
                @endif



                @if ($audio->count() > 0)
                    <br>
                    <br>

                    <div class="row sigma_broadcast-video">

                        <div class="section-title text-start flex-title">
                            <div>
                                <h5 class="title mb-lg-0">Audio</h5>
                                <a href="/dhammdeshana/audio" class="sigma_btn-custom light">View More <i
                                        class="far fa-arrow-right"></i></a>
                            </div>
                        </div>


                        @foreach ($audio as $audio)
                            <div class="col-lg-4 col-sm-6 mb-30">
                                <div>
                                    <div>
                                        <div>

                                            <h4 class="title mb-0">
                                                <a href="#">{{ $audio->title }}</a>
                                            </h4>
                                            <div>
                                                <br>
                                                <audio controls>
                                                    <source src="{{ \Storage::url($audio->data) }}" type="audio/mp3">
                                                    Your browser does not support the audio element.
                                                </audio>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                @endif



            </div>






        </div>
        </div>
        <!-- Broadcast End -->

    @endif

    <!-- Puja Start -->
    <div class="section section-padding light-bg">
        <div class="container">

            <div class="section-title text-start flex-title">
                <div>
                    <h4 class="title mb-lg-0">Latest Events</h4>
                </div>

            </div>

            <div class="row">

                @forelse ($events as $event)
                    <div class="col-lg-4 col-md-6">
                        <div class="sigma_service style-2">
                            <div class="sigma_service-thumb">
                                <img style="height: 300px; object-fit: cover;" src="{{ \Storage::url($event->image) }}"
                                    alt="img">
                            </div>
                            <div class="sigma_service-body">
                                <h5>
                                    <a href="/events/{{ $event->id }}">{{ $event->title }}</a>
                                </h5>
                                <p>{!! \Str::limit($event->description, 100, ' ...') !!}</p>

                            </div>
                        </div>
                    </div>
                @empty
                    <div style="display: flex; justify-content:center">
                        <h2 style="text-align: center;">Events Not Found <br>(සිදුවීම් හමු නොවීය)</h2>
                    </div>
                    <div class="section-button d-flex align-items-center" style="justify-content: center">
                        <a href="/" class="ms-3 sigma_btn-custom light text-white"
                            style="background-color: #1c1c1c;">Return Back to Home <iclass="far fa-arrow-right"></i>
                        </a>
                    </div>
                @endforelse


            </div>


        </div>

    </div>
    </div>
    <!-- Puja End -->




    {{-- <script>
        const imageUrls = [
            'assets/images/home/banner_6.jpeg',
            'assets/images/home/banner_7.jpeg',
            'assets/images/home/banner_8.jpeg',
            'assets/images/home/banner_9.jpeg',
            'assets/images/home/banner_1.jpg'
        ];
        const bannerElement = document.querySelector('.sigma_banner');

        function randomizeImage() {
            const randomIndex = Math.floor(Math.random() * imageUrls.length);
            bannerElement.style.backgroundImage = `url('${imageUrls[randomIndex]}')`;
        }

        setInterval(randomizeImage, 2000); // Change image every 2 seconds
    </script> --}}
@endsection
