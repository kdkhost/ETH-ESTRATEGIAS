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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css">
    
    <!-- Custom Premium CSS -->
    <link href="{{asset('css/libs/custom-dashboard.css')}}" rel="stylesheet">
    
    @yield('styles')
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        .nav-sidebar .nav-link.active { background-color: rgba(13, 110, 253, 0.9) !important; color: #fff !important; box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3); }
        .nav-sidebar .nav-item.menu-open > .nav-link { background-color: rgba(255, 255, 255, 0.05); }
        .sidebar-brand { height: 65px; border-bottom: 1px solid rgba(255, 255, 255, 0.1); }
        .app-header { border-bottom: 1px solid rgba(0, 0, 0, 0.05); }
        .nav-treeview > .nav-item > .nav-link { padding-left: 2.5rem; }
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
                </ul>
                <ul class="navbar-nav ms-auto">
                    <!-- Theme Toggle -->
                    <li class="nav-item me-2">
                        <button class="nav-link btn-link" id="theme-toggle" type="button">
                            <i class="fas fa-moon" id="theme-icon"></i>
                        </button>
                    </li>
                    <!-- User Menu -->
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            @php $user = Auth::user(); @endphp
                            <img src="{{$user->photo ? asset('images/media/' . $user->photo->file) : asset('img/200x200.png')}}" class="user-image rounded-circle shadow-sm" alt="User Image">
                            <span class="d-none d-md-inline fw-medium text-dark">{{ auth()->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end border-0 shadow">
                            <li class="user-header text-bg-primary rounded-top">
                                <img src="{{$user->photo ? asset('images/media/' . $user->photo->file) : asset('img/200x200.png')}}" class="rounded-circle shadow" alt="User Image">
                                <p class="mb-0">{{ auth()->user()->name }}</p>
                                <small>{{auth()->user()->role->name}}</small>
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
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <script>
        // Setup Ajax CSRF
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

        // Global Summernote
        $(document).ready(function() {
            if ($('.summernote').length > 0) {
                $('.summernote').summernote({
                    height: 350,
                    lang: 'pt-BR',
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['fullscreen', 'codeview', 'help']]
                    ]
                });
            }
        });

        // Global Notification
        function showToasty(msg, type = 'success') {
            let bg = type === 'success' ? "linear-gradient(to right, #00b09b, #96c93d)" : "linear-gradient(to right, #ff5f6d, #ffc371)";
            Toastify({ text: msg, duration: 4000, close: true, gravity: "top", position: "right", style: { background: bg } }).showToast();
        }

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
    </script>

    @yield('footer')

</body>
</html>
