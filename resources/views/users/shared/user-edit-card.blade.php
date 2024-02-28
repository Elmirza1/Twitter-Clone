<div class="card">
  <div class="px-3 pt-4 pb-2">
      
    <form action="{{ route('users.update', $user->id)}}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('put')
      <div class="d-flex align-items-center justify-content-between">
          <div class="d-flex align-items-center">
              <img style="width:150px" class="me-3 avatar-sm rounded-circle"
                  src="{{ $user->getImageUrl() }}" alt="Mario Avatar">
              <div>
                    <input value="{{ $user->name }}" type="text" class="form-control">
                    @error('name')
                        <span class="text-danger fs-6">{{ $message }}</span>
                    @enderror
              </div>
          </div>
          <div>
            @auth
              @if(Auth::id() === $user->id)
                <a href="{{ route('users.show', $user->id)}}"> View </a>
              @endif
            @endauth
          </div>
      </div>
      <div class="px-2 mt-4">
          <label for="">Profile Picture</label>
          <input name="image" class="form-control" type="file">
          @error('image')
            <span class="text-danger fs-6">{{ $message }}</span>
          @enderror

          
          <h5 class="fs-5 mt-2"> Bio : </h5>
            <div class="mb-3">
              <textarea name="bio" id="bio" class="form-control" rows="3">{{ $user->bio }}
              </textarea>
              @error('bio')
                  <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
              @enderror
            </div>
            <button class="btn btn-dark btn-sm mb-3" type="submit">Save</button>

            @include('users.shared.user-stats')
      </div>
    </form>
  </div> 
</div>
<hr>