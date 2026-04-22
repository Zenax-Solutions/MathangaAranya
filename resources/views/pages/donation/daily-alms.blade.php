@extends('layouts.master')

@section('content')
<!-- Subheader -->
<div class="sigma_subheader dark-overlay" style="background-image: url({{ asset('assets/images/home/banner_2.jpg') }})">
    <div class="container">
        <br><br><br><br><br>
        <div class="sigma_subheader-inner">
            <div class="sigma_subheader-text">
                <h1>Daily Alms</h1>
            </div>
        </div>
    </div>
</div>
<!-- Subheader End -->

<!-- Form Start -->
<div class="section">
    <div class="container">
        <div class="section-title text-center">
            <h4 class="title" style="font-size: 20px">
                Daily Alms (දාන වාරය)<br>
                <small style="font-size:16px; font-weight:normal;">
                    දාන දායකත්වය ලබා ගැනිම සදහා
                </small>
            </h4>
        </div>

        <div class="row mb-4">
            <div class="col-lg-8 offset-lg-2">
                <p>
                    පින්වත් ඔබ සැමට මතාංග ආරණ්‍ය සේනාසනයේ වැඩ වසන ස්වාමීන් වහන්සේලා වෙනුවෙන් මාසිකව දානය
                    පිරිනැමීම සදහා දිනයක් ලබා ගැනිමට අවස්ථාව ඇත. මෙහි සදහන් කර ඇති ලින්ක් එක භාවිතා කිරිමෙන්
                    පින්වත් ඔබ කැමති දිනයක් වෙන්කර ගත හැකිය.
                </p>
            </div>
        </div>

        <livewire:alms-form />

    </div>
</div>
<!-- Form End -->
@endsection