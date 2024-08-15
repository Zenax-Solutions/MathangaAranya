@extends('layouts.master')

@section('content')

  <!-- partial:partia/__subheader.html -->
  <div class="sigma_subheader dark-overlay" style="background-image: url({{asset('assets/images/home/banner_4.jpg')}})">

    <div class="container">
        
        <br>
        <br>
        <br>
        <br>
        <br>
      <div class="sigma_subheader-inner">
        <div class="sigma_subheader-text">
          <h1>Contact Us</h1>
        </div>
      
      </div>
    </div>

  </div>
  <!-- partial -->

  <!-- Map Start -->
  <div class="sigma_map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3954.1967551854927!2d80.30703837577367!3d7.6619836088857936!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae3330c08415627%3A0x1d105b01cf41bfc5!2sMathanga%20Aranya%20Senasanaya!5e0!3m2!1sen!2slk!4v1694427493357!5m2!1sen!2slk" width="600" height="450"  allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  </div>
  <!-- Map End -->

  <!-- Contact form Start -->
  <div class="section mt-negative pt-0">
    <div class="container">

      <form class="sigma_box box-lg m-0 mf_form_validate ajax_submit contact-form">
        <div class="row">
          <div class="col-lg-4">
            <div class="form-group">
              <i class="far fa-user"></i>
              <input type="text" required placeholder="Full Name" class="form-control dark" name="name">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <i class="far fa-envelope"></i>
              <input type="email" required placeholder="Email Address" class="form-control dark" name="email">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <i class="far fa-pencil"></i>
              <input type="text" required placeholder="Subject" class="form-control dark" name="subject">
            </div>
          </div>
        </div>
        <div class="form-group">
          <textarea name="message" required placeholder="Enter Message" cols="45" rows="5" class="form-control dark"></textarea>
        </div>
        <div class="text-center">
          <button type="submit" class="sigma_btn-custom" name="button">Submit Now</button>
          <div class="server_response w-100">
          </div>
        </div>
      </form>

    </div>
  </div>
  <!-- Contact form End -->

  <!-- Icons Start -->
  <div class="section section-padding pt-0">
    <div class="container">
      <div class="row">

        <div class="col-lg-4">
          <div class="sigma_icon-block text-center light icon-block-7">
            <i class="flaticon-email"></i>
            <div class="sigma_icon-block-content">
              <span>Send Email <i class="far fa-arrow-right"></i> </span>
              <h5> Email Address</h5>
              <p>mathangaaranya@gmail.com</p>
              <br>
              <br>
            </div>
            <div class="icon-wrapper">
              <i class="flaticon-email"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="sigma_icon-block text-center light icon-block-7">
            <i class="flaticon-call"></i>
            <div class="sigma_icon-block-content">
              <span>Call Us Now <i class="far fa-arrow-right"></i> </span>
              <h5> Phone Number </h5>
              <p>+94 766 1010 85</p>
              <p>+94 70 518 5010</p>
              <p>+94 77 1010 199</p>
            </div>
            <div class="icon-wrapper">
              <i class="flaticon-call"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="sigma_icon-block text-center light icon-block-7">
            <i class="flaticon-location"></i>
            <div class="sigma_icon-block-content">
              <span>Find Us Here <i class="far fa-arrow-right"></i> </span>
              <h5> Location </h5>
              <p>Mathanga Aranya Senasanaya, Senasana Mawatha, Thissawa, Nikadalupota</p>
              <br>
            </div>
            <div class="icon-wrapper">
              <i class="flaticon-location"></i>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  <!-- Icons End -->


  <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('.contact-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            // Retrieve form data
            const name = form.querySelector('[name="name"]').value;
            const subject = form.querySelector('[name="subject"]').value;
            const email = form.querySelector('[name="email"]').value;
            const message = form.querySelector('[name="message"]').value;

            // Construct mailto link
            const mailtoLink = `mailto:mathangaaranya@gmail.com?subject=${subject}&body=Name:%20${name}%0AEmail:%20${email}%0AMessage:%20${message}`;

            // Open default email client with mailto link
            window.location.href = mailtoLink;

            form.reset();
        });
    });
</script>

@endsection