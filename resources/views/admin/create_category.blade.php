<x-layout.admin>
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                   @include('includes.message')
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Category</h4>
                        </div>
                        <form action="{{ route('admin.categories.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="title" class="form-control">
                                    </div>
                                </div>


                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary">Create Category</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </section>
    </x-layout>
