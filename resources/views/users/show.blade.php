@extends('layout.layout')
@section('title', 'View User')

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
                <hr>                
                <div class="mt-3">
                   @include('users.shared.user-card')
                </div>
                <hr>

                    {{-- ideas --}}
                @forelse($ideas as $idea)
                <div class="mt-3">
                    @include('ideas.shared.idea-card')
                    
                </div>
                @empty
                    <div class="text-center">
                        <h3>No Ideas Found</h3>
                    </div>
                @endforelse
        
                <div class="mt-3">
                    {{$ideas->withQueryString()->links()}}
                </div>
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