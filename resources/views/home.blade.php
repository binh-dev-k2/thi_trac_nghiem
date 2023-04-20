@extends('dashboard')
@section('content')
    <div class="contents">
        <div class="container-fluid">
            <div class="social-dash-wrap">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-main">
                            <h4 class="text-capitalize breadcrumb-title">Hệ thống thi trắc nghiệm online</h4>
                        </div>
                    </div>
                </div>
                <p class="color-dark fw-500 fs-20 mb-0"></p>
                <div class="row">
                  @can('is_teacher')
                  <div class="col-lg-2 col-md-6 mb-25">
                    <div class="overview-content products-awards pt-20 pb-20 text-center radius-xl">
                        <a href="{{ route('exam.list') }}" class="d-inline-flex flex-column align-items-center justify-content-center">
                            <div class="revenue-chart-box__Icon order-bg-opacity-primary color-primary me-0">
                                <i class="uil uil-swatchbook"></i>
                            </div>
                            <div class="d-flex align-items-start flex-wrap">
                                <div>
                                    <h1>Các kì thi</h1>
                                    <p>Danh sách các kì thi đã được tạo</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-25">
                    <div class="overview-content products-awards pt-20 pb-20 text-center radius-xl">
                        <a href="{{ route('exam.create.1') }}" class="d-inline-flex flex-column align-items-center justify-content-center">
                            <div class="revenue-chart-box__Icon order-bg-opacity-primary color-primary me-0">
                                <i class="uil uil-book-medical"></i>
                            </div>
                            <div class="d-flex align-items-start flex-wrap">
                                <div>
                                    <h1>Kì thi mới</h1>
                                    <p>Tạo một kì thi mới</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                  @endcan
                    
                    <div class="col-md-12 mb-25">
                        <div class="overview-content overview-content3 pt-20 pb-20 text-center radius-xl">
                            <h2>Làm bài thi</h2>
                            <form class="d-flex flex-column align-items-center justify-content-center">
                                @csrf
                                <div class=" col-6">
                                    <div class="form-group">
                                        <input type="text"
                                            class="form-control ih-medium ip-light radius-xs b-light px-15" id="a8"
                                            required name="code_exam" placeholder="Mã bài thi">
                                    </div>
                                </div>
                                <div class="col-6 d-flex flex-column align-items-center justify-content-center">
                                    <button type="submit" class="btn btn-primary">Vào làm bài </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-12 mb-25">
                        <div class="overview-content overview-content3 pt-20 pb-20 text-center radius-xl">
                            <div class="d-flex flex-column align-items-center justify-content-center">
                                <div class="d-flex align-items-start flex-wrap">
                                    <div class="mt-3">
                                        <h2>Danh sách bài thi</h2>
                                    </div>
                                </div>
                                <table class="table col-md-9 mb-0 table-borderless adv-table" data-sorting="true"
                                    data-filter-container="#filter-form-container" data-paging-current="1"
                                    data-paging-position="right" data-paging-size="10">
                                    <thead>
                                        <tr class="userDatatable-header">
                                            <th>
                                                <span class="userDatatable-title">Tên kỳ thi</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Mã đề</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Số điểm</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Thời gian làm bài</span>
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>


                                        @foreach ($studentTest as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="userDatatable-inline-title">
                                                            <a href="{{ route('studentTest.show', $item->id) }}"
                                                                class="text-dark fw-500">
                                                                <h6>{{ $item->test->exam->name }}</h6>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ $item->test->id }}
                                                </td>
                                                <td>
                                                    <div>
                                                        {{ $item->scores }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        {{ $item->created_at }}
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach



                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
