@extends('dashboard')
@section('head')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
@endsection
@section('content')
    <div class="contents">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop-breadcrumb">
                        <div class="breadcrumb-main">
                            {{-- <h4 class="text-capitalize breadcrumb-title">checkout</h4>
                            <div class="breadcrumb-action justify-content-center flex-wrap">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#"><i class="uil uil-estate"></i>Home</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">checkout</li>
                                    </ol>
                                </nav>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class=" checkout wizard6 global-shadow border-0 px-sm-50 px-20 pt-sm-50 py-30 mb-30 bg-white radius-xl w-100">
                <div class="row justify-content-center">
                    <div class="col">
                        <div class="checkout-progress-indicator content-center">
                            <div class="checkout-progress">
                                <div class="step current" id="1">
                                    <span><img class="svg" src="{{ asset('assets/img/svg/155-credit-card.svg') }}" alt=""> </span>
                                    <span>Thông tin kì thi</span>
                                </div>
                                <div class="current"><img src="{{ asset('assets/img/svg/checkout.svg') }}" alt="img" class="svg"></div>
                                <div class="step" id="2">
                                    <span><img class="svg" src="{{ asset('assets/img/svg/155-credit-card.svg') }}" alt=""></span>
                                    <span>Các câu hỏi</span>
                                </div>
                                <div class="current"><img src="{{ asset('assets/img/svg/checkout.svg') }}" alt="img" class="svg"></div>
                                <div class="step" id="3">
                                    <span><img class="svg" src="{{ asset('assets/img/svg/155-credit-card.svg') }}" alt=""></span>
                                    <span>Thiết lập bài thi</span>
                                </div>
                                <div class="current"><img src="{{ asset('assets/img/svg/checkout.svg') }}" alt="img" class="svg"></div>
                                <div class="step" id="4">
                                    <span><img class="svg" src="{{ asset('assets/img/svg/024-like.svg') }}" alt=""></span>
                                    <span>Hoàn thành</span>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col">
                                <div class="card checkout-shipping-form shadow-none border-0 shadow-none">
                                    <div class="card-header border-bottom-0 align-content-start pb-sm-0 pb-1">
                                        <h6 class="fw-500">Ma trận đề</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="">
                                            <form action="{{ route('exam.store.3', $exam->id) }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="form-group row mb-25">
                                                        <div class="col-sm-2 d-flex aling-items-center">
                                                            <label for="cau_hoi_de" class=" col-form-label color-dark fs-14 fw-500 align-center">Dễ:
                                                                {{ $easy }} câu</label>
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <input min="0" type="number" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                                                id="cau_hoi_de" max="{{ $easy }}" name="cau_hoi_de" required
                                                                value="{{ $easy == 0 ? 0 : $easy }}" placeholder="Số câu cho hỏi từng đề">
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <input min="0" type="number" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                                                id="diem_de" name="diem_de" required placeholder="Số điểm cho từng câu"
                                                                value="{{ $easy == 0 ? 0 : '' }}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row mb-25">
                                                        <div class="col-sm-2 d-flex aling-items-center">
                                                            <label for="cau_hoi_tb" class=" col-form-label color-dark fs-14 fw-500 align-center">Trung bình:
                                                                {{ $normal }} câu</label>
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <input min="0" type="number" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                                                name="cau_hoi_tb" max="{{ $normal }}" required id="cau_hoi_tb"
                                                                placeholder="Số câu cho hỏi từng đề" value="{{ $normal == 0 ? 0 : $normal }}">
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <input min="0" type="number" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                                                name="diem_tb" required id="diem_tb" placeholder="Số điểm cho từng câu"
                                                                value="{{ $normal == 0 ? 0 : '' }}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row mb-25">
                                                        <div class="col-sm-2 d-flex aling-items-center">
                                                            <label for="cau_hoi_kho" class=" col-form-label color-dark fs-14 fw-500 align-center">Khó:
                                                                {{ $hard }} câu</label>
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <input min="0" type="number" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                                                name="cau_hoi_kho" max="{{ $hard }}" required id="cau_hoi_kho"
                                                                value="{{ $hard == 0 ? 0 : $hard }}" placeholder="Số câu cho hỏi từng đề">
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <input min="0" type="number" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                                                name="diem_kho" required id="diem_kho" placeholder="Số điểm cho từng câu"
                                                                value="{{ $hard == 0 ? 0 : '' }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-25">
                                                    <div class="col-sm-2 d-flex aling-items-center">
                                                        <label for="so_luong" class=" col-form-label color-dark fs-14 fw-500 align-center">Số lượng đề thi</label>
                                                    </div>
                                                    <div class="col-sm-10">
                                                        @php
                                                            $max = 1;
                                                            if ($easy > 0) {
                                                                $max *= $easy;
                                                            }
                                                            if ($normal > 0) {
                                                                $max *= $normal;
                                                            }
                                                            if ($hard > 0) {
                                                                $max *= $hard;
                                                            }
                                                        @endphp
                                                        <input min="1" type="number" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                                            name="so_luong" max="{{ $max }}" required id="so_luong" placeholder="Số lượng đề">
                                                    </div>
                                                </div>
                                                <div class=" d-flex pt-20 mb-20 justify-content-md-end justify-content-center">
                                                    <button type="submit" class="btn btn-primary btn-default btn-squared text-capitalize text-white">Hoàn tất<i
                                                            class="ms-10 me-0 las la-arrow-right"></i></button>
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
        const inNum = document.querySelectorAll('input[type="number"]');

        inNum.forEach(e => {
            e.addEventListener('input', function() {
                if (this.value < 0) {
                    this.value = 0;
                } else if (this.value > parseInt(e.getAttribute('max'))) {
                    this.value = parseInt(e.getAttribute('max'));
                }
            });
        });
    </script>
@endsection
