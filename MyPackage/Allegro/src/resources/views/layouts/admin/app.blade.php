<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

@section('head')
    @include('allegro::layouts.admin.head')
@show

<body class="nav-md">
    <div class="container body">
      <div class="main_container">
        @include('allegro::layouts.admin.sidebar')

        <!-- Content Wrapper. Contains page content -->
            @include('allegro::layouts.admin.right_top_header')
            <!-- Main content -->
            <section class="content">
                <!-- Your Page Content Here -->
                @yield('content')
                
            </section><!-- /.content -->
        @include('allegro::layouts.admin.footer')
        </div>
    </div>
</body>
</html>