@extends('layout.layout')
@section('title', 'View Idea')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-3">
                {{-- Left Sidebar --}}
                @include('shared.left-sidebar')
            </div>

            {{-- Middle  --}}
            <div class="col-6">
                @include('shared.success-message')
                               
                <div class="mt-3">
                    @include('ideas.shared.idea-card')
                </div>
                <hr>

                
            </div>

            {{-- Right Side --}}
            <div class="col-3">
                {{-- Search Bar --}}
                @include('shared.search-bar')

                {{-- Who to Follow bar --}}
                @include('shared.follow-box')
            </div>
            
        </div>
    </div>
@endsection