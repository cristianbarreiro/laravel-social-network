{{-- Post detail view with comments section --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            {{-- Post --}}
            @include('partials.post-card', ['post' => $post])

            {{-- Comments Section --}}
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Comments ({{ $post->comments_count }})</h5>
                </div>
                <div class="card-body">
                    {{-- Comment Form --}}
                    @auth
                        <form action="{{ route('posts.comments.store', $post) }}" method="POST" class="mb-4">
                            @csrf
                            <div class="mb-3">
                                <textarea name="content" class="form-control" rows="2" 
                                    placeholder="Write a comment..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Post Comment</button>
                        </form>
                    @endauth

                    {{-- Comments List --}}
                    @forelse($comments as $comment)
                        <div class="d-flex mb-4">
                            <img src="{{ $comment->user->profile_photo_url }}" alt="{{ $comment->user->name }}" 
                                class="rounded-circle me-2" width="32" height="32">
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <div>
                                        <a href="{{ route('profile.show', $comment->user) }}" class="text-decoration-none">
                                            {{ $comment->user->name }}
                                        </a>
                                        <small class="text-muted ms-2">{{ $comment->created_at->diffForHumans() }}</small>
                                    </div>
                                    @if(auth()->id() === $comment->user_id)
                                        <form action="{{ route('posts.comments.destroy', [$post, $comment]) }}" 
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger p-0">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                                <p class="mb-0">{{ $comment->content }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">No comments yet. Be the first to comment!</p>
                    @endforelse

                    {{-- Pagination --}}
                    <div class="d-flex justify-content-center">
                        {{ $comments->links() }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="col-md-4">
            {{-- Author Info --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">About the Author</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ $post->user->profile_photo_url }}" alt="{{ $post->user->name }}" 
                            class="rounded-circle me-2" width="48" height="48">
                        <div>
                            <a href="{{ route('profile.show', $post->user) }}" class="text-decoration-none">
                                {{ $post->user->name }}
                            </a>
                            <p class="text-muted mb-0">{{ $post->user->posts_count }} posts</p>
                        </div>
                    </div>
                    <p class="mb-0">{{ $post->user->bio ?? 'No bio available.' }}</p>
                </div>
            </div>

            {{-- Related Posts --}}
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Related Posts</h5>
                </div>
                <div class="card-body">
                    @forelse($relatedPosts as $relatedPost)
                        <div class="mb-3">
                            <a href="{{ route('posts.show', $relatedPost) }}" class="text-decoration-none">
                                {{ Str::limit($relatedPost->content, 100) }}
                            </a>
                            <small class="d-block text-muted">{{ $relatedPost->created_at->diffForHumans() }}</small>
                        </div>
                    @empty
                        <p class="text-muted mb-0">No related posts found.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 