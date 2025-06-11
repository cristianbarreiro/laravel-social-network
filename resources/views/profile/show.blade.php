{{-- User profile page with information and posts --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        {{-- Profile Header --}}
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-3 text-center">
                            <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" 
                                class="rounded-circle img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                        </div>
                        <div class="col-md-9">
                            <h2 class="mb-1">{{ $user->name }}</h2>
                            <p class="text-muted mb-3">{{ $user->email }}</p>
                            
                            <div class="d-flex gap-3 mb-3">
                                <div>
                                    <strong>{{ $user->posts_count }}</strong> Posts
                                </div>
                                <div>
                                    <strong>{{ $user->followers_count }}</strong> Followers
                                </div>
                                <div>
                                    <strong>{{ $user->following_count }}</strong> Following
                                </div>
                            </div>

                            @if(auth()->id() !== $user->id)
                                <form action="{{ route('profile.follow', $user) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">
                                        {{ auth()->user()->isFollowing($user) ? 'Unfollow' : 'Follow' }}
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary">Edit Profile</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- User Posts --}}
        <div class="col-md-8">
            <h3 class="mb-4">Posts</h3>
            @forelse($posts as $post)
                @include('partials.post-card', ['post' => $post])
            @empty
                <div class="alert alert-info">
                    No posts yet.
                </div>
            @endforelse

            {{-- Pagination --}}
            <div class="d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        </div>

        {{-- Profile Sidebar --}}
        <div class="col-md-4">
            {{-- About Section --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">About</h5>
                </div>
                <div class="card-body">
                    <p>{{ $user->bio ?? 'No bio yet.' }}</p>
                    <p class="mb-0">
                        <i class="bi bi-geo-alt"></i> {{ $user->location ?? 'No location set' }}
                    </p>
                </div>
            </div>

            {{-- Followers Section --}}
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Recent Followers</h5>
                </div>
                <div class="card-body">
                    @forelse($recentFollowers as $follower)
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ $follower->profile_photo_url }}" alt="{{ $follower->name }}" 
                                class="rounded-circle me-2" width="32" height="32">
                            <div>
                                <a href="{{ route('profile.show', $follower) }}" class="text-decoration-none">
                                    {{ $follower->name }}
                                </a>
                                <small class="d-block text-muted">{{ $follower->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted mb-0">No followers yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 