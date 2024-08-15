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
                    <h1>Audios</h1>
                </div>

            </div>
        </div>

    </div>
    <!-- partial -->


    <div class="section section-padding">
        <div class="container">

            @if ($audio->count() > 0)
                <br>
                <br>

                <div class="row sigma_broadcast-video">


                    @foreach ($audio as $data)
                        <div class="col-lg-4 col-sm-6 mb-30">
                            <div>
                                <div>
                                    <div>

                                        <h4 class="title mb-0">
                                            <a href="#">{{ $data->title }}</a>
                                        </h4>
                                        <div>
                                            <br>
                                            <audio controls>
                                                <source src="{{ \Storage::url($data->data) }}" type="audio/mp3">
                                                Your browser does not support the audio element.
                                            </audio>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <br>

                    <div>
                        {{ $audio->links() }}
                    </div>
    
                    <br>

                </div>
            @endif

       
    </div>

    </div>

@endsection
