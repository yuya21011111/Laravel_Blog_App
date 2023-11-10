<x-layout.admin>
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{ route('admin.users.trashed') }}">Trashed <span
                                            class="badge badge-white">{{ $trashed_users->count() }}</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.users.index') }}">ALL <span
                                            class="badge badge-primary">{{ $users->count() }}</span></a>
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
                            <h4>All Users</h4>
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

                                    @if ($trashed_users->count() > 0)
                                        @foreach ($trashed_users as $user)
                                            <tr>

                                                </td>
                                                <td>{{ $user->name }}
                                                    <div class="table-links">
                                                        <a href="{{ route('admin.trashed_users.restore', $user->id) }}">Restore</a>
                                                        <div class="bullet"></div>
                                                        <a href="{{ route('admin.trashed_users.remove', $user->id) }}">Delete</a>
                                                    </div>
                                                </td>
                                                <td>{{ $user->email }}
                                                    <div class="table-links">
                                                        <a href="{{ route('admin.trashed_users.restore', $user->id) }}">Restore</a>
                                                        <div class="bullet"></div>
                                                        <a href="{{ route('admin.trashed_users.remove', $user->id) }}">Delete</a>
                                                    </div>
                                                </td>
                                                
                                                <td>{{ $user->created_at }}</td>
                                            </tr>
                                        @endforEach
                                    @else
                                        <h4>User Not Found in The Database</h4>
                                    @endif

                                </table>
                            </div>
                            <div class="float-right">
                                <nav>
                                    <ul class="pagination">
                                       {{ $users->links('pagination::bootstrap-4') }}
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
