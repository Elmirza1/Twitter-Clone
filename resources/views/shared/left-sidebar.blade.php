<div class="card overflow-hidden">
    <div class="card-body pt-3">
        <ul class="nav nav-link-secondary flex-column fw-bold gap-2">
            <li class="nav-item">
                <a class="{{ (Route::is('dashboard')) ? 'text-white bg-primary rounded' : '' }} nav-link"
                    href="{{ route('dashboard') }}">
                    <span>Home</span></a>
            </li>
            <li class="nav-item">
                <a class="{{ (Request::is('terms')) ? 'text-white bg-primary rounded' : '' }} nav-link" 
                    href="{{ url('terms') }} ">
                    <span>Terms</span></a>
            </li>
            <li class="nav-item">
                <a class="{{ (Route::is('feed')) ? 'text-white bg-primary rounded' : '' }} nav-link"
                    href="{{ route('feed') }}">
                    <span>Feed</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span>Settings</span></a>
            </li>
        </ul>
    </div>
    <div class="card-footer text-center py-2">
        <a class="{{ (Route::is('profile')) ? 'text-white bg-primary rounded' : '' }} btn btn-link btn-sm" 
            href="{{ route('profile') }}">View Profile </a>
    </div>
    <div class="card-footer text-center py-2">
       <a class="btn btn-link btn-sm" href="{{ route('lang', 'en')}}">En</a>
       <a class="btn btn-link btn-sm" href="{{ route('lang', 'es')}}">Es</a>

    </div>
</div>