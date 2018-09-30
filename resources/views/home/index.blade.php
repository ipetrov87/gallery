@extends('layouts.master')

@section('content')
<div class="container index-picture-component">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">Here are our latest pictures</div>
                    <div class="card-body">
                        <div class="row">    
                            @forelse ($pictures as $picture)    
                                <div class="col-6">
                                    <a href="/picture/{{ $picture['id'] }}">
                                        <img 
                                            src="{{ $picture['picture'] }}" 
                                            alt="{{ $picture['title'] }}"
                                            class="img-fluid">
                                    </a>
                                </div>
                            @empty
                                <h3 class="card-title">We just started! Soon there will be lots of pictures ;)</h3>
                            @endforelse

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection