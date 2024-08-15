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
                    <h1>Calendar</h1>
                </div>

            </div>
        </div>

    </div>
    <!-- partial -->

    <div class="section section-padding">
        <div class="container">

            <div class="row">


                @foreach ($calendar as $data)
                    <div class="col-lg-4 col-md-6">
                        <a href="{{ \Storage::url($data->pdf) }}" class="sigma_service border text-center style-1"
                            style="background-color:#45e377">
                            <div class="sigma_service-thumb">
                                <img width="80" height="80" src="https://img.icons8.com/fluency/96/calendar--v1.png"
                                    alt="calendar--v1" />
                                <span></span>
                                <span></span>
                            </div>
                            <div class="sigma_service-body">
                                <h5 class="text-white">{!! $data->title !!}</h5>
                            </div>
                            @if ($data->type == 'poya_day' || $data->type == 'uposatha')
                                <br>
                                <br>
                            @endif
                        </a>



                    </div>
                @endforeach




            </div>

        </div>
    </div>
@endsection
