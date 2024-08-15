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
                    <h1>YouTube</h1>
                </div>

            </div>
        </div>

    </div>
    <!-- partial -->


    <div class="section section-padding">
        <div class="container">

            @if ($youtube->count() > 0)
                <br>
                <br>
                <div class="row sigma_broadcast-video">


                    @foreach ($youtube as $data)
                            <div class="col-lg-4 col-sm-6 mb-30">
                                
                                <style>
                                    .y-video iframe{
                                        width: 100% !important;
                                    }
                                </style>
                                
                                <div class="y-video">
                         
                         
                                 {!! $data->description !!}        
                                    
                                    
                         
                                </div>
                                <h6 class="mb-0 mt-3">{{ $data->title }}</h6>
                            </div>
                        @endforeach



                    <br>

                    <div>
                        {{ $youtube->links() }}
                    </div>

                    <br>

                </div>
            @endif


        </div>
    </div>


@endsection
