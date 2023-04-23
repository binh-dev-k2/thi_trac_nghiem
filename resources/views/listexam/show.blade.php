@extends('dashboard')
@section('content')
    <div class="contents">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 mb-30">
                    <div class="card mt-30">
                        <div class="card-body">
                            <div class="col-12 row">
                                @php
                                    $matrix = json_decode($exam->matrix);
                                @endphp
                                <h3>Thông tin kì thi</h3>
                                <div class="row mt-2">
                                    <div class="col-lg-6">
                                        <p>Bài thi: {{ $exam->name }}</p>
                                        <p>Số câu hỏi: {{ $matrix->so_luong }}</p>
                                        <p>Giáo viên ra đề: {{ $exam->user->name }}</p>
                                        <p>Số bài thi đã tạo: {{ $exam->count_participanted.'/'.$exam->count_participants }}</p>
                                    </div>
                                    <div class="col-lg-6">
                                        <p>Thời gian làm bài: {{ $exam->time }} phút</p>
                                        <p>Thời gian bắt đầu: {{ $exam->start_time }}</p>
                                        <p>Thời gian kết thúc: {{ $exam->stop_time }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="userDatatable adv-table-table global-shadow border-light-0 w-100 adv-table">
                                <div class="table-responsive">
                                    <div class="adv-table-table__header">
                                        <h4>Danh sách bài thi đã được làm</h4>
                                    </div>
                                    <div id="filter-form-container"></div>
                                    <table class="table mb-0 table-borderless adv-table" data-sorting="true"
                                        data-filter-container="#filter-form-container" data-paging-current="1"
                                        data-paging-position="right" data-paging-size="10">
                                        <thead>
                                            <tr class="userDatatable-header">
                                                <th>
                                                    <span class="userDatatable-title">Tên Sinh viên</span>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Mã đề</span>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Số điểm</span>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Thời gian bắt đầu làm bài</span>
                                                </th>
                                              
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($exam->test as $test)
                                                @foreach ($test->studentTest as $item)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex">
                                                                <div class="userDatatable-inline-title">
                                                                    <a href="{{ route('test.show', $item->id) }}" class="text-dark fw-500">
                                                                        <h6>{{ $item->student->name }}</h6>
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
