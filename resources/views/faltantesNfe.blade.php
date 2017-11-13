@extends('layouts/default')

{{-- Page title --}}
@section('title')
    Home
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/animate/animate.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/jquery.circliful.css') }}">

    <!--end of page level css-->
@stop

{{-- content --}}
@section('content')
    <div class="container">
        <div class="row">

                <div class="col-md-12">
                    <div class="panel panel-default" style="min-height: 500px;">
                        <div class="panel-body">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h3 class="panel-title">NDD - Nf-e - Notas Fiscais Elerônicas</h3>
                                </div>
                                <div class="panel-body">
                                    <b>Filtro Selecionado:</b> {{ 'Teste' }} <?=$loja?>
                                    <h4>Notas Faltantes</h4>
                                    <hr/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        </div>

    </div>


@stop
{{-- footer scripts --}}
@section('footer_scripts')
    <!-- page level js starts-->
    <script type="text/javascript" src="{{ asset('assets/js/frontend/jquery.circliful.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/wow/js/wow.min.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/owl_carousel/js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/carousel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/index.js') }}"></script>
    <!--page level js ends-->
@stop