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
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/all.min.css">
    
    <!-- AdminLTE 4 & Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta2/dist/css/adminlte.min.css">
    
    <!-- Global Plugins: SweetAlert2, Toastify, FilePond, Summernote -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://unpkg.com/filepond/dist/filepond.css">
    <link rel="stylesheet" href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css">
    
    <!-- Custom CSS -->
    <link href="{{asset('css/libs/custom-dashboard.css')}}" rel="stylesheet">
    
    @yield('styles')
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">

        <!-- Header / Topbar -->
        <nav class="app-header navbar navbar-expand bg-body">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item"> <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"> <i class="fas fa-bars"></i> </a> </li>
                    <li class="nav-item d-none d-md-block"> <a target="_blank" href="{{ route('home') }}" class="nav-link btn btn-sm btn-primary text-white shadow-sm"><i class="fab fa-chrome"></i> {{clean( trans('niva-backend.view_website') , array('Attr.EnableID' => true))}}</a> </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <!-- User Menu -->
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            @php $user = Auth::user(); @endphp
                            <img src="{{$user->photo ? '/public/images/media/' . $user->photo->file : '/public/img/200x200.png'}}" class="user-image rounded-circle shadow" alt="User Image">
                            <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <li class="user-header text-bg-primary">
                                <img src="{{$user->photo ? '/public/images/media/' . $user->photo->file : '/public/img/200x200.png'}}" class="rounded-circle shadow" alt="User Image">
                                <p>{{ auth()->user()->name }}</p>
                            </li>
                            <li class="user-footer">
                                <a href="{{ url('/admin/users') }}/{{auth()->user()->id}}/edit" class="btn btn-default btn-flat">{{clean( trans('niva-backend.edit_user') , array('Attr.EnableID' => true))}}</a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal" class="btn btn-default btn-flat float-end">{{clean( trans('niva-backend.logout') , array('Attr.EnableID' => true))}}</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Sidebar -->
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
            <div class="sidebar-brand">
                <a href="#0" class="brand-link">
                    <img src="{{route('home')}}/public/images/media/1705726533logo.png" alt="ETH Logo" class="brand-image opacity-75 shadow">
                    <span class="brand-text fw-light">ETH</span>
                </a>
            </div>
            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                        
                        <!-- Dashboard -->
                        <li class="nav-item">
                            <a href="{{ route('dashboard.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>{{clean( trans('niva-backend.dashboard') , array('Attr.EnableID' => true))}}</p>
                            </a>
                        </li>

                        @php $lang = App\Models\Language::find(1); @endphp

                        @if(Auth::user()->role->name == 'administrator')
                        <!-- Pages -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-file"></i>
                                <p>
                                    {{clean( trans('niva-backend.pages') , array('Attr.EnableID' => true))}}
                                    <i class="nav-arrow fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"> <a href="{{ route('page.index') }}?language=@php echo $lang->code; @endphp" class="nav-link"> <i class="nav-icon far fa-circle"></i> <p>{{clean( trans('niva-backend.all_pages') , array('Attr.EnableID' => true))}}</p> </a> </li>
                                <li class="nav-item"> <a href="{{ route('page.create') }}?language=@php echo $lang->code; @endphp" class="nav-link"> <i class="nav-icon far fa-circle"></i> <p>{{clean( trans('niva-backend.create_page') , array('Attr.EnableID' => true))}}</p> </a> </li>
                                <li class="nav-header">{{clean( trans('niva-backend.custom_pages') , array('Attr.EnableID' => true))}}</li>
                                <li class="nav-item"> <a href="{{ route('index-custom') }}?language=@php echo $lang->code; @endphp" class="nav-link"> <i class="nav-icon far fa-circle"></i> <p>{{clean( trans('niva-backend.custom_templates') , array('Attr.EnableID' => true))}}</p> </a> </li>
                            </ul>
                        </li>

                        <!-- Projects -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-pencil-ruler"></i>
                                <p>
                                    {{clean( trans('niva-backend.projects') , array('Attr.EnableID' => true))}}
                                    <i class="nav-arrow fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"> <a href="{{ route('project.index') }}?language=@php echo $lang->code; @endphp" class="nav-link"> <i class="nav-icon far fa-circle"></i> <p>{{clean( trans('niva-backend.all_projects') , array('Attr.EnableID' => true))}}</p> </a> </li>
                                <li class="nav-item"> <a href="{{ route('project.create') }}?language=@php echo $lang->code; @endphp" class="nav-link"> <i class="nav-icon far fa-circle"></i> <p>{{clean( trans('niva-backend.create_project') , array('Attr.EnableID' => true))}}</p> </a> </li>
                                <li class="nav-header">{{clean( trans('niva-backend.categories') , array('Attr.EnableID' => true))}}</li>
                                <li class="nav-item"> <a href="{{ route('project-category.index') }}?language=@php echo $lang->code; @endphp" class="nav-link"> <i class="nav-icon far fa-circle"></i> <p>{{clean( trans('niva-backend.all_categories') , array('Attr.EnableID' => true))}}</p> </a> </li>
                            </ul>
                        </li>
                        @endif

                        <!-- Posts -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-file-signature"></i>
                                <p>
                                    {{clean( trans('niva-backend.posts') , array('Attr.EnableID' => true))}}
                                    <i class="nav-arrow fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"> <a href="{{ route('post.index') }}?language=@php echo $lang->code; @endphp" class="nav-link"> <i class="nav-icon far fa-circle"></i> <p>{{clean( trans('niva-backend.all_posts') , array('Attr.EnableID' => true))}}</p> </a> </li>
                                <li class="nav-item"> <a href="{{ route('post.create') }}?language=@php echo $lang->code; @endphp" class="nav-link"> <i class="nav-icon far fa-circle"></i> <p>{{clean( trans('niva-backend.create_post') , array('Attr.EnableID' => true))}}</p> </a> </li>
                                <li class="nav-header">{{clean( trans('niva-backend.categories') , array('Attr.EnableID' => true))}}</li>
                                <li class="nav-item"> <a href="{{ route('category.index') }}?language=@php echo $lang->code; @endphp" class="nav-link"> <i class="nav-icon far fa-circle"></i> <p>{{clean( trans('niva-backend.all_categories') , array('Attr.EnableID' => true))}}</p> </a> </li>
                            </ul>
                        </li>

                        <!-- Media -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-images"></i>
                                <p>
                                    {{clean( trans('niva-backend.media') , array('Attr.EnableID' => true))}}
                                    <i class="nav-arrow fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"> <a href="{{ route('media.index') }}" class="nav-link"> <i class="nav-icon far fa-circle"></i> <p>{{clean( trans('niva-backend.all_media') , array('Attr.EnableID' => true))}}</p> </a> </li>
                                <li class="nav-item"> <a href="{{ route('media.create') }}" class="nav-link"> <i class="nav-icon far fa-circle"></i> <p>{{clean( trans('niva-backend.upload_image') , array('Attr.EnableID' => true))}}</p> </a> </li>
                            </ul>
                        </li>

                        @if(Auth::user()->role->name == 'administrator')
                        <!-- Users -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    {{clean( trans('niva-backend.users') , array('Attr.EnableID' => true))}}
                                    <i class="nav-arrow fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"> <a href="{{ route('users.index') }}" class="nav-link"> <i class="nav-icon far fa-circle"></i> <p>{{clean( trans('niva-backend.all_users') , array('Attr.EnableID' => true))}}</p> </a> </li>
                                <li class="nav-item"> <a href="{{ route('users.create') }}" class="nav-link"> <i class="nav-icon far fa-circle"></i> <p>{{clean( trans('niva-backend.create_user') , array('Attr.EnableID' => true))}}</p> </a> </li>
                            </ul>
                        </li>

                        <!-- Elements -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-layer-group"></i>
                                <p>
                                    Elements
                                    <i class="nav-arrow fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"> <a href="{{ route('slider.index') }}?language=@php echo $lang->code; @endphp" class="nav-link"> <i class="nav-icon far fa-circle"></i> <p>Sliders</p> </a> </li>
                                <li class="nav-item"> <a href="{{ route('service.index') }}?language=@php echo $lang->code; @endphp" class="nav-link"> <i class="nav-icon far fa-circle"></i> <p>Serviços</p> </a> </li>
                                <li class="nav-item"> <a href="{{ route('testimonial.index') }}?language=@php echo $lang->code; @endphp" class="nav-link"> <i class="nav-icon far fa-circle"></i> <p>Depoimentos</p> </a> </li>
                                <li class="nav-item"> <a href="{{ route('member.index') }}?language=@php echo $lang->code; @endphp" class="nav-link"> <i class="nav-icon far fa-circle"></i> <p>Nossa Equipe</p> </a> </li>
                                <li class="nav-item"> <a href="{{ route('client.index') }}?language=@php echo $lang->code; @endphp" class="nav-link"> <i class="nav-icon far fa-circle"></i> <p>Clientes</p> </a> </li>
                                <li class="nav-item"> <a href="{{ route('pricing.index') }}?language=@php echo $lang->code; @endphp" class="nav-link"> <i class="nav-icon far fa-circle"></i> <p>Valores</p> </a> </li>
                            </ul>
                        </li>

                        <!-- Settings -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>
                                    {{clean( trans('niva-backend.settings') , array('Attr.EnableID' => true))}}
                                    <i class="nav-arrow fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"> <a href="{{ route('setting.edit') }}?language=@php echo $lang->code; @endphp" class="nav-link"> <i class="nav-icon far fa-circle"></i> <p>{{clean( trans('niva-backend.title_log_favicon') , array('Attr.EnableID' => true))}}</p> </a> </li>
                                <li class="nav-item"> <a href="{{ route('menu.index') }}?language=@php echo $lang->code; @endphp" class="nav-link"> <i class="nav-icon far fa-circle"></i> <p>{{clean( trans('niva-backend.main_menu') , array('Attr.EnableID' => true))}}</p> </a> </li>
                                <li class="nav-item"> <a href="{{ route('headerfooter-setting.edit') }}?language=@php echo $lang->code; @endphp" class="nav-link"> <i class="nav-icon far fa-circle"></i> <p>{{clean( trans('niva-backend.header_and_footer') , array('Attr.EnableID' => true))}}</p> </a> </li>
                                <li class="nav-item"> <a href="{{ route('language.index') }}" class="nav-link"> <i class="nav-icon far fa-circle"></i> <p>{{clean( trans('niva-backend.all_languages') , array('Attr.EnableID' => true))}}</p> </a> </li>
                            </ul>
                        </li>
                        @endif

                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper -->
        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Header Content Here if needed -->
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
        <footer class="app-footer">
            <div class="float-end d-none d-sm-inline">Marcelo Brad RJ</div>
            <strong>{{clean( trans('niva-backend.copyright_text') , array('Attr.EnableID' => true))}}</strong>
        </footer>

    </div>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{clean( trans('niva-backend.ready_leave') , array('Attr.EnableID' => true))}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{clean( trans('niva-backend.logout_message') , array('Attr.EnableID' => true))}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{clean( trans('niva-backend.cancel') , array('Attr.EnableID' => true))}}</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{clean( trans('niva-backend.logout') , array('Attr.EnableID' => true))}}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
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

    <!-- Global Ajax and SweetAlert2 Setup -->
    <script>
        // Setup Ajax CSRF
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Global Summernote Initialization
        $(document).ready(function() {
            if ($('.summernote').length > 0) {
                $('.summernote').summernote({
                    height: 300,
                    tabsize: 2,
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

        // Global Notification Helper
        function showToasty(msg, type = 'success') {
            let bg = type === 'success' ? "linear-gradient(to right, #00b09b, #96c93d)" : "linear-gradient(to right, #ff5f6d, #ffc371)";
            Toastify({
                text: msg,
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                style: { background: bg }
            }).showToast();
        }
    </script>

    @yield('footer')

</body>
</html>
