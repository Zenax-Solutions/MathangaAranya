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
                    <h1>Books</h1>
                </div>

            </div>
        </div>

    </div>
    <!-- partial -->


    <div class="section section-padding">
        <div class="container">

            @if ($books->count() > 0)
            <br>
            <br>

            <div class="row sigma_broadcast-video">

                
                @foreach ($books as $book)
                    <div class="col-lg-3 col-sm-6 mb-30">
                        <div class="sigma_portfolio-item">
                            <img style="height: 300px;
                object-fit: contain;
                border-radius: 10px;"
                                src="{{ \Storage::url($book->image) }}" alt="portfolio">
                            <div class="sigma_portfolio-item-content">
                                <div class="sigma_portfolio-item-content-inner">
                                    <h5><a href="{{ \Storage::url($book->data) }}">{{ $book->title }}</a> </h5>
                                </div>
                                <a href="{{ \Storage::url($book->data) }}"><i class="fal fa-plus"></i></a>
                            </div>
                        </div>

                            <h4>{{ $book->title }}</h4>
                    </div>
                @endforeach


                <br>

                <div>
                    {{ $books->links() }}
                </div>

                <br>


            </div>
        @endif

        </div>
    </div>

@endsection