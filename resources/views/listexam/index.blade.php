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
                    <h4>Danh sách bài thi đã tạo</h4>
                    <div class="adv-table-table__button">
                      <div class="dropdown">
                        <a class="btn btn-primary dropdown-toggle dm-select" href="#" role="button"
                          id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Export
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                          <a class="dropdown-item" href="#">copy</a>
                          <a class="dropdown-item" href="#">csv</a>
                          <a class="dropdown-item" href="#">print</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div id="filter-form-container"></div>
                  <table class="table mb-0 table-borderless adv-table" data-sorting="true"
                    data-filter-container="#filter-form-container" data-paging-current="1"
                    data-paging-position="right" data-paging-size="10">
                    <thead>
                      <tr class="userDatatable-header">
                        <th>
                          <span class="userDatatable-title">Mã kì thi</span>
                        </th>
                        <th>
                          <span class="userDatatable-title">Tên kì thi</span>
                        </th>
                        <th>
                          <span class="userDatatable-title">Số lượng tham gia</span>
                        </th>
                        <th>
                          <span class="userDatatable-title">Số lượng đã tham gia</span>
                        </th>
                        <th data-type="html" data-name='position'>
                          <span class="userDatatable-title">thời gian thi</span>
                        </th>
                        <th>
                          <span class="userDatatable-title">Thời gian kết thúc</span>
                        </th>
                        <th data-type="html" data-name='status'>
                          <span class="userDatatable-title">trạng thái</span>
                        </th>
                        <th>
                          <span class="userDatatable-title float-end">Tùy chọn</span>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($exam as $item)
                        <tr>
                            <td>
                              <div class="userDatatable-content">{{  $item->id }}</div>
                            </td>
                            <td>
                              <div class="d-flex">
                                <div class="userDatatable-inline-title">
                                  <a href="{{ route('exam.show', $item->id) }}" class="text-dark fw-500">
                                    <h6>{{ $item->name }}</h6>
                                  </a>
                                </div>
                              </div>
                            </td>
                            <td>
                              <div class="userDatatable-content">
                               {{ $item->count_participants }}
                              </div>
                            </td>
                            <td>
                              <div class="userDatatable-content">
                                {{ $item->count_participanted }}
                              </div>
                            </td>
                            <td>
                              <div class="userDatatable-content">
                                {{ $item->start_time }}
                              </div>
                            </td>
                            <td>
                              <div class="userDatatable-content">
                                {{ $item->stop_time }}
                              </div>
                            </td>
                            <td>
                              <div class="userDatatable-content d-inline-block">
                                <span
                                  class="bg-opacity-success  color-success rounded-pill userDatatable-content-status active">active</span>
                              </div>
                            </td>
                            <td>
                              <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">
                                <li>
                                  <a href="{{ route('exam.show', $item->id) }}" class="view">
                                    <i class="uil uil-eye"></i>
                                  </a>
                                </li>
                                <li>
                                  <a href="#" class="edit">
                                    <i class="uil uil-edit"></i>
                                  </a>
                                </li>
                                <li>
                                  <a href="#" class="remove">
                                    <i class="uil uil-trash-alt"></i>
                                  </a>
                                </li>
                              </ul>
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