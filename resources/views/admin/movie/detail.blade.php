@extends('admin.master')

@section('title')
    Movie Detail
@endsection

@section('content')
    
    <div class="card shadow mb-4">
    
        <div class="row">
        
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-12 col-md-12">
                <video height="440" controls>
                    <source src="{{URL::to($movie->video)}}" type="video/mp4">
                    <source src="{{URL::to($movie->video)}}" type="video/ogg">
                    Your browser does not support the video tag.
                </video>
            </div>
    
            <div class="col-xl-12 col-md-12 pl-5 pr-5">
                <h2 class="title-news-detail">{{ $movie->title }}</h2>
            </div>

            <div class="col-xl-12 col-md-12 pl-5 pr-5">
                <p class="created-at-news-detail">{{ $movie->duration }}, <b>{{ date('l, d F Y', strtotime($movie->release_date)) }}</b></p>
            </div>

            <div class="col-xl-12 col-md-12 pl-5 pr-5">
                Genres : 
                @foreach($genres as $g)
                    {{ $g->genre_id }},
                @endforeach
            </div>

            <div class="col-xl-12 col-md-12 pl-5 pr-5">
                Directors : 
                @foreach($directors as $d)
                    {{ $d->name }},
                @endforeach
            </div>

            <div class="col-xl-12 col-md-12 mb-4 pl-5 pr-5">
                Actors : 
                @foreach($actors as $a)
                    {{ $a->name }},
                @endforeach
            </div>

            <div class="col-xl-12 col-md-12 mb-4 pl-5 pr-5">
                {{ $movie->description }}
            </div>

            <div class="col-xl-12 col-md-12 pl-5 pr-5">
                <h5 class="title-news-detail">Story Line</h5>
            </div>

            <div class="col-xl-12 col-md-12 mb-4 pl-5 pr-5">
                {{ $movie->story_line }}
            </div>

        </div>

    </div>

    <script src="{{URL::to('admin/vendor/jquery/jquery.min.js')}}"></script>

    <script>
        $(document).ready(function() {
            var price = $('.price').text()
            $('.price').text(new Intl.NumberFormat('id', { style: 'currency', currency: 'IDR' }).format(price));
        } );
    </script>

@endsection