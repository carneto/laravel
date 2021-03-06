<!DOCTYPE html>
<html lang="en">

@section('htmlheader')
    @include('layouts.partials.htmlheader')
@show

<body class="skin-blue sidebar-mini sidebar-collapse">
<div class="wrapper">

    @include('layouts.partials.mainheader')



    <div class="content-wrapper">


        <section class="content">

            @yield('main-content')
        </section>
    </div>


    @include('layouts.partials.footer')

</div>

@section('scripts')
    @include('layouts.partials.scripts')
@show

</body>
</html>
