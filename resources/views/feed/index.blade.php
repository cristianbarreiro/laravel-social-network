@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <!-- Create Post Form -->
    @auth
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-4">
                    <div>
                        <textarea name="content" rows="3" 
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="¿Qué estás pensando?"></textarea>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <input type="file" name="image" accept="image/*" class="hidden" id="post-image">
                            <label for="post-image" class="cursor-pointer text-gray-500 hover:text-blue-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </label>
                        </div>
                        <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Publicar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    @endauth

    <!-- Posts Feed -->
    <div class="space-y-6">
        @forelse($posts as $post)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <!-- Post Header -->
                <div class="p-4 flex items-center space-x-3">
                    <img src="{{ $post->user->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode($post->user->name) }}" 
                        alt="{{ $post->user->name }}" 
                        class="w-10 h-10 rounded-full object-cover">
                    <div>
                        <div class="font-semibold text-gray-900">{{ $post->user->name }}</div>
                        <div class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</div>
                    </div>
                </div>

                <!-- Post Content -->
                <div class="px-4 pb-4">
                    @if($post->content)
                        <p class="text-gray-800 mb-4">{{ $post->content }}</p>
                    @endif
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" 
                            alt="Post image" 
                            class="rounded-lg max-h-96 w-full object-cover">
                    @endif
                </div>

                <!-- Post Actions -->
                <div class="px-4 py-3 border-t border-gray-200 flex items-center space-x-6">
                    <button class="flex items-center space-x-2 text-gray-500 hover:text-blue-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        <span>Me gusta</span>
                    </button>
                    <button class="flex items-center space-x-2 text-gray-500 hover:text-blue-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <span>Comentar</span>
                    </button>
                    <button class="flex items-center space-x-2 text-gray-500 hover:text-blue-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                        </svg>
                        <span>Compartir</span>
                    </button>
                </div>

                <!-- Comments Section -->
                <div class="px-4 py-3 bg-gray-50">
                    @foreach($post->comments as $comment)
                        <div class="flex items-start space-x-3 mb-3">
                            <img src="{{ $comment->user->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode($comment->user->name) }}" 
                                alt="{{ $comment->user->name }}" 
                                class="w-8 h-8 rounded-full object-cover">
                            <div class="flex-1 bg-white rounded-lg p-3">
                                <div class="font-semibold text-sm">{{ $comment->user->name }}</div>
                                <p class="text-sm text-gray-800">{{ $comment->content }}</p>
                                <div class="text-xs text-gray-500 mt-1">{{ $comment->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                    @endforeach

                    @auth
                        <form action="{{ route('posts.comments.store', $post) }}" method="POST" class="mt-3">
                            @csrf
                            <div class="flex space-x-2">
                                <input type="text" name="content" 
                                    class="flex-1 rounded-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm"
                                    placeholder="Escribe un comentario...">
                                <button type="submit" 
                                    class="px-4 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    Comentar
                                </button>
                            </div>
                        </form>
                    @endauth
                </div>
            </div>
        @empty
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No hay publicaciones</h3>
                <p class="mt-1 text-sm text-gray-500">Sé el primero en publicar algo.</p>
            </div>
        @endforelse

        <!-- Pagination -->
        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection 