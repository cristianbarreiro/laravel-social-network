{{-- Reusable post card component for displaying posts in feed and profile --}}
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <img src="{{ $post->user->profile_photo_url }}" alt="{{ $post->user->name }}" class="rounded-circle me-2" width="32" height="32">
            <div>
                <h6 class="mb-0">{{ $post->user->name }}</h6>
                <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
            </div>
        </div>
        @if(auth()->id() === $post->user_id)
            <div class="dropdown">
                <button class="btn btn-link text-muted" type="button" data-bs-toggle="dropdown">
                    <i class="bi bi-three-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('posts.edit', $post) }}">Edit</a></li>
                    <li>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="dropdown-item text-danger">Delete</button>
                        </form>
                    </li>
                </ul>
            </div>
        @endif
    </div>
    <div class="card-body">
        <p class="card-text">{{ $post->content }}</p>
        @if($post->image)
            <img src="{{ $post->image_url }}" class="img-fluid rounded mb-3" alt="Post image">
        @endif
    </div>
    <div class="card-footer bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <button class="btn btn-link text-muted p-0 me-3">
                    <i class="bi bi-heart"></i> {{ $post->likes_count ?? 0 }}
                </button>
                <button class="btn btn-link text-muted p-0">
                    <i class="bi bi-chat"></i> {{ $post->comments_count ?? 0 }}
                </button>
            </div>
            <a href="{{ route('posts.show', $post) }}" class="btn btn-link text-muted">View Post</a>
        </div>
    </div>
</div> 