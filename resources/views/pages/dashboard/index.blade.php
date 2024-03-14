@extends('layouts.main')
@section('content')
<section class="mt-5">
  <div class="card">
    <div class="container">
      <div class="row p-3">
        <h3>Report Summary</h3>
          <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow">
              <div class="card-body">
                <div class="row d-block d-xl-flex align-items-center">
                  <div
                    class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                    <div class="icon-shape icon-shape-success rounded me-4 me-sm-0">
                      <i class="ri-mac-fill ri-2x"></i>
                    </div>
                    <div class="d-sm-none">
                      <h2 class="h5">Computer Lab...</h2>
                      <h3 class="fw-extrabold mb-1">34</h3>
                    </div>
                  </div>
                  <div class="col-12 col-xl-7 px-xl-0">
                    <div class="d-none d-sm-block">
                      <h2 class="h6 text-gray-400 mb-0">Computer Lab...</h2>
                      <h3 class="fw-extrabold mb-2">{{ $computerLabour }}</h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow">
              <div class="card-body">
                <div class="row d-block d-xl-flex align-items-center">
                  <div
                    class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                    <div class="icon-shape icon-shape-success rounded me-4 me-sm-0">
                      <i class="ri-cast-fill ri-2x"></i>
                    </div>
                    <div class="d-sm-none">
                      <h2 class="fw-extrabold h5">Supporting Device</h2>
                      <h3 class="mb-1">60</h3>
                    </div>
                  </div>
                  <div class="col-12 col-xl-7 px-xl-0">
                    <div class="d-none d-sm-block">
                      <h2 class="h6 text-gray-400 mb-0">Supporting De...</h2>
                      <h3 class="fw-extrabold mb-2">{{ $dataSupportingDevice }}</h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow">
              <div class="card-body">
                <div class="row d-block d-xl-flex align-items-center">
                  <div
                    class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                    <div class="icon-shape icon-shape-danger rounded me-4 me-sm-0">
                      <i class="ri-mac-fill ri-2x"></i>
                    </div>
                    <div class="d-sm-none">
                      <h2 class="fw-extrabold h5"> Outdated Com...</h2>
                      <h3 class="mb-1">50</h3>
                    </div>
                  </div>
                  <div class="col-12 col-xl-7 px-xl-0">
                    <div class="d-none d-sm-block">
                      <h2 class="h6 text-gray-400 mb-0"> Outdated Com...</h2>
                      <h3 class="fw-extrabold mb-2">{{ $outdatedComputer }}</h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow">
              <div class="card-body">
                <div class="row d-block d-xl-flex align-items-center">
                  <div
                    class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                    <div class="icon-shape icon-shape-danger rounded me-4 me-sm-0">
                      <i class="ri-cast-fill ri-2x"></i>
                    </div>
                    <div class="d-sm-none">
                      <h2 class="fw-extrabold h5">Outdated Supp...</h2>
                      <h3 class="mb-1">30</h3>
                    </div>
                  </div>
                  <div class="col-12 col-xl-7 px-xl-0">
                    <div class="d-none d-sm-block">
                      <h2 class="h6 text-gray-400 mb-0">Outdated Supp...</h2>
                      <h3 class="fw-extrabold mb-2">{{ $outdatedSupportingDevice }}</h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</section>
@endsection