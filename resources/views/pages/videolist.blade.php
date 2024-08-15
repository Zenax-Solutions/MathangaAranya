@extends('layouts.master')

@section('content')


    <!-- partial:partia/__subheader.html -->
    <div class="sigma_subheader dark-overlay" style="background-image: url({{ asset('assets/images/home/banner_4.jpg') }})">

        <div class="container">

            <br>
            <br>
            <br>
            <br>
            <br>
            <div class="sigma_subheader-inner">
                <div class="sigma_subheader-text">
                    <h1>Videos</h1>
                </div>

            </div>
        </div>

    </div>
    <!-- partial -->


    <div class="section section-padding">
        <div class="container">
            @if ($videos->count() > 0)
            <div class="row sigma_broadcast-video">

              

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

                <br>

                <div>
                    {{ $videos->links() }}
                </div>

                <br>

            </div>
        @endif
        </div>
    </div>

@endsection