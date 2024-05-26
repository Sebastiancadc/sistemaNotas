<!DOCTYPE html>
<html>

<head>
    <title>Mis tareas</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>

<body>
    <!-- DEFAULT NAVBAR -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="/dashboard">Mis Tareas</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-haspopup="true" aria-expanded="false">Menu <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            @if (auth()->user()->hasRole('admin'))
                                <li><a href="{{ route('rol.index') }}">Roles</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ route('users.index') }}">Usuarios</a></li>
                                <li role="separator" class="divider"></li>
                            @endif
                            <li><a href="{{ route('tasks.index') }}">Mis tareas</a></li>
                        </ul>

                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-haspopup="true" aria-expanded="false">Mi perfil<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#">{{ auth()->user()->name }}</a>
                                <a href="#">(Rol - {{ auth()->user()->getRoleNames()->first() }})</a>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ route('signout') }}">Cerrar sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <script src="http://code.jquery.com/jquery-2.1.4.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>
