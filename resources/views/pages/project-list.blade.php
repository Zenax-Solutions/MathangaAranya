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
          <h1>Projects</h1>
        </div>
      
      </div>
    </div>

  </div>
  <!-- partial -->


  <livewire:project-list />


@endsection