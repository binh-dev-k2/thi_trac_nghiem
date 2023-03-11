@extends('dashboard')
@section('head')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <style>
        .gap>*{
            padding: 0 1rem;
        }
    </style>
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
                    <div class="col">
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
                            <div class="col">
                                <div class="card checkout-shipping-form shadow-none border-0 shadow-none">
                                    <div class="card-header">
                                        <h4 class="fw-500">Tạo bài thi</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="edit-profile__body">
                                            <form id="form-create" action="#" method="POST">
                                                @csrf
                                                <div id="questions-container" class="row"></div>

                                                <button
                                                    class="btn btn-primary btn-default btn-squared text-capitalize text-white"
                                                    type="button" id="add-question">Thêm câu hỏi</button>

                                                <div
                                                    class=" d-flex pt-20 mb-20 justify-content-md-end justify-content-center">
                                                    <button type="submit"
                                                        class="btn btn-primary btn-default btn-squared text-capitalize text-white">
                                                        Lưu & tiếp tục
                                                        <i class="ms-10 me-0 las la-arrow-right"></i>
                                                    </button>
                                                </div>
                                            </form>

                                            <template id="question-template">
                                                <div class="question form-group query">
                                                    <div class="d-flex justify-content-between">
                                                        <label>Câu <span class="question-number"> </span>:</label>
                                                        <div class="d-flex flex-wrap align-items-center gap gx-4 gy-2">
                                                            <label>Độ khó:</label>
                                                            <div>
                                                                <div class="form-check"><input class="form-check-input"
                                                                        type="radio" name="radio-type"
                                                                        value="1" id="radio-vl1"><label class="form-check-label"
                                                                        for="flexRadioSize">Dễ</label></div>
                                                            </div>
                                                            <div>
                                                                <div class="form-check"><input class="form-check-input"
                                                                        type="radio" name="radio-type"
                                                                        value="2" id="radio-vl2"><label class="form-check-label"
                                                                        for="flexRadioSize">Trung bình</label></div>
                                                            </div>
                                                            <div>
                                                                <div class="form-check"><input class="form-check-input"
                                                                        type="radio" name="radio-type"
                                                                        value="3" id="radio-vl3"><label class="form-check-label"
                                                                        for="flexRadioSize">Khó</label></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-11">
                                                            <div class="form-control-wrap">
                                                                <input class="form-control" type="text"
                                                                    name="question" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-1">
                                                            <button type="button"
                                                                class="delete-question delete btn btn-danger btn-default btn-squared">Xóa</button>
                                                        </div>
                                                    </div>
                                                    <span class="form-message"></span></br>
                                                    <span>Câu trả lời:</span>
                                                    <div class="answers"></div>
                                                    <button type="button"
                                                        class="add-answer btn btn-info btn-default btn-squared">Thêm câu
                                                        trả
                                                        lời</button>
                                                </div>
                                            </template>

                                            <template id="answer-template">
                                                <div class="answer row mb-3 query">
                                                    <div class="col-11">
                                                        <div class="form-check row">
                                                            <input class="form-check-input"
                                                                style="width: 1.5rem; height: 1.5rem" type="radio"
                                                                name="correct-answer" required>
                                                            <div class="form-control-wrap">
                                                                <input class="form-control" type="text" name="answer"
                                                                    required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-1">
                                                        <button type="button"
                                                            class="delete-answer delete btn btn-danger btn-default btn-squared">Xóa</button>
                                                    </div>
                                                    <span class="form-message"></span>
                                                </div>
                                            </template>

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

@section('js')
    <script src="{{ asset('assets/js/create_examp.js') }}"></script>
@endsection
