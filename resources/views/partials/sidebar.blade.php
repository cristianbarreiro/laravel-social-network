{{-- Sidebar with navigation links and user statistics --}}
<nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="bi bi-house-door"></i> Home
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('profile.show') }}">
                    <i class="bi bi-person"></i> My Profile
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('posts.create') }}">
                    <i class="bi bi-plus-circle"></i> New Post
                </a>
            </li>
        </ul>

        @auth
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Statistics</span>
            </h6>
            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-people"></i> Followers
                        <span class="badge bg-primary rounded-pill">{{ auth()->user()->followers_count ?? 0 }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-person-plus"></i> Following
                        <span class="badge bg-primary rounded-pill">{{ auth()->user()->following_count ?? 0 }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-chat"></i> Posts
                        <span class="badge bg-primary rounded-pill">{{ auth()->user()->posts_count ?? 0 }}</span>
                    </a>
                </li>
            </ul>
        @endauth
    </div>
</nav> 