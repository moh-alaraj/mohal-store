<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    @stack('css')

</head>


<body>
<header class="py-2 bg-dark text-white mb-4">
            <div class="container">
                <div class="d-flex">
                    <h1 class="h3">Mohal Store</h1>
                        @auth
                            <div class="ms-auto">

                                 {{\Illuminate\Support\Facades\Auth::user()->name}}
                                <a href="#" onclick="document.getElementById('logout').submit()">Logout</a>
                                <form id="logout" class="d-none" action="{{route('logout')}}" method="post">
                                    @csrf
                                </form>
                            </div>
                        @endauth
                </div>
            </div>
</header>
<div class="container">
    <div class="row">
        <aside class="col-md-3">
            <h4 style="color: dodgerblue">Navigation Menu</h4>
            <nav>
                <ul class="nav nav-pills flex-column " >

                    <li class="nav-item"><a href="" class="nav-link ">Dashboard</a></li>
                    <li class="nav-item"><a href="{{route('admin.categories.index')}}" class="nav-link @if(request()->routeIs('admin.categories.index')) active @endif">Categories</a></li>
                    <li class="nav-item"><a href="{{route('admin.products.index')}}" class="nav-link @if(request()->routeIs('admin.products.index')) active @endif ">Products</a></li>
                    <li class="nav-item"><a href="{{route('admin.roles.index')}}" class="nav-link @if(request()->routeIs('admin.roles.index')) active @endif ">Roles</a></li>
                    <li class="nav-item"><a href="{{route('admin.advertise.index')}}" class="nav-link @if(request()->routeIs('admin.advertise.index')) active @endif ">Advertisings</a></li>


                </ul>
            </nav>
        </aside>
        <main class="col-md-9">
            <div class="mb-4">
                <h3 class="text-primary">@yield('title', 'Default Title')</h3>
            </div>
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif

            @yield('content')

        </main>
    </div>
</div>

<script src="{{asset('js/bootstrap.bundle.js')}}"></script>
@stack('js')

</body>

</html>
