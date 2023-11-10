<x-layout.admin>
    <section class="section">
        <div class="section-body">
          <div class="row">
            <div class="col-12">
                @include('includes.message')
              <div class="card">
                <div class="card-header">
                  <h4>Write Your Post</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                  <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                    <div class="col-sm-12 col-md-7">
                      <input type="text" name="title" class="form-control">
                      @error('title')<span class="error text-danger">{{ $message }}</span>@enderror
                    </div>
                  </div>
                  <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Category</label>
                    <div class="col-sm-12 col-md-7">
                      <select name="category_id" class="form-control selectric">
                      @if($categories->count() > 0)
                      <option value="">Select Post Category</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                      @else 
                        Please create atleast one category first
                      @endif        
                      </select>
                      @error('category_id')<span class="error text-danger">{{ $message }}</span>@enderror
                    </div>
                  </div>
                  <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content</label>
                    <div class="col-sm-12 col-md-7">
                      <textarea name="desc" class="summernote-simple" id='editor'></textarea><br>
                      @error('desc')<span class="error text-danger">{{ $message }}</span>@enderror
                    </div>
                  </div>
                  <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
                    <div class="col-sm-12 col-md-7">
                      <div id="image-preview" class="image-preview">
                        <label for="image-upload" id="image-label">Choose File</label>
                        <input type="file" name="image" id="image-upload" />
                      </div>
                    </div>
                  </div>

                  <div class="form-group row mb-4">
                    <div class="col-sm-12 col-md-7">
                        <input type="number" name="user_id" value="{{ auth()->id() }}" hidden />
                      </div>
                    </div>
                  </div>
                
                  <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                    <div class="col-sm-12 col-md-7">
                      <button class="btn btn-primary">Create Post</button>
                    </div>
                  </div>
                </div>
            </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    </x-layout>
