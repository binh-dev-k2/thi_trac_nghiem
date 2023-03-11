@extends('dashboard')
@section('head')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection
@section('content')
    <div class="contents">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop-breadcrumb">
                        <div class="breadcrumb-main">
                            <h4 class="text-capitalize breadcrumb-title">checkout</h4>
                            <div class="breadcrumb-action justify-content-center flex-wrap">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#"><i class="uil uil-estate"></i>Home</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">checkout</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div
                class=" checkout wizard6 global-shadow border-0 px-sm-50 px-20 pt-sm-50 py-30 mb-30 bg-white radius-xl w-100">
                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <div class="checkout-progress-indicator content-center">
                            <div class="checkout-progress">
                                <div class="step current" id="1">
                                    <span><img class="svg" src="{{ asset('assets/img/svg/155-credit-card.svg') }}"
                                            alt=""> </span>
                                    <span>Thông tin kì thi</span>
                                </div>
                                <div class="current"><img src="{{ asset('assets/img/svg/checkout.svg') }}" alt="img"
                                        class="svg"></div>
                                <div class="step" id="2">
                                    <span><img class="svg" src="{{ asset('assets/img/svg/155-credit-card.svg') }}"
                                            alt=""></span>
                                    <span>Các câu hỏi</span>
                                </div>
                                <div class="current"><img src="{{ asset('assets/img/svg/checkout.svg') }}" alt="img"
                                        class="svg"></div>
                                <div class="step" id="3">
                                    <span><img class="svg" src="{{ asset('assets/img/svg/155-credit-card.svg') }}"
                                            alt=""></span>
                                    <span>Thiết lập bài thi</span>
                                </div>
                                <div class="current"><img src="{{ asset('assets/img/svg/checkout.svg') }}" alt="img"
                                        class="svg"></div>
                                <div class="step" id="4">
                                    <span><img class="svg" src="{{ asset('assets/img/svg/024-like.svg') }}"
                                            alt=""></span>
                                    <span>Hoàn thành</span>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-xl-10 col-lg-10 col-sm-10">
                                <div class="card checkout-shipping-form shadow-none border-0 shadow-none">
                                    <div class="card-header border-bottom-0 align-content-start pb-sm-0 pb-1">
                                        <h4 class="fw-500">1. Điền thông tin kì thi</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="edit-profile__body">
                                            <form action="{{ route('create_step_1') }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="form-group col-sm-6">
                                                        <label for="name1">Tên kì thi</label>
                                                        <input type="text" class="form-control" name="name"
                                                        required
                                                            id="name1" placeholder="Giữa kì, 15 phút toán">
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="name2">Số lượng người thi</label>
                                                        <input type="number" class="form-control" name="count_participants" required
                                                            id="name2" placeholder="">
                                                    </div>

                                                    <div class="form-group col-sm-12">
                                                        <label for="stop_time">Thời gian bắt đầu- kết thúc</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" name="datetimes" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class=" d-flex pt-20 mb-20 justify-content-md-end justify-content-center">
                                                    <button type="submit"
                                                        class="btn btn-primary btn-default btn-squared text-capitalize text-white">Lưu
                                                        & tiếp tục<i class="ms-10 me-0 las la-arrow-right"></i></button>
                                                </div>
                                            </form>
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
    <div class="container-fluid">
        <div class="social-dash-wrap">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-main">
                        <h4 class="text-capitalize breadcrumb-title">Starter</h4>
                        <div class="breadcrumb-action justify-content-center flex-wrap">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#"><i class="uil uil-estate"></i>Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">starter</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <p class="color-dark fw-500 fs-20 mb-0">Skeleton Page</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('js')
<script>
    $(function() {
      $('input[name="datetimes"]').daterangepicker({
        timePicker: true,
        startDate: moment().startOf('hour'),
        endDate: moment().startOf('hour').add(32, 'hour'),
        locale: {
          format: 'M/DD/YYYY hh:mm A'
        }
      });
    });
    </script>
@endsection
