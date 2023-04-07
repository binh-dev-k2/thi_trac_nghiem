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
                      <h6>Thông tin bài thi</h6>
                    </div>
                    <div class="card-body">
                      <div class="dm-notice__content">
                        <div class="dm-notice__top text-center">
                          <div class="dm-notice__icon bg-info">
                            <i class="fas fa-exclamation color-white"></i>
                          </div>
                          @php
                              $matrix = json_decode($exam->matrix);
                          @endphp
                          <div class="dm-notice__text">
                            <h4>Bài thi: {{ $exam->name }}</h4>
                            <h6>Số câu hỏi: {{ $matrix->so_luong }}</h6>
                            <h6>Giáo viên ra đề: {{ $exam->user->name }}</h6>
                            <h6>Thời gian làm bài: {{ $exam->time}} phút</h6>
                            <h6></h6>
                          </div>
                        </div>
                        <div class="dm-notice__action d-flex justify-content-center">
                          <a href="{{ route('exam.start', $exam->id) }}" class="btn btn-sm btn-primary">Vào thi</a>
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