@extends('dashboard')
@section('content')
    <div class="contents">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 mb-30">
                    <div class="card mt-30">
                        <div class="card-body">
                            <div class="userDatatable adv-table-table global-shadow border-light-0 w-100 adv-table">
                                <div class="table-responsive">
                                    <div class="adv-table-table__header">
                                        <h4>Danh sách bài thi đã làm</h4>
                                    </div>
                                    
                                    <table class="table mb-0 table-borderless adv-table" data-sorting="true"
                                        data-filter-container="#filter-form-container" data-paging-current="1"
                                        data-paging-position="right" data-paging-size="10">
                                        <thead>
                                            <tr class="userDatatable-header">
                                                <th>
                                                    <span class="userDatatable-title">Tên kì thi</span>
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


                                            @foreach ($exam as $item)
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
