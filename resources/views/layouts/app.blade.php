<!DOCTYPE html>
<html lang="es">

@section('htmlheader')
    @include('layouts.partials.htmlheader')
@show

<body class="skin-blue sidebar-mini">
    <div>
        <div class="wrapper">

        @include('layouts.partials.mainheader')

        @include('layouts.partials.sidebar')

        <div class="content-wrapper">
            @include('layouts.partials.contentheader')
            <section class="content">
                @yield('content')
            </section>
        </div>

        @include('layouts.partials.footer')

        </div>
    </div>

    @include('layouts.partials.scripts')
    @section('script')

    @show
</body>
</html>
