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
                        <!-- Inicio dos Painéis -->
                        <!-- nf-e inicio -->

                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title">NDD - Nf-e - Notas Fiscais Elerônicas</h3>
                            </div>
                            <div class="panel-body">
                                Procurar Notas para Inutilizar
                                <form action="faltantesNfe" class="form-inline">

                                    <div class="form-group">
                                        <label for="loja">Loja</label>
                                        <select class="form-control" id="loja" name="loja">
                                            <option value="1">1 - Magazine </option>
                                            <option value="3">3 - Riverside </option>
                                            <option value="5">5 - Rio Branco </option>
                                            <option value="6">6 - Valter Alencar </option>
                                            <option value="8">8 - Calçados </option>
                                            <option value="9">9 - Frei Serafim </option>
                                            <option value="10">10 - CD2 </option>
                                            <option value="11">11 - Shopping </option>
                                            <option value="12">12 - Rio Poty </option>
                                        </select>
                                        <div class="form-group">
                                            <label for="DI">Data Inicial</label>
                                            <input type="date" class="form-control" id="DI" name="datainicial" placeholder="Data Inicial">
                                        </div>
                                        <div class="form-group">
                                            <label for="DF">Data Final</label>
                                            <input type="date" class="form-control" id="DF" name="datafinal" placeholder="Data Final">
                                        </div>

                                    </div>
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-warning">Analisar</button>

                                </form>
                            </div>
                        </div>

                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title">Saci - Nf-e - Notas Fiscais Inutilizadas</h3>
                            </div>
                            <div class="panel-body">
                                Procurar Notas Faltantes no Editor de Numeração do Saci
                                <form action="inutilsaci" method="post" class="form-inline">
                                    <div class="form-group">
                                        <label for="loja">Loja</label>
                                        <select class="form-control" id="loja" name="loja">
                                            <option value="1">1 - Magazine </option>
                                            <option value="3">3 - Riverside </option>
                                            <option value="5">5 - Rio Branco </option>
                                            <option value="6">6 - Valter Alencar </option>
                                            <option value="8">8 - Calçados </option>
                                            <option value="9">9 - Frei Serafim </option>
                                            <option value="10">10 - CD2 </option>
                                            <option value="11">11 - Shopping </option>
                                            <option value="12">12 - Rio Poty </option>
                                        </select>
                                        <div class="form-group">
                                            <label for="DI">Data Inicial</label>
                                            <input type="date" class="form-control" id="DI" name="DI" placeholder="Data Inicial">
                                        </div>
                                        <div class="form-group">
                                            <label for="DF">Data Final</label>
                                            <input type="date" class="form-control" id="DF" name="DF" placeholder="Data Final">
                                        </div>

                                    </div>
                                    <button type="submit" class="btn btn-warning">Analisar</button>

                                </form>
                            </div>
                        </div>

                        <!-- nf-e fim -->
                        <!-- Inicio dos Painéis -->

                        <!-- NFC-e-->
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">NDD - NFC-e - Cupons Fiscais Faltantes</h3>
                            </div>
                            <div class="panel-body">
                                Procurar Cupons para Inutilizar
                                <form action="fantantesnfce" method="post" class="form-inline">
                                    <div class="form-group">
                                        <label for="loja">Loja</label>
                                        <select class="form-control" id="loja" name="loja">
                                            <option value="1">1 - Magazine </option>
                                            <option value="3">3 - Riverside </option>
                                            <option value="5">5 - Rio Branco </option>
                                            <option value="6">6 - Valter Alencar </option>
                                            <option value="8">8 - Calçados </option>
                                            <option value="9">9 - Frei Serafim </option>
                                            <option value="10">10 - CD2 </option>
                                            <option value="11">11 - Shopping </option>
                                            <option value="12">12 - Rio Poty </option>
                                        </select>
                                        <div class="form-group">
                                            <label for="DI">Data Inicial</label>
                                            <input type="date" class="form-control" id="DI" name="DI" placeholder="Data Inicial">
                                        </div>
                                        <div class="form-group">
                                            <label for="DF">Data Final</label>
                                            <input type="date" class="form-control" id="DF" name="DF" placeholder="Data Final">
                                        </div>

                                    </div>
                                    <button type="submit" class="btn btn-warning">Analisar</button>

                                </form>
                            </div>
                        </div>

                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Saci - NFC-e - Cupons Fiscais Inutilizadas</h3>
                            </div>
                            <div class="panel-body">
                                Procurar Cupons Faltantes no Editor de Numeração do Saci
                                <form action="inutilnfce" method="post" class="form-inline">
                                    <div class="form-group">
                                        <label for="loja">Loja</label>
                                        <select class="form-control" id="loja" name="loja">
                                            <option value="1">1 - Magazine </option>
                                            <option value="3">3 - Riverside </option>
                                            <option value="5">5 - Rio Branco </option>
                                            <option value="6">6 - Valter Alencar </option>
                                            <option value="8">8 - Calçados </option>
                                            <option value="9">9 - Frei Serafim </option>
                                            <option value="10">10 - CD2 </option>
                                            <option value="11">11 - Shopping </option>
                                            <option value="12">12 - Rio Poty </option>
                                        </select>
                                        <div class="form-group">
                                            <label for="DI">Data Inicial</label>
                                            <input type="date" class="form-control" id="DI" name="DI" placeholder="Data Inicial">
                                        </div>
                                        <div class="form-group">
                                            <label for="DF">Data Final</label>
                                            <input type="date" class="form-control" id="DF" name="DF" placeholder="Data Final">
                                        </div>

                                    </div>
                                    <button type="submit" class="btn btn-warning">Analisar</button>

                                </form>
                            </div>
                        </div>

                        <!-- NFC-e-->

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
