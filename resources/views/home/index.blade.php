{{-- Home page with post feed and create post form --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            {{-- Create Post Form --}}
            @auth
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <textarea name="content" class="form-control" rows="3" placeholder="What's on your mind?"></textarea>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <input type="file" name="image" class="form-control" accept="image/*">
                                </div>
                                <button type="submit" class="btn btn-primary">Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endauth

            {{-- Post Feed --}}
            @forelse($posts as $post)
                @include('partials.post-card', ['post' => $post])
            @empty
                <div class="alert alert-info">
                    No posts yet. Be the first to post something!
                </div>
            @endforelse

            {{-- Pagination --}}
            <div class="d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        </div>

        {{-- Trending Topics --}}
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Trending Topics</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach($trendingTopics as $topic)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="#" class="text-decoration-none">#{{ $topic->name }}</a>
                                <span class="badge bg-primary rounded-pill">{{ $topic->posts_count }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 