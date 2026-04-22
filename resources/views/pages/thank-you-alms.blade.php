@extends('layouts.master')

@section('content')

<div class="sigma_subheader dark-overlay" style="background-image: url({{ asset('assets/images/home/banner_4.jpg') }})">
    <div class="container">
        <br><br><br><br><br>
        <div class="sigma_subheader-inner">
            <div class="sigma_subheader-text">
                <h1>Thank You</h1>
            </div>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">

        <div style="display: flex; justify-content:center">
            <h2 style="text-align: center;">දාන වාරයේ ලියාපදිංචි වීම ගැන ඔබට ස්තුතියි.</h2>
        </div>

        <br>

        <p style="text-align: center;">
            ඔබ ලියාපදිංචි වූ දිනයට, දානය මතක් කිරීමේ ලිපියක් (Reminder) ඔබ වෙත එවනු ලබයි.
            <br><br>
            මෙම ඉතා වටිනා දානමය පුණ්‍ය කර්මය දෙලොව අභිවෘද්ධිය පිණිස හේතු පාරමිතාවක් වේවා...
        </p>

        <br>

        <div class="section-button d-flex align-items-center" style="justify-content: center">
            <a href="/" class="ms-3 sigma_btn-custom light text-white" style="background-color: #1c1c1c;">
                Return Back to Home <i class="far fa-arrow-right"></i>
            </a>
        </div>

    </div>
</section>

@endsection