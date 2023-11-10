<x-layout.admin>
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{ route('admin.users.index') }}">All <span
                                            class="badge badge-white">{{ $users->count() }}</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.users.trashed') }}">Trash <span
                                            class="badge badge-primary">{{ $trashed_users->count() }}</span></a>
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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>

                                    @if ($users->count() > 0)
                                        @foreach ($users as $user)
                                            <tr>

                                                </td>
                                                <td>{{ $user->name }}
                                                    <div class="table-links">
                                                            @if (auth()->check() && !auth()->user()->is_admin)
                                                            <a href="{{ route('admin.users.promote', $user->id) }}">Make
                                                                to admin</a>
                                                            <div class="bullet"></div>
                                                            <a
                                                                href="{{ route('admin.users.destroy', $user->id) }}">Trash</a>
                                                        @elseif(auth()->check() && auth()->user()->is_admin)
                                                            <a href="{{ route('admin.users.demote', $user->id) }}">Demote
                                                                user</a>
                                                            <div class="bullet"></div>
                                                            <a
                                                                href="{{ route('admin.users.destroy', $user->id) }}">Trash</a>
                                                        @else
                                                            <p>You must be logged in to manage user</p>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>{{ $user->email }}
                                                    <div class="table-links">
                                                        @if (auth()->check() && !auth()->user()->is_admin)
                                                            <a href="{{ route('admin.users.promote', $user->id) }}">Make
                                                                to admin</a>
                                                            <div class="bullet"></div>
                                                            <a
                                                                href="{{ route('admin.users.destroy', $user->id) }}">Trash</a>
                                                        @elseif(auth()->check() && auth()->user()->is_admin)
                                                            <a href="{{ route('admin.users.demote', $user->id) }}">Demote
                                                                user</a>
                                                            <div class="bullet"></div>
                                                            <a
                                                                href="{{ route('admin.users.destroy', $user->id) }}">Trash</a>
                                                        @else
                                                            <p>You must be logged in to manage user</p>
                                                        @endif

                                                    </div>
                                                </td>
                                                <td>{{ $user->created_at }}</td>
                                                <td><a href="{{ route('admin.users.user_profile', $user->id) }}"><i
                                                    data-feather="eye"></a></td>
                                            </tr>
                                        @endforEach
                                    @else
                                        <h4>Users Not Found in The Database</h4>
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
