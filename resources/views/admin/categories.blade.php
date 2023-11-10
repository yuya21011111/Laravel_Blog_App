<x-layout.admin>
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link active"  href="{{ route('admin.categories.index') }}">All <span
                                            class="badge badge-white">{{ $categories->count() }}</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"href="{{ route('admin.categories.trashed') }}">Trash <span
                                            class="badge badge-primary">{{ $trashed->count() }}</span></a>
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
                                <select class="form-control selectric">
                                    <option>Action For Selected</option>
                                    <option>Move to Draft</option>
                                    <option>Move to Pending</option>
                                    <option>Delete Permanently</option>
                                </select>
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
                                        <th>Created At</th>
                                    </tr>

                                    @if ($categories->count() > 0)
                                        @foreach ($categories as $category)
                                            <tr>

                                                </td>
                                                <td>{{ $category->title }}
                                                    <div class="table-links">
                                                        <a href="{{ route('admin.categories.edit', $category->id) }}">Edit</a>
                                                        <div class="bullet"></div>
                                                        <form action="{{ route('admin.categories.destroy', ['category' => $category->id]) }}" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit">Trash</button>
                                                        </form>
                                                    </div>
                                                </td>

                                                <td>{{ $category->created_at }}</td>
                                            </tr>
                                        @endforEach
                                    @else
                                        <h4>Categories Not Found in The database</h4>
                                    @endif

                                </table>
                            </div>
                            <div class="float-right">
                                <nav>
                                    <ul class="pagination">
                                       {{ $categories->links('pagination::bootstrap-4') }}
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
