@extends('layouts.master')

@section('content')

<!-- partial:partia/__subheader.html -->
<div class="sigma_subheader dark-overlay" style="background-image: url({{ asset('assets/images/home/banner_2.jpg') }})">

    <div class="container">

        <br>
        <br>
        <br>
        <br>
        <br>
        <div class="sigma_subheader-inner">
            <div class="sigma_subheader-text">
                <h1>Donation</h1>
            </div>

        </div>
    </div>

</div>
<!-- partial -->

<!-- Form Start -->
<div class="section">
    <div class="container">
        <div class="section-title text-center">
            <h4 class="title" style="font-size: 20px">Donation <br> පරිත්‍යාග කිරීම
            </h4>

        </div>

        <div class="row">

            <div class="col-lg-6">
                <h5>To make any sacrifice for the survival of the aranya on any occasion of your need

                    <br>

                    (ඔබගේ යම් අවශ්‍යතාවයක් මත ආරණ්‍යයේ පැවැත්ම උදෙසා කුමන හෝ අවස්ථාවකදී යම් පරිත්‍යාගයක් කිරීම සඳහා)

                </h5>
            </div>

            <div class="col-lg-6">

                <h3 style="font-size: 20px; color:red">Bank Details</h3>

                <p>
                    Bank : <span style="color:black">Sampath Bank</span> <br>
                    Branch : <span style="color:black">Wariyapola</span> <br>
                    Name : <span style="color:black">Mathanga Aranya Senasana Dayaka Sabhawa</span> <br>
                    Account No : <span style="color:black">104461005577</span> <br>
                    SWIFT / BIC Code : <span style="color:black">BSAMLKLX</span>
                </p>

            </div>

            <div class="col-lg-6">
                <h3 style="font-size: 20px; color:red">Note</h3>

                <p>
                    If you have submitted a payment to the
                    bank, kindly provide copies of the bank receipt (commonly referred to as the BANK
                    SLIP) containing your complete name, address, telephone number, and email address as
                    part of the form completion process.

                    <br>
                    ඔබ බැංකුවට ගෙවීමක් ඉදිරිපත් කර ඇත්නම්,පෝරමය සම්පූර්ණ කිරීමේ ක්‍රියාවලියේ කොටසක් ලෙස ඔබේ සම්පූර්ණ නම,
                    ලිපිනය, දුරකථන අංකය සහ විද්‍යුත් තැපැල් ලිපිනය ඇතුළත් බැංකු කුවිතාන්සියේ පිටපත් (සාමාන්‍යයෙන් BANK
                    SLIP
                    ලෙස හැඳින්වේ) ලබා දෙන්න.
                </p>

            </div>
        </div>

        <br>
        <br>
        <hr>

        <livewire:donation-form />

    </div>
</div>
<!-- Form End -->

@endsection