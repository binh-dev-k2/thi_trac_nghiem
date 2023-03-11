<div class="sidebar-wrapper">
    <div class="sidebar sidebar-collapse" id="sidebar">
        <div class="sidebar__menu-group">
            <ul class="sidebar_nav">
                <li class="{{ request()->is('/') ? 'active' : '' }}">
                    <a href="changelog.html" class="">
                        <span class="nav-icon uil uil-arrow-growth"></span>
                        <span class="menu-text">Trang chủ</span>

                    </a>
                </li>
                <li class="menu-title mt-30">
                    <span>Bài thi</span>
                </li>
                <li class="">
                    <a href="#" class="">
                        <span class="nav-icon uil uil-list-ul"></span>
                        <span class="menu-text">Danh sách bài thi</span>
                    </a>
                </li>
                <li class="menu-title mt-30">
                    <span>Quản lý bài thi</span>
                </li>
                <li class="">
                    <a href="#" class="">
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
                <li class="menu-title mt-30">
                    <span>Quản lý tài khoản</span>
                </li>

                <li class="">
                    <a href="#" class="">
                        <span class="nav-icon uil uil-arrows-up-right"></span>
                        <span class="menu-text">Cập nhật thông tin</span>
                    </a>
                </li>
                <li class="">
                    <a href="#" class="">
                        <span class="nav-icon uil uil-lock-access"></span>
                        <span class="menu-text">Đổi mật khẩu</span>
                    </a>
                </li>




            </ul>
        </div>
    </div>
</div>
