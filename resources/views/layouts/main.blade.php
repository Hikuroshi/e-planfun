<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>e-planfun | {{ $title }}</title>
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/assets/dist/css/adminlte.min.css">
    
    @yield('css')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="/logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="/" class="brand-link text-center">
                <h1 class="brand-text font-weight-light">E-Planfun</h1>
            </a>
            
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="/assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ auth()->user()->role->nama }}</a>
                    </div>
                </div>
                
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        @can('super-user')
                        <li class="nav-item {{ request()->is('dashboard/users*') || request()->is('dashboard/kode-rekenings*') || request()->is('dashboard/kegiatans*') || request()->is('dashboard/barangs*') || request()->is('dashboard/anggarans*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->is('dashboard/users*') || request()->is('dashboard/kode-rekenings*') || request()->is('dashboard/kegiatans*') || request()->is('dashboard/barangs*') || request()->is('dashboard/anggarans*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tasks"></i>
                                <p>
                                    Master
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/dashboard/users" class="nav-link {{ request()->is('dashboard/users*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>User</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/dashboard/kode-rekenings" class="nav-link {{ request()->is('dashboard/kode-rekenings*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kode Rekening</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/dashboard/kegiatans" class="nav-link {{ request()->is('dashboard/kegiatans*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kegiatan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/dashboard/barangs" class="nav-link {{ request()->is('dashboard/barangs*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Barang</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/dashboard/anggarans" class="nav-link {{ request()->is('dashboard/anggarans*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Anggaran</p>
                                    </a>
                                </li>
                            </ul>
                        </li>                        
                        @endcan
                        <li class="nav-item {{ request()->is('dashboard/usulans*') || request()->is('dashboard/verifikasi-usulan') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->is('dashboard/usulans*') || request()->is('dashboard/verifikasi-usulan') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-lightbulb"></i>
                                <p>
                                    Usulan
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/dashboard/usulans" class="nav-link {{ request()->is('dashboard/usulans') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Daftar Usulan</p>
                                    </a>
                                </li>
                                @can('operator')
                                <li class="nav-item">
                                    <a href="/dashboard/usulans/create" class="nav-link {{ request()->is('dashboard/usulans/create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Input Usulan</p>
                                    </a>
                                </li>
                                @endcan
                                @can('verifikator')
                                <li class="nav-item">
                                    <a href="/dashboard/verifikasi-usulan" class="nav-link {{ request()->is('dashboard/verifikasi-usulan') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Verifikasi Usulan</p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ request()->is('dashboard/laporan*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-table"></i>
                                <p>Laporan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ request()->is('dashboard/datadukung*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>Data Pendukung</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">{{ $title }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    @if (count(request()->segments()) === 0)
                                    Home
                                    @else
                                    <a href="{{ url('/') }}">Home</a>
                                    @endif
                                </li>
                                @foreach (request()->segments() as $key => $segment)
                                <li class="breadcrumb-item {{ ($key === count(request()->segments()) - 1) ? 'active' : '' }}">
                                    @if ($key === count(request()->segments()) - 1)
                                    {{ ucfirst($segment) }}
                                    @else
                                    <a href="{{ url(implode('/', array_slice(request()->segments(), 0, $key + 1))) }}">{{ ucfirst($segment) }}</a>
                                    @endif
                                </li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    @yield('container')
                </div>
            </section>
        </div>
        
        <footer class="main-footer">
            <div class="float-right d-none d-sm-inline">
                e-planfun
            </div>
            <strong>Copyright &copy; 2023 <a href="https://dpdri.go.id">dpdri.go.id</a>.</strong> All rights reserved.
        </footer>
    </div>
    
    <script src="/assets/plugins/jquery/jquery.min.js"></script>
    <script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/dist/js/adminlte.min.js"></script>
    @yield('js')
</body>
</html>