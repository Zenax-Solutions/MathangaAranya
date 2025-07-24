<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mathanga Aranya Senasanaya | මාතංග ආරණ්‍ය සේනාසනය</title>

  <!-- Favicon -->
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon.png') }}">

  <!-- partial:partial/__stylesheets.html -->
  <link rel="stylesheet" href="{{ asset('assets/css/plugins/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/plugins/animate.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/plugins/magnific-popup.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/plugins/slick.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/plugins/slick-theme.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/plugins/ion.rangeSlider.min.css') }}">

  <!-- Icon Fonts -->
  <link rel="stylesheet" href="{{ asset('assets/fonts/flaticon/flaticon.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/plugins/font-awesome.min.css') }}">
  <!-- Template Style sheet -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
  <!-- partial -->

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css">

  <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js"></script>

  <style>
    .intl-tel-input,
    .iti {
      width: 100%;
    }
  </style>


  @vite('resources/js/app.js')

</head>

<body>



  <livewire:navbar />

  @yield('content')

  <livewire:footer />

  <!-- partial:partia/__scripts.html -->
  <script src="{{ asset('assets/js/plugins/jquery-3.4.1.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/imagesloaded.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/jquery.countdown.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/jquery.waypoints.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/jquery.counterup.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/jquery.zoom.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/jquery.inview.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/jquery.event.move.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/wow.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/slick.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/ion.rangeSlider.min.js') }}"></script>

  <script src="{{ asset('assets/js/main.js') }}"></script>
  <!-- partial -->

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <x-livewire-alert::scripts />

  {{-- Payment Status Popup Messages --}}
  @if(session('popup_type'))
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const popupType = @json(session('popup_type'));
      const popupTitle = @json(session('popup_title'));
      const popupMessage = @json(session('popup_message'));

      let icon = 'info';
      let iconColor = '#3085d6';
      let confirmButtonColor = '#3085d6';

      if (popupType === 'success') {
        icon = 'success';
        iconColor = '#28a745';
        confirmButtonColor = '#28a745';
      } else if (popupType === 'error') {
        icon = 'error';
        iconColor = '#dc3545';
        confirmButtonColor = '#dc3545';
      } else if (popupType === 'warning') {
        icon = 'warning';
        iconColor = '#ffc107';
        confirmButtonColor = '#ffc107';
      }

      Swal.fire({
        icon: icon,
        title: popupTitle,
        text: popupMessage,
        iconColor: iconColor,
        confirmButtonColor: confirmButtonColor,
        confirmButtonText: 'OK',
        allowOutsideClick: false,
        allowEscapeKey: false,
        showCloseButton: false,
        customClass: {
          popup: 'payment-status-popup',
          title: 'payment-status-title',
          content: 'payment-status-content'
        }
      });
    });
  </script>

  <style>
    .payment-status-popup {
      font-family: 'Arial', sans-serif !important;
    }

    .payment-status-title {
      font-weight: bold !important;
      font-size: 1.5em !important;
    }

    .payment-status-content {
      font-size: 1.1em !important;
    }
  </style>
  @endif

</body>



</html>