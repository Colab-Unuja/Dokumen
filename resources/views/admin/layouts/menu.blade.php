<div id="kt_aside" class="aside aside-light aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
    data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
    data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <div class="aside-logo flex-column-auto" id="kt_aside_logo">
        <h1 class=" mt-5"><span class="text-primary">Universitas</span> <span class="text-warning">Nurul Jadid</span>
        </h1>

    </div>
    <div class="aside-menu flex-column-fluid">
        <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu"
            data-kt-scroll-offset="0">
            <div class="menu menu-column menu-rounded fw-bold fs-6" id="#kt_aside_menu" data-kt-menu="true">
                <div class="menu-item">
                    <a class="menu-link" href="{{ route('admin.index') }}">
                        <span class="menu-icon">
                            <i class="bi bi-menu-button"></i>
                        </span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </div>
                <div class='menu-item'>
                    <div data-kt-menu-trigger='click' class='menu-item menu-accordion'>
                        <span class='menu-link'>
                            <span class='menu-icon'><i class='bi bi-menu-button-wide-fill'></i></span>
                            <span class='menu-title'>Akses</span>
                            <span class='menu-arrow'></span>
                        </span>
                        <div class='menu-sub menu-sub-accordion menu-active-bg'>
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('admin.karyawan.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Karyawan</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('admin.dosen.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Dosen</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('admin.mahasiswa.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Mahasiswa</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='menu-item'>
                    <div data-kt-menu-trigger='click' class='menu-item menu-accordion'>
                        <span class='menu-link'>
                            <span class='menu-icon'><i class='bi bi-menu-button-wide-fill'></i></span>
                            <span class='menu-title'>Master</span>
                            <span class='menu-arrow'></span>
                        </span>
                        <div class='menu-sub menu-sub-accordion menu-active-bg'>
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('admin.fakultas.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Fakultas</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('admin.prodi.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Program Studi</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('admin.lembaga.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Lembaga</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('admin.unit.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Unit</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
