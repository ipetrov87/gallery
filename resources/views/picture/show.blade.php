@extends('layouts.master')

@section('content')
    <div class="container show-picture-component">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Preview image</div>
                    <div class="card-body">
                        <img class="card-img-top" src="/storage/{{ $picture['picture'] }}" alt="{{ $picture['title'] }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $picture['title'] }}</h5>
                            <p class="card-text">{{ $picture['description'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection