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
            <div class="col-lg-12">
                <div class="dm-notice">
                  <div class="card card-default card-md mb-4">
                    <div class="card-header">
                      <h6>Kết quả bài thi</h6>
                    </div>
                    <div class="card-body">
                      <div class="dm-notice__content">
                        <div class="dm-notice__top text-center">
                          <div class="dm-notice__icon bg-success">
                            <i class="fas fa-check color-white"></i>
                          </div>
                          <div class="dm-notice__text">
                            <h2>{{ $student_test->scores }} điểm</h2>
                            <h4>Chúc mừng bạn đã hoàn thành bài thi</h4>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        </div>
      </div>
    </div>
  </div>
@endsection