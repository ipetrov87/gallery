@extends('layouts.master')

@section('content')
<div class="container index-picture-component">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">Here are our latest pictures</div>
                    <div class="card-body">
                        <div class="row">    

                            @foreach ($pictures as $picture)    
                                <div class="col-6">
                                    <a href="/picture/{{ $picture['id'] }}">
                                        <img 
                                            src="/storage/{{ $picture['picture'] }}" 
                                            alt="{{ $picture['title'] }}"
                                            class="img-fluid">
                                    </a>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection