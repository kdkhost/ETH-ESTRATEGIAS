<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Marcelo Brad RJ">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Painel Administrativo | ETH Estratégias</title>
    
    <link rel="shortcut icon" href="{{route('home')}}/public/images/media/1660264709logo3.png" type="image/x-icon">
    
    <!-- Fonts and Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/all.min.css">
    
    <!-- AdminLTE 4 & Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta2/dist/css/adminlte.min.css">
    
    <!-- Global Plugins -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://unpkg.com/filepond/dist/filepond.css">
    <link rel="stylesheet" href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css">
    <link rel="stylesheet" href="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css">
    
    <!-- Custom Premium CSS -->
    <link href="{{asset('css/libs/custom-dashboard.css')}}?v={{time()}}" rel="stylesheet">
    
    @yield('styles')
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        .nav-sidebar .nav-link.active { background-color: rgba(13, 110, 253, 0.9) !important; color: #fff !important; box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3); }
        .nav-sidebar .nav-item.menu-open > .nav-link { background-color: rgba(255, 255, 255, 0.05); }
        .sidebar-brand { height: 65px; border-bottom: 1px solid rgba(255, 255, 255, 0.1); }
        .app-header { border-bottom: 1px solid rgba(0, 0, 0, 0.05); }
        .nav-treeview > .nav-item > .nav-link { padding-left: 2.5rem; }
        
        /* Botões Padronizados Premium */
        .btn-primary { background: linear-gradient(135deg, #0d6efd 0%, #004ecb 100%); border: none; box-shadow: 0 4px 10px rgba(13, 110, 253, 0.2); transition: all 0.3s; }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 6px 15px rgba(13, 110, 253, 0.3); }
        .btn-success { background: linear-gradient(135deg, #198754 0%, #10633d 100%); border: none; }
        .btn-danger { background: linear-gradient(135deg, #dc3545 0%, #a71d2a 100%); border: none; }
        .btn-warning { background: linear-gradient(135deg, #ffc107 0%, #d39e00 100%); border: none; color: #fff !important; }
        
        /* Summernote Premium Adjustments */
        .note-editor { border-radius: 0.75rem !important; border: 1px solid rgba(0,0,0,0.1) !important; overflow: hidden; background: #fff !important; margin-bottom: 1rem; }
        .note-toolbar { background: #f8f9fa !important; border-bottom: 1px solid rgba(0,0,0,0.05) !important; }
        [data-bs-theme="dark"] .note-editor { background: #2b3035 !important; color: #fff; border-color: rgba(255,255,255,0.1) !important; }
        [data-bs-theme="dark"] .note-editable { background: #1e293b !important; color: #fff; }
        [data-bs-theme="dark"] .note-toolbar { background: #343a40 !important; }
        [data-bs-theme="dark"] .note-btn { color: #eee !important; background: transparent !important; border-color: rgba(255,255,255,0.1) !important; }

        /* FilePond Premium Customization */
        .filepond--root { font-family: 'Inter', sans-serif; border-radius: 1rem; }
        .filepond--panel-root { background-color: #f1f5f9; border: 2px dashed #cbd5e1; }
        [data-bs-theme="dark"] .filepond--panel-root { background-color: #1e293b; border-color: #475569; }

        /* Dashboard Gourmet Boxes (AdminLTE 4 Premium Style) - Compact Version */
        .gourmet-box {
            border-radius: 1rem !important;
            border: none !important;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            overflow: hidden;
            position: relative;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05) !important;
            color: #fff !important;
            min-height: 110px;
        }
        .gourmet-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.1) !important;
        }
        .gourmet-box .inner { padding: 1rem !important; position: relative; z-index: 2; }
        .gourmet-box .inner h3 { font-size: 1.5rem !important; font-weight: 800 !important; margin-bottom: 0px !important; letter-spacing: -0.5px; }
        .gourmet-box .inner p { font-size: 0.75rem !important; font-weight: 600; opacity: 0.85; text-transform: uppercase; letter-spacing: 0.3px; margin-bottom: 0; }
        
        .gourmet-box .icon {
            position: absolute;
            top: 5px;
            right: 10px;
            z-index: 1;
            font-size: 45px;
            opacity: 0.12;
            transition: all 0.4s ease;
        }
        .gourmet-box:hover .icon { transform: scale(1.1) rotate(-3deg); opacity: 0.2; }
        
        .gourmet-box .small-box-footer {
            background: rgba(0,0,0,0.1) !important;
            padding: 5px !important;
            text-transform: uppercase;
            font-size: 0.6rem !important;
            letter-spacing: 1px;
            font-weight: 700;
            display: block;
            text-align: center;
            color: rgba(255,255,255,0.85) !important;
            text-decoration: none;
            transition: background 0.3s;
            position: relative;
            z-index: 3;
        }
        .gourmet-box .small-box-footer:hover { background: rgba(0,0,0,0.2) !important; color: #fff !important; }

        /* Premium Gradients */
        .bg-gourmet-blue { background: linear-gradient(135deg, #0d6efd 0%, #004ecb 100%) !important; }
        .bg-gourmet-green { background: linear-gradient(135deg, #198754 0%, #10633d 100%) !important; }
        .bg-gourmet-cyan { background: linear-gradient(135deg, #0dcaf0 0%, #0aa2c0 100%) !important; }
        .bg-gourmet-orange { background: linear-gradient(135deg, #fd7e14 0%, #d9680b 100%) !important; }
        .bg-gourmet-red { background: linear-gradient(135deg, #dc3545 0%, #a71d2a 100%) !important; }
        .bg-gourmet-indigo { background: linear-gradient(135deg, #6610f2 0%, #4b08af 100%) !important; }
        .bg-gourmet-purple { background: linear-gradient(135deg, #6f42c1 0%, #522e8c 100%) !important; }
        .bg-gourmet-pink { background: linear-gradient(135deg, #d63384 0%, #a61a5e 100%) !important; }

        /* Gourmet Card Light (KPIs) */
        .gourmet-card-light {
            border-radius: 1.25rem !important;
            border: none !important;
            background: #fff !important;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            box-shadow: 0 8px 20px rgba(0,0,0,0.03) !important;
            position: relative;
            overflow: hidden;
        }
        [data-bs-theme="dark"] .gourmet-card-light {
            background: #2b3035 !important;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2) !important;
        }
        .gourmet-card-light:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.08) !important;
        }
        .gourmet-card-light .card-body { padding: 1.25rem !important; }
        .gourmet-card-light .icon-shape {
            width: 52px;
            height: 52px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            font-size: 1.4rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        .gourmet-card-light:hover .icon-shape {
            transform: rotate(8deg) scale(1.1);
        }
        .gourmet-card-light h3 {
            font-size: 1.75rem !important;
            font-weight: 800 !important;
            margin-bottom: 2px !important;
            color: #1e293b;
        }
        [data-bs-theme="dark"] .gourmet-card-light h3 { color: #f8f9fa; }
        .gourmet-card-light .text-label {
            font-size: 0.8rem !important;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .pricing-title-box h3 { font-size: 1.1rem !important; font-weight: 700 !important; margin-bottom: 5px !important; color: #1e293b; }
        .pricing-title-box p { font-size: 0.85rem !important; color: #64748b; margin-bottom: 0; }
        .pricing-title-box span { font-size: 0.85rem !important; }
    </style>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">

        <!-- Header / Topbar -->
        <nav class="app-header navbar navbar-expand bg-body shadow-sm">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item"> <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"> <i class="fas fa-bars"></i> </a> </li>
                    <li class="nav-item d-none d-md-block ms-2"> 
                        <a target="_blank" href="{{ route('home') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                            <i class="fas fa-external-link-alt me-1"></i> Ver Site
                        </a> 
                    </li>
                    <li class="nav-item d-none d-md-block ms-2">
                        <button id="btn-clear-cache" class="btn btn-sm btn-outline-success rounded-pill px-3" title="Limpar todos os caches do sistema">
                            <i class="fas fa-broom me-1"></i> Limpar Cache
                        </button>
                    </li>
                    <li class="nav-item d-none d-md-block ms-2">
                        <button id="btn-clear-views" class="btn btn-sm btn-outline-warning rounded-pill px-3" title="Limpar apenas cache de views" style="color:#856404">
                            <i class="fas fa-layer-group me-1"></i> Cache Views
                        </button>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <!-- Indicador de visitas hoje -->
                    <li class="nav-item me-2 d-none d-lg-flex align-items-center">
                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 rounded-pill small" id="navbar-visits-badge" title="Visitas hoje">
                            <i class="fas fa-chart-line me-1"></i> <span id="visits-count">--</span> visitas hoje
                        </span>
                    </li>
                    <!-- Theme Toggle -->
                    <li class="nav-item me-2">
                        <button class="nav-link btn-link" id="theme-toggle" type="button">
                            <i class="fas fa-moon" id="theme-icon"></i>
                        </button>
                    </li>
                    <!-- Real-time Clock -->
                    <li class="nav-item me-3 d-none d-md-flex align-items-center">
                        <div class="fw-bold text-dark font-monospace bg-light px-3 py-1 rounded-pill border shadow-sm" style="font-size: 0.9rem; min-width: 110px; text-align: center;">
                            <i class="far fa-clock me-2 text-primary"></i><span id="real-time-clock">00:00:00</span>
                        </div>
                    </li>
                    <!-- User Menu -->
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            @php $user = Auth::user(); @endphp
                            <img src="{{$user->photo ? asset('images/media/' . $user->photo->file) : asset('img/200x200.png')}}" class="user-image rounded-circle shadow-sm" alt="User Image">
                            <span class="d-none d-md-inline fw-medium text-dark">{!! clean(auth()->user()->name) !!}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end border-0 shadow">
                            <li class="user-header text-bg-primary rounded-top">
                                <img src="{{$user->photo ? asset('images/media/' . $user->photo->file) : asset('img/200x200.png')}}" class="rounded-circle shadow" alt="User Image">
                                <p class="mb-0">{!! clean(auth()->user()->name) !!}</p>
                                <small>{!! clean(auth()->user()->role->name) !!}</small>
                            </li>
                            <li class="user-footer bg-light p-3 d-flex justify-content-between">
                                <a href="{{ url('/admin/users') }}/{{auth()->user()->id}}/edit" class="btn btn-sm btn-light border">Perfil</a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal" class="btn btn-sm btn-danger px-3">Sair</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Sidebar -->
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
            <div class="sidebar-brand">
                <a href="{{ route('dashboard.index') }}" class="brand-link">
                    <img src="{{route('home')}}/public/images/media/1705726533logo.png" alt="ETH Logo" class="brand-image opacity-75">
                    <span class="brand-text fw-semibold ms-2">ETH <span class="fw-light">Estratégias</span></span>
                </a>
            </div>
            <div class="sidebar-wrapper">
                <nav class="mt-3 px-2">
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                        
                        <!-- Dashboard -->
                        <li class="nav-item">
                            <a href="{{ route('dashboard.index') }}" class="nav-link {{ Request::is('admin') || Request::is('dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-chart-line"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        @php $lang = App\Models\Language::find(1); @endphp

                        <!-- Content Management Section -->
                        <li class="nav-header text-uppercase small opacity-50 mt-3 mb-1">Conteúdo Principal</li>

                        <!-- Pages -->
                        <li class="nav-item {{ Request::is('admin/page*') || Request::is('admin/custom-page*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ Request::is('admin/page*') || Request::is('admin/custom-page*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Páginas
                                    <i class="nav-arrow fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"> <a href="{{ route('page.index') }}?language={{$lang->code}}" class="nav-link {{ Request::is('admin/page') && !Request::is('admin/page/create') ? 'active' : '' }}"> <i class="nav-icon far fa-circle"></i> <p>Listar Páginas</p> </a> </li>
                                <li class="nav-item"> <a href="{{ route('page.create') }}?language={{$lang->code}}" class="nav-link {{ Request::is('admin/page/create') ? 'active' : '' }}"> <i class="nav-icon far fa-circle"></i> <p>Criar Nova</p> </a> </li>
                                <li class="nav-item"> <a href="{{ route('index-custom') }}?language={{$lang->code}}" class="nav-link {{ Request::is('admin/custom-page') ? 'active' : '' }}"> <i class="nav-icon far fa-circle"></i> <p>Páginas Customizadas</p> </a> </li>
                            </ul>
                        </li>

                        <!-- Projects -->
                        <li class="nav-item {{ Request::is('admin/project*') || Request::is('admin/project-category*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ Request::is('admin/project*') || Request::is('admin/project-category*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-briefcase"></i>
                                <p>
                                    Portfólio / Projetos
                                    <i class="nav-arrow fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"> <a href="{{ route('project.index') }}?language={{$lang->code}}" class="nav-link {{ Request::is('admin/project') && !Request::is('admin/project/create') ? 'active' : '' }}"> <i class="nav-icon far fa-circle"></i> <p>Todos os Projetos</p> </a> </li>
                                <li class="nav-item"> <a href="{{ route('project.create') }}?language={{$lang->code}}" class="nav-link {{ Request::is('admin/project/create') ? 'active' : '' }}"> <i class="nav-icon far fa-circle"></i> <p>Novo Projeto</p> </a> </li>
                                <li class="nav-item"> <a href="{{ route('project-category.index') }}?language={{$lang->code}}" class="nav-link {{ Request::is('admin/project-category*') ? 'active' : '' }}"> <i class="nav-icon far fa-circle"></i> <p>Categorias</p> </a> </li>
                            </ul>
                        </li>

                        <!-- Blog -->
                        <li class="nav-item {{ Request::is('admin/post*') || Request::is('admin/category*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ Request::is('admin/post*') || Request::is('admin/category*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-newspaper"></i>
                                <p>
                                    Blog / Notícias
                                    <i class="nav-arrow fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"> <a href="{{ route('post.index') }}?language={{$lang->code}}" class="nav-link {{ Request::is('admin/post') && !Request::is('admin/post/create') ? 'active' : '' }}"> <i class="nav-icon far fa-circle"></i> <p>Listar Posts</p> </a> </li>
                                <li class="nav-item"> <a href="{{ route('post.create') }}?language={{$lang->code}}" class="nav-link {{ Request::is('admin/post/create') ? 'active' : '' }}"> <i class="nav-icon far fa-circle"></i> <p>Criar Post</p> </a> </li>
                                <li class="nav-item"> <a href="{{ route('category.index') }}?language={{$lang->code}}" class="nav-link {{ Request::is('admin/category*') ? 'active' : '' }}"> <i class="nav-icon far fa-circle"></i> <p>Categorias de Blog</p> </a> </li>
                            </ul>
                        </li>

                        <!-- Media Center -->
                        <li class="nav-item {{ Request::is('admin/media*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ Request::is('admin/media*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-photo-video"></i>
                                <p>
                                    Mídia Center
                                    <i class="nav-arrow fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"> <a href="{{ route('media.index') }}" class="nav-link {{ Request::is('admin/media') ? 'active' : '' }}"> <i class="nav-icon far fa-circle"></i> <p>Galeria de Imagens</p> </a> </li>
                                <li class="nav-item"> <a href="{{ route('media.create') }}" class="nav-link {{ Request::is('admin/media/create') ? 'active' : '' }}"> <i class="nav-icon far fa-circle"></i> <p>Upload de Arquivos</p> </a> </li>
                            </ul>
                        </li>

                        <!-- Elements Section -->
                        <li class="nav-header text-uppercase small opacity-50 mt-3 mb-1">Elementos da Interface</li>

                        <li class="nav-item {{ Request::is('admin/slider*') || Request::is('admin/service*') || Request::is('admin/testimonial*') || Request::is('admin/member*') || Request::is('admin/client*') || Request::is('admin/pricing*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ Request::is('admin/slider*') || Request::is('admin/service*') || Request::is('admin/testimonial*') || Request::is('admin/member*') || Request::is('admin/client*') || Request::is('admin/pricing*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Componentes
                                    <i class="nav-arrow fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"> <a href="{{ route('slider.index') }}?language={{$lang->code}}" class="nav-link {{ Request::is('admin/slider*') ? 'active' : '' }}"> <i class="nav-icon fas fa-sliders-h"></i> <p>Sliders Home</p> </a> </li>
                                <li class="nav-item"> <a href="{{ route('service.index') }}?language={{$lang->code}}" class="nav-link {{ Request::is('admin/service*') ? 'active' : '' }}"> <i class="nav-icon fas fa-concierge-bell"></i> <p>Serviços</p> </a> </li>
                                <li class="nav-item"> <a href="{{ route('testimonial.index') }}?language={{$lang->code}}" class="nav-link {{ Request::is('admin/testimonial*') ? 'active' : '' }}"> <i class="nav-icon fas fa-comment-dots"></i> <p>Depoimentos</p> </a> </li>
                                <li class="nav-item"> <a href="{{ route('member.index') }}?language={{$lang->code}}" class="nav-link {{ Request::is('admin/member*') ? 'active' : '' }}"> <i class="nav-icon fas fa-users"></i> <p>Nossa Equipe</p> </a> </li>
                                <li class="nav-item"> <a href="{{ route('client.index') }}?language={{$lang->code}}" class="nav-link {{ Request::is('admin/client*') ? 'active' : '' }}"> <i class="nav-icon fas fa-handshake"></i> <p>Clientes</p> </a> </li>
                                <li class="nav-item"> <a href="{{ route('pricing.index') }}?language={{$lang->code}}" class="nav-link {{ Request::is('admin/pricing*') ? 'active' : '' }}"> <i class="nav-icon fas fa-tags"></i> <p>Tabelas de Preços</p> </a> </li>
                            </ul>
                        </li>

                        <!-- System Section -->
                        <li class="nav-header text-uppercase small opacity-50 mt-3 mb-1">Administração</li>

                        @if(Auth::user()->role->name == 'administrator')
                        <li class="nav-item {{ Request::is('admin/users*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users-cog"></i>
                                <p>
                                    Gerenciar Usuários
                                    <i class="nav-arrow fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"> <a href="{{ route('users.index') }}" class="nav-link {{ Request::is('admin/users') ? 'active' : '' }}"> <i class="nav-icon far fa-circle"></i> <p>Todos os Usuários</p> </a> </li>
                                <li class="nav-item"> <a href="{{ route('users.create') }}" class="nav-link {{ Request::is('admin/users/create') ? 'active' : '' }}"> <i class="nav-icon far fa-circle"></i> <p>Criar Novo</p> </a> </li>
                            </ul>
                        </li>

                        <li class="nav-item {{ Request::is('admin/settings*') || Request::is('admin/menu*') || Request::is('admin/header-footer*') || Request::is('admin/language*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ Request::is('admin/settings*') || Request::is('admin/menu*') || Request::is('admin/header-footer*') || Request::is('admin/language*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>
                                    Configurações
                                    <i class="nav-arrow fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"> <a href="{{ route('setting.edit') }}?language={{$lang->code}}" class="nav-link {{ Request::is('admin/settings*') ? 'active' : '' }}"> <i class="nav-icon far fa-circle"></i> <p>Configurações do Site</p> </a> </li>
                                <li class="nav-item"> <a href="{{ route('menu.index') }}?language={{$lang->code}}" class="nav-link {{ Request::is('admin/menu*') ? 'active' : '' }}"> <i class="nav-icon far fa-circle"></i> <p>Menu de Navegação</p> </a> </li>
                                <li class="nav-item"> <a href="{{ route('headerfooter-setting.edit') }}?language={{$lang->code}}" class="nav-link {{ Request::is('admin/header-footer*') ? 'active' : '' }}"> <i class="nav-icon far fa-circle"></i> <p>Cabeçalho e Rodapé</p> </a> </li>
                                <li class="nav-item"> <a href="{{ route('language.index') }}" class="nav-link {{ Request::is('admin/language*') ? 'active' : '' }}"> <i class="nav-icon far fa-circle"></i> <p>Idiomas</p> </a> </li>
                                <li class="nav-item"> <a href="{{ route('system.optimize') }}" class="nav-link text-success"> <i class="nav-icon fas fa-bolt"></i> <p>Otimizar Sistema</p> </a> </li>
                            </ul>
                        </li>
                        @endif

                        <li class="nav-item mt-4">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal" class="nav-link text-danger">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Encerrar Sessão</p>
                            </a>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper -->
        <main class="app-main">
            <div class="app-content-header py-3">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Breadcrumbs or Title could go here -->
                    </div>
                </div>
            </div>

            <div class="app-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="app-footer border-top bg-white py-3">
            <div class="float-end d-none d-sm-inline opacity-50">v1.2 | Laravel 12</div>
            <strong class="fw-medium text-dark">Copyright &copy; 2026 Marcelo Brad RJ.</strong> Todos os direitos reservados.
        </footer>

    </div>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Pronto para Sair?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-4">
                    Selecione "Sair" abaixo se você estiver pronto para encerrar sua sessão atual.
                </div>
                <div class="modal-footer bg-light border-0">
                    <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">Cancelar</button>
                    <a class="btn btn-danger px-4 shadow-sm" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair Agora</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta2/dist/js/adminlte.min.js"></script>
    
    <!-- SweetAlert2, Toastify, FilePond, Summernote -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/lang/summernote-pt-BR.min.js"></script>

    <script>
        // Setup Ajax CSRF
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

        // Global Summernote Premium Initialization (Truly Global for ALL textareas)
        $(document).ready(function() {
            const initSummernote = () => {
                // Alvo: Todos os textareas, exceto os que possuem classe .no-summernote ou sejam inputs do ACE editor
                $('textarea').not('.no-summernote, .ace_text-input').each(function() {
                    if (!$(this).next('.note-editor').length) { 
                        $(this).summernote({
                            height: 300,
                            lang: 'pt-BR',
                            placeholder: 'Edite seu conteúdo aqui...',
                            dialogsInBody: true,
                            toolbar: [
                                ['style', ['style']],
                                ['font', ['bold', 'underline', 'clear', 'strikethrough']],
                                ['fontname', ['fontname']],
                                ['fontsize', ['fontsize']],
                                ['color', ['color']],
                                ['para', ['ul', 'ol', 'paragraph']],
                                ['table', ['table']],
                                ['insert', ['link', 'picture', 'video', 'hr']],
                                ['view', ['fullscreen', 'codeview', 'help']]
                            ]
                        });
                    }
                });
            };

            initSummernote();

            // Re-inicializar em modais
            $(document).on('shown.bs.modal', function() {
                initSummernote();
            });
        });

        // Global FilePond Premium Config
        FilePond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginFileValidateType,
            FilePondPluginFileValidateSize,
            FilePondPluginFileEncode
        );

        FilePond.setOptions({
            labelIdle: 'Arrasta e solta seus arquivos ou <span class="filepond--label-action">Procure</span>',
            credits: false
        });

        // Global Notification
        // Relógio em Tempo Real
        function updateClock() {
            const now = new Date();
            const options = { 
                timeZone: 'America/Sao_Paulo', 
                hour: '2-digit', 
                minute: '2-digit', 
                second: '2-digit', 
                hour12: false 
            };
            const timeString = now.toLocaleTimeString('pt-BR', options);
            const clockEl = document.getElementById('real-time-clock');
            if(clockEl) clockEl.innerText = timeString;
        }
        setInterval(updateClock, 1000);
        updateClock();

        function showToasty(msg, type = 'success') {
            let configs = {
                success: { bg: "linear-gradient(to right, #00b09b, #96c93d)", icon: "✅" },
                error:   { bg: "linear-gradient(to right, #ff5f6d, #ffc371)", icon: "❌" },
                warning: { bg: "linear-gradient(to right, #f7971e, #ffd200)", icon: "⚠️" },
                info:    { bg: "linear-gradient(to right, #2193b0, #6dd5ed)", icon: "ℹ️" }
            };
            let cfg = configs[type] || configs.success;
            Toastify({
                text: cfg.icon + " " + msg,
                duration: 4500,
                close: true,
                gravity: "top",
                position: "right",
                style: { background: cfg.bg, borderRadius: "12px", fontFamily: "'Inter', sans-serif", fontSize: "14px", padding: "14px 20px", boxShadow: "0 8px 20px rgba(0,0,0,0.15)" }
            }).showToast();
        }

        // ====================================================
        // Flash Messages Globais do Laravel → Toastify
        // ====================================================
        @foreach([
            'user_success','user_error',
            'post_success','project_success','page_success',
            'service_success','testimonial_success','member_success',
            'client_success','slider_success','pricing_success',
            'category_success','language_success','menu_success',
            'setting_success','setting_error','success','error'
        ] as $flash)
            @if(session($flash))
                @php $type = (str_ends_with($flash, '_error') || $flash === 'error') ? 'error' : 'success'; @endphp
                showToasty("{{ addslashes(session($flash)) }}", "{{ $type }}");
            @endif
        @endforeach

        // Erros de validação
        @if($errors->any())
            @foreach($errors->all() as $error)
                showToasty("{{ addslashes($error) }}", "error");
            @endforeach
        @endif


        // Theme Toggle
        const themeToggle = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');
        const html = document.documentElement;
        const savedTheme = localStorage.getItem('admin-theme') || 'light';
        html.setAttribute('data-bs-theme', savedTheme);
        updateThemeIcon(savedTheme);

        themeToggle.addEventListener('click', () => {
            const currentTheme = html.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            html.setAttribute('data-bs-theme', newTheme);
            localStorage.setItem('admin-theme', newTheme);
            updateThemeIcon(newTheme);
        });

        function updateThemeIcon(theme) {
            if (theme === 'dark') { themeIcon.classList.replace('fa-moon', 'fa-sun'); } 
            else { themeIcon.classList.replace('fa-sun', 'fa-moon'); }
        }

        // Global Single Delete Confirmation
        $(document).on('submit', '.single-delete-form', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Tem certeza?',
                text: "Esta ação excluirá permanentemente este item!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });

        // ====================================================
        // Botões de Cache (Navbar) via AJAX
        // ====================================================
        $('#btn-clear-cache').on('click', function() {
            let btn = $(this);
            Swal.fire({
                title: 'Limpar todos os caches?',
                text: 'Isso irá regenerar os arquivos de cache de rotas, configurações e views para máxima performance.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fas fa-broom me-1"></i> Sim, limpar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i> Limpando...');
                    $.ajax({
                        url: '{{ route("system.optimize") }}',
                        type: 'GET',
                        dataType: 'json',
                        headers: { 'X-Requested-With': 'XMLHttpRequest' },
                        success: function(response) {
                            if(response.success) {
                                showToasty(response.message, 'success');
                            } else {
                                showToasty('Aviso: ' + response.message, 'warning');
                            }
                            btn.prop('disabled', false).html('<i class="fas fa-broom me-1"></i> Limpar Cache');
                        },
                        error: function(xhr) {
                            let errorMsg = 'Erro ao limpar cache.';
                            if(xhr.responseJSON && xhr.responseJSON.message) errorMsg += ' Detalhes: ' + xhr.responseJSON.message;
                            showToasty(errorMsg, 'error');
                            btn.prop('disabled', false).html('<i class="fas fa-broom me-1"></i> Limpar Cache');
                        }
                    });
                }
            });
        });

        $('#btn-clear-views').on('click', function() {
            let btn = $(this);
            btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i>');
            $.ajax({
                url: '{{ route("system.optimize") }}',
                type: 'GET',
                dataType: 'json',
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                success: function(response) {
                    showToasty('✅ Cache de views limpo!', 'success');
                    btn.prop('disabled', false).html('<i class="fas fa-layer-group me-1"></i> Cache Views');
                },
                error: function(xhr) {
                    showToasty('Erro ao limpar cache de views.', 'error');
                    btn.prop('disabled', false).html('<i class="fas fa-layer-group me-1"></i> Cache Views');
                }
            });
        });


        // Badge de visitas hoje (na navbar)
        $.ajax({
            url: '{{ url("/admin/api/visits-today") }}',
            type: 'GET',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            success: function(data) {
                if (data.count !== undefined) {
                    $('#visits-count').text(data.count);
                }
            }
        });
    </script>

    @yield('footer')

</body>
</html>
