@extends('layouts.master')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">


  <!-- partial:partia/__subheader.html -->
  <div class="sigma_subheader dark-overlay " style="background-image: url({{asset('assets/images/home/banner_3.jpg')}})">

    <div class="container">
        
        <br>
        <br>
        <br>
        <br>
        <br>
      <div class="sigma_subheader-inner">
        <div class="sigma_subheader-text">
          <h1>Photo Gallery</h1>
        </div>
      
      </div>
    </div>

  </div>
  <!-- partial -->

<div class="container">
   
    <br>
    <br>
    <div class="row">

        @forelse ($gallery as $data)
        <div class="col-md-4 mb-4">
            <a href="{{\Storage::url($data->image)}}" data-lightbox="gallery">
                <img style="height: 380px; width: 380px; object-fit: cover;" src="{{\Storage::url($data->image)}}" alt="Image 1" class="img-fluid rounded">
            </a>
        </div>

        @empty
        <div style="display: flex; justify-content:center">
            
            <h2 style="text-align: center;">No Images in Gallery<br>(ගැලරියේ පින්තූර නැත)</h2>
           
        </div>
        <div class="section-button d-flex align-items-center" style="justify-content: center">

            <a href="/" class="ms-3 sigma_btn-custom light text-white" style="background-color: #1c1c1c;">Return Back to Home <iclass="far fa-arrow-right"></i> </a>
        </div>
        @endforelse

       
    
    </div>
    <br>

    <div>
        {{ $gallery->links() }}
    </div>

    <br>
    <br>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
@endsection