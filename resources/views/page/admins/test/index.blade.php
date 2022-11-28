@extends('layouts.admin')

@section('title', 'Boom Solutions')

@section('content')

<div id="content" class="content">

    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Promociones</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Promociones</h1>
    <!-- end page-header -->
    <!-- begin wizard-form -->
    <form action="/" method="POST" class="form-control-with-bg">
        <!-- begin wizard -->
        <div id="wizard">
            <!-- begin wizard-step -->
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
                    <a href="#step-2" onclick="Prueba();">
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
            <!-- end wizard-step -->
            <!-- begin wizard-content -->
            <div>
                <!-- begin step-1 -->
                <div id="step-1">
                    <!-- begin fieldset -->
                    <fieldset>
                        <div class="row">
                            <div class="col-xl-8 offset-xl-2">
                                <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Informaci&oacute;n de la Promoci&oacute;n</legend>
                                <div class="form-group row m-b-10">
                                    <label class="col-lg-3 text-lg-right col-form-label">Nombre</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <input type="text" name="nPromo" name="nPromo" placeholder="Primer Trimestre del A&ntilde;o" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group row m-b-10">
                                    <label class="col-lg-3 text-lg-right col-form-label">Costo</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <input type="number" id="cPromo" name="cPromo" placeholder="19.99" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </fieldset>
                    <!-- end fieldset -->
                </div>
                <!-- end step-1 -->
                <!-- begin step-2 -->
                <div id="step-2">
                    <!-- begin fieldset -->
                    <fieldset>
                        <!-- begin row -->
                        <div class="row">
                            <!-- begin col-8 -->
                            <div class="col-xl-8 offset-xl-2">
                                <div class="form-group row m-b-10">
                                    <div class="col-md-6" style="text-align: center;">
                                        <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Ingrese los meses de promoci&oacute;n</legend>
                                    </div>
                                    <div class="col-md-6" style="text-align: right;">
                                        <a href="javascript:;" onclick="AddRecurrenceItems();" class="btn btn-sm btn-primary">Agregar</a>                                            
                                    </div>
                                </div>
                                <!-- begin form-group row -->
                                <div class="form-group row m-b-10">

                                    <div class="table-responsive">
                                        <table id="rPromotion" class="table table-striped m-b-0">
                                            <thead>
                                                <tr style="text-align: center;">
                                                    <th>Mes</th>
                                                    <th>Costo</th>
                                                    <th>Multiplicador</th>
                                                    <th>Total</th>
                                                    <th>Acci&oacute;n</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: center;">
                                                <tr>
                                                    <td style="text-align: center;"></td>
                                                    <td style="text-align: center;">
                                                        <input type="number" placeholder="100" value="" style="text-align: center;">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input type="number" placeholder="100" value="100" style="text-align: center;">
                                                        <input type="text" id="itemID" name="itemID" style="text-align: center;" value="'+numb+'">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <div id="ItemCost" name="ItemCost">'+cost+'</div>
                                                    </td>
                                                    <td class="with-btn" style="text-align: center;">
                                                        <a href="#" class="btn btn-sm btn-danger">remove</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                            <!-- end col-8 -->
                        </div>
                        <!-- end row -->
                    </fieldset>
                    <!-- end fieldset -->
                </div>
                <!-- end step-2 -->
                <!-- begin step-3 -->
                <div id="step-3">
                    <!-- begin fieldset -->
                    <fieldset>
                        <!-- begin row -->
                        <div class="row">
                            <!-- begin col-8 -->
                            <div class="col-xl-8 offset-xl-2">
                                <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Select your login username and password</legend>
                                <!-- begin form-group row -->
                                <div class="form-group row m-b-10">
                                    <label class="col-lg-3 text-lg-right col-form-label">Username</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <input type="text" name="username" placeholder="johnsmithy" class="form-control" />
                                    </div>
                                </div>
                                <!-- end form-group row -->
                                <!-- begin form-group row -->
                                <div class="form-group row m-b-10">
                                    <label class="col-lg-3 text-lg-right col-form-label">Pasword</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <input type="password" name="password" placeholder="Your password" class="form-control" />
                                    </div>
                                </div>
                                <!-- end form-group row -->
                                <!-- begin form-group row -->
                                <div class="form-group row m-b-10">
                                    <label class="col-lg-3 text-lg-right col-form-label">Confirm Pasword</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <input type="password" name="password2" placeholder="Confirmed password" class="form-control" />
                                    </div>
                                </div>
                                <!-- end form-group row -->
                            </div>
                            <!-- end col-8 -->
                        </div>
                        <!-- end row -->
                    </fieldset>
                    <!-- end fieldset -->
                </div>
                <!-- end step-3 -->
                <!-- begin step-4 -->
                <div id="step-4">
                    <div class="jumbotron m-b-0 text-center">
                        <h2 class="display-4">Register Successfully</h2>
                        <p class="lead mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consequat commodo porttitor. <br />Vivamus eleifend, arcu in tincidunt semper, lorem odio molestie lacus, sed malesuada est lacus ac ligula. Aliquam bibendum felis id purus ullamcorper, quis luctus leo sollicitudin. </p>
                        <p><a href="javascript:;" class="btn btn-primary btn-lg">Proceed to User Profile</a></p>
                    </div>
                </div>
                <!-- end step-4 -->
            </div>
            <!-- end wizard-content -->
        </div>
        <!-- end wizard -->
    </form>
</div>

@endsection

@section('js')

<script type="text/javascript">

var handleBootstrapWizardsValidation = function() {
	"use strict";
	$('#wizard').smartWizard({ 
		selected: 0, 
		theme: 'default',
		transitionEffect:'',
		transitionSpeed: 0,
		useURLhash: false,
		showStepURLhash: false,
		toolbarSettings: {
			toolbarPosition: 'bottom'
		}
	});
	$('#wizard').on('leaveStep', function(e, anchorObject, stepNumber, stepDirection) {
		var res = $('form[name="form-wizard"]').parsley().validate('step-' + (stepNumber + 1));
		window.alert(stepNumber);
		return res;
	});
	
	$('#wizard').keypress(function( event ) {
		if (event.which == 13 ) {
			$('#wizard').smartWizard('next');
		}
	});
};

var FormWizardValidation = function () {
	"use strict";
	return {
		//main function
		init: function () {
			handleBootstrapWizardsValidation();
		}
	};
}();

$(document).ready(function() {
	FormWizardValidation.init();
});

function AddRecurrenceItems()
{
    var numb = 0;
    cost    =   $('#cPromo').val();
    numb    =   $('#itemID').val()+1;
    console.log(numb);
    console.log($('#itemID').val());

    $('#rPromotion').append('<table>');    
    $('#rPromotion').append('<tr><td style="text-align: center;"></td><td style="text-align: center;">'+cost+'</td><td style="text-align: center;"><input type="number" placeholder="100" value="100" style="text-align: center;"><input type="text" id="itemID" name="itemID" style="text-align: center;" value="'+numb+'"></td><td style="text-align: center;"><div id="ItemCost" name="ItemCost">'+cost+'</div></td><td class="with-btn" style="text-align: center;"><a href="#" class="btn btn-sm btn-danger">remove</a></td></tr>');
    $('#rPromotion').append('</table>');
}

function Prueba()
{
    window.alert("Funciono");
}
</script>


@endsection