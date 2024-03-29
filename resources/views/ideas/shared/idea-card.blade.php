<div class="card">

	<div class="px-3 pt-4 pb-2">
			<div class="d-flex align-items-center justify-content-between">
					<div class="d-flex align-items-center">
							<img style="width:50px" class="me-2 avatar-sm rounded-circle"
									src="{{ $idea->user->getImageUrl() }}" alt="Mario Avatar">
							<div>
									{{-- <h5 class="card-title mb-0"><a href="#"> {{ $idea->users->name}}</a></h5> --}}
									<h5 class="card-title mb-0"><a href="{{ route('users.show', $idea->user->id)}}">{{ $idea->user->name }}</a></h5>
							</div>
					</div>


					<div>
							<form action="{{ route('ideas.destroy', $idea->id) }}" method="POST">
									@csrf
									@method('delete')
								@can('update', $idea)
									<a href="{{ route('ideas.edit', $idea->id) }}">Edit</a>
									<a href="{{ route('ideas.show', $idea->id) }}">View</a>
								@endcan
									<button class="ms-2 btn btn-danger btn-sm">X</button>
							</form>

					</div>rtfguyh67
			</div>
	</div>

	<div class="card-body">
			@if ($editing ?? false)
					<form action="{{ route('ideas.update', $idea->id) }}" method="POST">
							@csrf
							@method('PUT')
							<div class="mb-3">
									<textarea name="content" class="form-control" id="content" rows="3">{{ $idea->content }}</textarea>
									@error('content')
											<span class='fs-6 text-danger mt-2'>{{ $message }}</span>
									@enderror
							</div>
							<div class="">
									<button type="submit" class="btn btn-dark"> Share </button>
							</div>
					</form>
			@else
					<p class="fs-6 fw-light text-muted">
							{{ $idea->content }}
					</p>
			@endif
			<div class="d-flex justify-content-between">
					@include('ideas.shared.like-button')
					<div>
							<span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
									{{ $idea->created_at->diffForHumans() }} </span>
					</div>
			</div>

			{{-- Comments Bar --}}
			@include('shared.comments-box')
	</div>
</div>
