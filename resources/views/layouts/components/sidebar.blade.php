<div class="sidebar-wrapper">
    <div class="sidebar sidebar-collapse" id="sidebar">
        <div class="sidebar__menu-group">
            <ul class="sidebar_nav">
                
                    
               
                <li class="{{ request()->is('/') ? 'active' : '' }}">
                    <a href="{{ route('home') }}" class="">
                        <span class="nav-icon uil uil-home"></span>
                        <span class="menu-text">Trang chủ</span>

                    </a>
                </li>
                <li class="menu-title mt-30">
                    <span>Bài thi</span>
                </li>
                <li class="{{ request()->is('danh-sach-bai-thi*') ? 'active' : '' }}">
                    <a href="{{ route('studentTest.index') }}" class="">
                        <span class="nav-icon uil uil-swatchbook"></span>
                        <span class="menu-text">Danh sách bài thi</span>
                    </a>
                </li>
                <li class="{{ request()->is('lam-bai*') ? 'active' : '' }}">
                    <a href="{{ route('exam.code') }}" class="">
                        <span class="nav-icon uil uil-book-reader"></span>
                        <span class="menu-text">Làm bài thi</span>
                    </a>
                </li>
                @can('is_teacher')
                <li class="menu-title mt-30">
                    <span>Quản lý bài thi</span>
                </li>
                <li class="{{ request()->is('danh-sach-ki-thi*') ? 'active' : '' }}">
                    <a href="{{ route('exam.list') }}" class="">
                        <span class="nav-icon uil uil-list-ul"></span>
                        <span class="menu-text">Danh sách kì thi</span>
                    </a>
                </li>
                <li class="{{ request()->is('bai-thi*') ? 'active' : '' }}">
                    <a href="{{ route('exam.create.1') }}" class="">
                        <span class="nav-icon uil uil-focus-add"></span>
                        <span class="menu-text">Thêm kì thi</span>
                    </a>
                </li>
                @endcan
            </ul>
        </div>
    </div>
</div>
