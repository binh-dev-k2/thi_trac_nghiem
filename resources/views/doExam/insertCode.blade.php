@extends('dashboard')
@section('content')
<div class="contents">
    <div class="container-fluid">
      <div class="social-dash-wrap">
        <div class="row">
          <div class="col-lg-12">
            <div class="breadcrumb-main">
              <h4 class="text-capitalize breadcrumb-title">Làm bài thi</h4>
              <div class="breadcrumb-action justify-content-center flex-wrap">
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                @if (session('errors') !== null && session('errors')->get('not_found') !== null)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <div class="alert-warning">
                    <p>Mã bài thi không chính xác</p>
                    <button type="button" class="btn-close text-capitalize" data-bs-dismiss="alert"
                      aria-label="Close">
                      <img src="{{ asset('assets/img/svg/x.svg') }}" alt="x" class="svg" aria-hidden="true" />
                    </button>
                  </div>
                </div>
                @endif
                
                
                <form method="post" action="{{ route('exam.do') }}"class="row" >
                  @csrf
                  <div class="col-12" bis_skin_checked="1">
                    <div class="form-group" bis_skin_checked="1">
                      <label for="a8" class="il-gray fs-14 fw-500 align-center mb-10">Nhập mã bài thi</label>
                      <input type="text" class="form-control ih-medium ip-light radius-xs b-light px-15" id="a8" required name="code_exam" placeholder="Mã bài thi">
                    </div>
                  </div>
                  <div class="col-12 d-flex">
                    <button type="submit" class="btn btn-primary">Vào làm bài </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection