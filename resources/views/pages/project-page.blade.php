@extends('layouts.master')

@section('content')


  <!-- partial:partia/__subheader.html -->
  <div class="sigma_subheader dark-overlay" style="background-image: url({{asset('assets/images/home/banner_2.jpg')}})">

    <div class="container">
        
        <br>
        <br>
        <br>
        <br>
        <br>
      <div class="sigma_subheader-inner">
        <div class="sigma_subheader-text">
          <h1>{{$data->title}} </h1>
        </div>
      
      </div>
    </div>

  </div>
  <!-- partial -->

<!-- Post Content Start -->
<div class="section sigma_post-single">
    <div class="container">

      <div class="row">

        <div class="col-lg-12">
          <div class="post-detail-wrapper">

            <div class="entry-content">
              <a href="{{\Storage::url($data->feature_image)}}" class="gallery-thumb">
                <img style="height: 300px; object-fit: cover;" src="{{\Storage::url($data->feature_image)}}" alt="post">
                
              </a>
              <h4>{{$data->title}}</h4>
              <div class="sigma_post-meta">
                <a href="/"> <i class="far fa-clock"></i>{{$data->created_at->format('Y / M / d')}}</a>
               
              </div>
              <p>
                {!! $data->description !!}
              </p>
              <hr>
             
            </div>

           

          </div>
        </div>

        
      </div>

    </div>
  </div>
  <!-- Post Content End -->

@endsection