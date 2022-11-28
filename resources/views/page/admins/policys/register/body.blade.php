<section>
    <h1 class="page-header">Politicas Comerciales</h1>
    <form name="handlerWizard" id="handlerWizard">
        <div id="wizard">
            <ul>
                <li>
                    <a href="#step-1">
                        <span class="number">1</span> 
                        <span class="info">
                            Informaci&oacute;n de Promoci&oacute;n
                            <small>Nombre y Costo</small>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#step-2">
                        <span class="number">2</span> 
                        <span class="info">
                            Recurrencia de Promoci&oacute;n
                            <small>Meses que durar&aacute; la promoci&oacute;n</small>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#step-3">
                        <span class="number">3</span>
                        <span class="info">
                            Informaci&oacute;n de Activaci&oacute;n
                            <small>Recurrencia y costos</small>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#step-4">
                        <span class="number">4</span> 
                        <span class="info">
                            Finalizaci&oacute;n
                            <small>Creaci&oacute;n de Promoci&oacute;n</small>
                        </span>
                    </a>
                </li>
            </ul>

            <div>
                
            <div id="step-1">
                <fieldset>
                    <div class="row">
                        <div class="col-xl-8 offset-xl-2">
                            <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Informaci&oacute;n de la Promoci&oacute;n</legend>
                            
                            <div class="form-group row m-b-10">
                                <div class="col-lg-9 col-xl-6">
                                    <div class="form-group">
                                        <label for="text-lg-right col-form-label"><strong>T&iacute;tulo</strong></label>
                                        <input type="text" id="tPromo" name="tPromo" data-parsley-group="step-1" data-parsley-required="true" placeholder="Primer Trimestre del A&ntilde;o" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-lg-9 col-xl-6">
                                    <div class="form-group">
                                        <label for="text-lg-right col-form-label"><strong>Subtitulo</strong><small>&nbsp;(Mostrado en factura)</small></label>
                                        <input type="text" id="sbPromo" name="sbPromo" data-parsley-group="step-1" data-parsley-required="true" placeholder="Titulo Mostrado en Factura" class="form-control" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row m-b-10">
                                <div class="col-lg-9 col-xl-6">
                                    <label for="text-lg-right col-form-label"><strong>Costo del Paquete</strong></label>
                                    <div class="input-group input-daterange">
                                        <input type="text" id="cPromo" name="cPromo" data-parsley-group="step-1" data-parsley-required="true" placeholder="19.99" class="form-control autonumber" />
                                        <span class="input-group-addon">IVA</span>
                                        <input type="text" id="cIvaPromo" name="cIvaPromo" data-parsley-group="step-1" data-parsley-required="true" value="16" placeholder="% 16" class="form-control autonumber" />
                                    </div>
                                </div>

                                <div class="col-lg-9 col-xl-6">
                                    <label for="text-lg-right col-form-label"><strong>Costo de la Instalaci&oacute;n</strong></label>
                                    <div class="input-group input-daterange">
                                        <input type="text" id="iPromo" name="iPromo" data-parsley-group="step-1" data-parsley-required="true" placeholder="199.99" class="form-control autonumber" />
                                        <span class="input-group-addon">IVA</span>
                                        <input type="text" id="iIvaPromo" name="iIvaPromo" data-parsley-group="step-1" data-parsley-required="true" value="16" placeholder="% 16" class="form-control autonumber" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row m-b-10">
                                <div class="col-lg-9 col-xl-3">
                                    <div class="form-group">
                                        <label for="text-lg-right col-form-label"><strong>Estado</strong></label>
                                        <select class="form-control" id="esPromo" name="esPromo" data-parsley-group="step-1" data-parsley-required="true">
                                            @foreach ($estates as $es)
                                                @if ($es->status_id == 1)
                                                    <option value="{{ $es->id }}">{{ $es->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-xl-3">
                                    <div class="form-group">
                                        <label for="text-lg-right col-form-label"><strong>Ciudad</strong></label>
                                        <select class="form-control" id="ciPromo" name="ciPromo" data-parsley-group="step-1" data-parsley-required="true">
                                            @foreach ($estates as $es)
                                                @foreach ($es->citys as $city)
                                                    @if ($city->status_id == 1)
                                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                    @endif        
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-xl-3">
                                    <div class="form-group">
                                        <label for="text-lg-right col-form-label"><strong>Tipo</strong></label>
                                        <select class="form-control" id="tyPromo" name="tyPromo" data-parsley-group="step-1" data-parsley-required="true">
                                            @foreach ($type as $ty)
                                                @if ($ty->status_id == 1)
                                                    <option value="{{ $ty->id }}">{{ $ty->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-xl-3">
                                    <div class="form-group">
                                        <label for="text-lg-right col-form-label"><strong>Tecnolog&iacute;a</strong></label>
                                        <select class="form-control" id="tePromo" name="tePromo" data-parsley-group="step-1" data-parsley-required="true">
                                            @foreach ($technology as $tec)
                                                @if ($tec->status_id == 1)
                                                    <option value="{{ $tec->id }}">{{ $tec->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row m-b-10">
                                <div class="col-lg-12 col-xl-12">
                                    <label for="text-lg-right col-form-label"><strong>Fechas de Promoci&oacute;n</strong></label>
                                    <div class="input-group input-daterange">
                                        <input type="text" id="dIniPromo" name="dIniPromo" data-parsley-group="step-1" data-parsley-required="true" data-date-format="yyyy-mm-dd" placeholder="Fecha de Inicio" class="form-control" />
                                        <span class="input-group-addon">to</span>
                                        <input type="text" id="dEndPromo" name="dEndPromo" data-parsley-group="step-1" data-parsley-required="true" data-date-format="yyyy-mm-dd" placeholder="Fecha Finalizaci&oacute;n" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>

            <div id="step-2">
                <fieldset>
                    <div class="row">
                        <div class="col-xl-8 offset-xl-2">
                            
                            <div class="form-group row m-b-10">
                                <div class="col-md-6" style="text-align: center;">
                                    <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Listado de Meses por Promoci&oacute;n</legend>
                                </div>
                                <div class="col-md-6" style="text-align: right;">
                                    <a href="javascript:;" onclick="AddRecurrenceItems();" class="btn btn-sm btn-primary">Agregar</a>                                            
                                </div>
                            </div>
                            <div class="form-group row m-b-10">

                                <div class="table-responsive">
                                    <table id="rPromotion" class="table table-striped table-bordered table-hover m-b-0">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th>Mes</th>
                                                <th>Costo</th>
                                                <th>Multiplicador</th>
                                                <th>IVA</th>
                                                <th>Total</th>
                                                <th>Acci&oacute;n</th>
                                            </tr>
                                        </thead>
                                        <tbody style="text-align: center;">
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>
                    </div>
                </fieldset>
            </div>

            <div id="step-3">
                <fieldset>
                    <div class="row">
                        <div class="col-xl-8 offset-xl-2">
                            
                            <div class="form-group row m-b-10">
                                <div class="col-md-6" style="text-align: center;">
                                    <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Listado de Meses por instalaci&oacute;n</legend>
                                </div>
                                <div class="col-md-6" style="text-align: right;">
                                    <a href="javascript:;" onclick="AddInstalationItems();" class="btn btn-sm btn-primary">Agregar</a>                                            
                                </div>
                            </div>
                            <div class="form-group row m-b-10">

                                <div class="table-responsive">
                                    <table id="rInstalations" class="table table-striped table-bordered table-hover m-b-0">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th>Mes</th>
                                                <th>Costo</th>
                                                <th>Multiplicador</th>
                                                <th>IVA</th>
                                                <th>Total</th>
                                                <th>Acci&oacute;n</th>
                                            </tr>
                                        </thead>
                                        <tbody style="text-align: center;">
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>
                    </div>
                </fieldset>
            </div>
    </form>
            <div id="step-4">
                <div id="wizard-submit">
                    <form name="form-wizard" id="form-wizard" class="form-control-with-bg">
                        <div class="jumbotron m-b-0 text-center">
                            <h5 class="display-4">Desea crear la promoci&oacute;n? </h5>
                            <p><button type="submit"class="btn btn-primary btn-lg">Procesar</button></p>
                        </div>
                    </form>
                </div>
                <div id="wizard-success" hidden>
                    <div class="jumbotron m-b-0 text-center">
                        <h2 class="display-4">Registro Satisfactorio</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>