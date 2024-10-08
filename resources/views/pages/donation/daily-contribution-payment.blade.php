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
                <h1>Daily Contribution Payment</h1>
            </div>

        </div>
    </div>

</div>
<!-- partial -->

<!-- Form Start -->
<div class="section">
    <div class="container">
        <div class="section-title text-center">
            <h4 class="title" style="font-size: 20px">Every year (one day per year) <br> සෑම වසරකම (වසරකට එක් දිනක්)
            </h4>
        </div>

        <div class="row">
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

                <h3 style="font-size: 20px; color:red">Transfer Of Funds Between Different Countries</h3>

                <p>
                    Name : <span style="color:black">Mathanga Aranya Senasana Dayaka Sabawa</span> <br>
                    Account Number : <span style="color:black">104461005577</span> <br>
                    Bank Name : <span style="color:black">Sampath Bank PLC</span> <br>
                    Branch Name : <span style="color:black">Wariyapola (PBC)</span> <br>
                    Bank Code : <span style="color:black">7278</span> <br>
                    Branch Code : <span style="color:black">044</span> <br>
                    SWIFT / BIC Code : <span style="color:black">BSAMLKLX</span> <br>
                    Country : <span style="color:black">Sri-Lanka</span> <br>
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


        <br>
        <br>

        <livewire:contribution-form-payment :id="$id" :date="$date" />

    </div>
</div>
<!-- Form End -->
@endsection