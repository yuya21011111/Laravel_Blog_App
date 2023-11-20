<x-layout.admin>
    <section class="section">
        <div class="section-body">
          <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-4">
                @include('includes.message')
              <div class="card author-box">
                <div class="card-body">
                  <div class="author-box-center">
                    <img alt="image" src="{{ asset('storage/profile/profile.png') }}" class="rounded-circle author-box-picture">
                    <div class="clearfix"></div>
                    <div class="author-box-name">
                      <a href="#">{{ auth()->user()->name }}</a>
                    </div>
                    <div class="author-box-job">{{ auth()->user()->email }}</div>
                  </div>
                  
                </div>
              </div>
              <div class="card">
                <div class="card-header">
                  <h4>Personal Details</h4>
                </div>
                <div class="card-body">
                  <div class="py-4">
                    <p class="clearfix">
                      <span class="float-left">
                        Phone
                      </span>
                      <span class="float-right text-muted">
                        {{ auth()->user()->phone }}
                      </span>
                    </p>
                    <p class="clearfix">
                      <span class="float-left">
                        Mail
                      </span>
                      <span class="float-right text-muted">
                        {{ auth()->user()->email }}
                      </span>
                    </p>
                    {{-- <p class="clearfix">
                      <span class="float-left">
                        Twitter
                      </span>
                      <span class="float-right text-muted">
                        <a href="#">@johndeo</a>
                      </span>
                    </p> --}}
                  </div>
                </div>
              </div>

            </div>
            <div class="col-12 col-md-12 col-lg-8">
              <div class="card">
                <div class="padding-20">
                  <ul class="nav nav-tabs" id="myTab2" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#about" role="tab"
                        aria-selected="true">About</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#settings" role="tab"
                        aria-selected="false">Setting</a>
                    </li>
                  </ul>
                  <div class="tab-content tab-bordered" id="myTab3Content">
                    <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="home-tab2">
                      <div class="row">
                        <div class="col-md-3 col-6 b-r">
                          <strong>Full Name</strong>
                          <br>
                          <p class="text-muted">{{ auth()->user()->name }}</p>
                        </div>
                        <div class="col-md-3 col-6 b-r">
                          <strong>Mobile</strong>
                          <br>
                          <p class="text-muted">{{ auth()->user()->phone }}</p>
                        </div>
                        <div class="col-md-3 col-6 b-r">
                          <strong>Email</strong>
                          <br>
                          <p class="text-muted">{{ auth()->user()->email }}</p>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="profile-tab2">
                      <form  action="{{ route('admin.users.update', auth()->id()) }}" method="POST">
                        @csrf
                        <div class="card-header">
                          <h4>Edit Profile</h4>
                        </div>
                        <div class="card-body">
                          <div class="row">
                            <div class="form-group col-md-6 col-12">
                              <label>Name</label>
                              <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}">
                              <div class="invalid-feedback">
                                Please fill in the  name
                              </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" readonly>
                                <div class="invalid-feedback">
                                  Please fill in the email
                                </div>
                              </div>
                          </div>
                          <div class="row">
                           
                            <div class="form-group col-md-6 col-12">
                              <label>Phone</label>
                              <input type="tel" name="phone" class="form-control" value="{{ auth()->user()->phone }}">
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Last updated</label>
                                @if(auth()->user()->updated_at)
                                <input type="text" class="form-control" value="{{ auth()->user()->updated_at->diffForHumans() }}" readonly>
                                @else
                                <input type="text" class="form-control" value="" readonly>
                                @endif
                              </div>
                          </div>
                        </div>
                        <div class="card-footer text-right">
                          <button class="btn btn-primary">Save Changes</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
</x-layout>
