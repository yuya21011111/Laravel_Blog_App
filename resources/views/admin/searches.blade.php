<x-layout.admin>
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{ route('admin.posts.index') }}">All <span
                                            class="badge badge-white">{{ $posts->count() }}</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.posts.trashed') }}">Trash <span
                                            class="badge badge-primary">{{ $trashed_posts->count() }}</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    @include('includes.message')
                    <div class="card">
                        <div class="card-header">
                            <h4>All Posts</h4>
                        </div>
                        <div class="card-body">
                            <div class="float-left">
                               
                            </div>
                            <div class="float-right">
                                <form>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="clearfix mb-3"></div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Title</th>
                                        <th>Desc</th>
                                      
                                        <th>Post Category</th>
                                        <th>Created At</th>
                                    </tr>

                                    @if ($posts->count() > 0)
                                        @foreach ($posts as $post)
                                            <tr>

                                                </td>
                                                <td>{{ $post->title }}
                                                    <div class="table-links">
                                                        <a href="{{ route('admin.posts.edit', $post->id) }}">Edit</a>
                                                        <div class="bullet"></div>
                                                        <a href="{{ route('admin.posts.destroy', $post->id) }}">Trash</a>
                                                    </div>
                                                </td>
                                                <td>{!! $post->desc !!}
                                                    <div class="table-links">
                                                        <a href="{{ route('admin.posts.edit', $post->id) }}">Edit</a>
                                                        <div class="bullet"></div>
                                                        <a href="{{ route('admin.posts.destroy', $post->id) }}">Trash</a>
                                                    </div>
                                                </td>
                                                <td>{{ $post->category->title }}
                                                    <div class="table-links">
                                                        <a href="{{ route('admin.posts.edit', $post->id) }}">Edit</a>
                                                        <div class="bullet"></div>
                                                        <a href="{{ route('admin.posts.destroy', $post->id) }}">Trash</a>
                                                    </div>
                                                </td>

                                                <td>{{ $post->created_at }}</td>
                                            </tr>
                                        @endforEach
                                    @else
                                        <h4>Posts Not Found in The Database</h4>
                                    @endif

                                </table>
                            </div>
                            <div class="float-right">
                                <nav>
                                    <ul class="pagination">
                                       {{ $posts->links('pagination::bootstrap-4') }}
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </x-layout>
