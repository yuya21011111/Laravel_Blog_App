<x-layout.applayout>
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            @if ($posts->count() > 0)
                @foreach ($posts as $post)
                    <!-- Post preview-->
                    <div class="post-preview">
                        <a href="{{  route('kitcat.show', $post->id) }}">
                            <h2 class="post-title">{{ $post->title }}</h2>
                            <h3 class="post-subtitle">{{ $post->category->title }}</h3>
                        </a>
                        <p class="post-meta">
                            Posted by
                            <a href="#!">{{ $post->user->name }}</a>on
                            {{ $post->created_at }}
                        </p>
                    </div>
                    <!-- Divider-->
                    <hr class="my-4" />
                @endforeach
            @else
                <p>No posts found!</p>
            @endif

            <!-- Pager-->
            <div class="d-flex justify-content-end mb-4">{{ $posts->links('pagination::bootstrap-4') }}</a></div>
        </div>
    </div>
</x-layout>
