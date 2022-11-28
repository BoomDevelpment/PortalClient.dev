@extends('layouts.admin')

@section('title', 'Boom Solutions')

@section('content')

<div id="content" class="content">

    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Politicas</a></li>
    </ol>

    @include('page.admins.policys.body')
    
    @include('page.admins.policys.modal')
</div>

@endsection

@section('js')

<script type="text/javascript">

/****************************************************************************************************/

$(document).ready(function() {
    TableManageDefault.init();
});

/****************************************************************************************************/

var handleDataTableDefault = function() {
	"use strict";
    
	if ($('#data-table-default').length !== 0) {
		$('#data-table-default').DataTable({
			responsive: true
		});
	}
};

/****************************************************************************************************/

var TableManageDefault = function () {
	"use strict";
	return {
		//main function
		init: function () {
			handleDataTableDefault();
		}
	};
}();

/****************************************************************************************************/

$('#rInstalations').on('input', ':input', function() { 
    var id = $(this).prop('name').slice(3);

    if($(this).prop('name').slice(0,3) == "IMU")
    {
        $('#ITO'+id+'').val('');
        $('#ITO'+id+'').val( ( ( (parseFloat($(this).val())/100) * parseFloat($('#ICO'+id+'').val()) ) + ( (parseFloat($('#IIVA'+id+'').val())/100) * ( (parseFloat($(this).val())/100) * parseFloat($('#ICO'+id+'').val())) ) ).toFixed(2) );

    }else if ($(this).prop('name').slice(0,3) == "IIV"){

        var id = $(this).prop('name').slice(4);

        $('#ITO'+id+'').val('');
        $('#ITO'+id+'').val( ( ( (parseFloat($('#IMU'+id+'').val())/100) * parseFloat($('#ICO'+id+'').val())) + ( (parseFloat($(this).val())/100) * (parseFloat($('#IMU'+id+'').val())/100) * parseFloat($('#ICO'+id+'').val())) ).toFixed(2) );

    }else if ($(this).prop('name').slice(0,3) == "ITO") {

        $('#IMU'+id+'').val('');
        $('#IMU'+id+'').val( (( parseFloat($(this).val()) / (( parseFloat($('#ICO'+id+'').val())  * (parseFloat($('#IIVA'+id+'').val())/100)) + parseFloat($('#ICO'+id+'').val())) ) * 100).toFixed(2) );
    }
});

$('#rPromotion').on('input', ':input', function() { 
    var id = $(this).prop('name').slice(3);

    if($(this).prop('name').slice(0,3) == "RMU")
    {
        $('#RTO'+id+'').val('');
        $('#RTO'+id+'').val( ( ( (parseFloat($(this).val())/100) * parseFloat($('#RCO'+id+'').val()) ) + ( (parseFloat($('#RIVA'+id+'').val())/100) * ( (parseFloat($(this).val())/100) * parseFloat($('#RCO'+id+'').val())) ) ).toFixed(2) );

    }else if ($(this).prop('name').slice(0,3) == "RIV"){

        var id = $(this).prop('name').slice(4);

        $('#RTO'+id+'').val('');
        $('#RTO'+id+'').val( ( ( (parseFloat($('#RMU'+id+'').val())/100) * parseFloat($('#RCO'+id+'').val())) + ( (parseFloat($(this).val())/100) * (parseFloat($('#RMU'+id+'').val())/100) * parseFloat($('#RCO'+id+'').val())) ).toFixed(2) );

    }else if ($(this).prop('name').slice(0,3) == "RTO") {

        $('#RMU'+id+'').val('');
        $('#RMU'+id+'').val( (( parseFloat($(this).val()) / (( parseFloat($('#RCO'+id+'').val())  * (parseFloat($('#RIVA'+id+'').val())/100)) + parseFloat($('#RCO'+id+'').val())) ) * 100).toFixed(2) );
    }
});

/****************************************************************************************************/

function AddRecurrenceItems()
{
    var cost = document.getElementById("cPromo").value;
    var ivaC = document.getElementById("cIvaPromo").value; 
    var i = 1;
    while($('#RMO'+i+'').length == 1){ i++; }

    $('#rPromotion').append('<table>');
    $('#rPromotion').append('<tr id="RMID'+i+'"><td><input type="text" id="RMO'+i+'" name="RMO'+i+'" readonly value="'+i+'" data-parsley-group="step-2" data-parsley-required="true" placeholder="'+i+'" class="form-control text-center autonumber"></td><td><input type="text" id="RCO'+i+'" name="RCO'+i+'" readonly value="'+cost+'" data-parsley-group="step-2" data-parsley-required="true" placeholder="'+cost+'" class="form-control text-center autonumber"></td><td><input type="text" id="RMU'+i+'" name="RMU'+i+'" data-parsley-group="step-2" data-parsley-required="true" value="100" placeholder="100" class="form-control text-center autonumber"></td><td><input type="text" id="RIVA'+i+'" name="RIVA'+i+'" data-parsley-group="step-2" data-parsley-required="true" value="'+ivaC+'" placeholder="'+ivaC+'" class="form-control text-center autonumber"></td><td><input type="text" id="RTO'+i+'" name="RTO'+i+'" value="'+( ((100/100) * cost) + ( (ivaC/100) * cost)  ).toFixed(2)+'" data-parsley-group="step-2" data-parsley-required="true" placeholder="'+cost+'" class="form-control text-center autonumber"></td><td><a href="#" onclick=RemoveItems('+i+') class="btn btn-sm btn-danger btn-block text-center">Remover</a></td></tr>');
    $('#rPromotion').append('</table>');
}

function AddInstalationItems()
{
    var inst  = document.getElementById("iPromo").value;
    var ivaI  = document.getElementById("iIvaPromo").value;
    var i = 1;
    while($('#IAO'+i+'').length == 1){ i++; }

    $('#rInstalations').append('<table>');
    $('#rInstalations').append('<tr id="IAID'+i+'"><td><input type="text" id="IAO'+i+'" name="IAO'+i+'" readonly value="'+i+'" data-parsley-group="step-3" data-parsley-required="true" placeholder="'+i+'" class="form-control text-center autonumber"></td><td><input type="text" id="ICO'+i+'" name="ICO'+i+'" readonly value="'+inst+'" data-parsley-group="step-3" data-parsley-required="true" placeholder="'+inst+'" class="form-control text-center autonumber"></td><td><input type="text" id="IMU'+i+'" name="IMU'+i+'" data-parsley-group="step-3" data-parsley-required="true" value="100" placeholder="100" class="form-control text-center autonumber"></td><td><input type="text" id="IIVA'+i+'" name="IIVA'+i+'" data-parsley-group="step-2" data-parsley-required="true" value="'+ivaI+'" placeholder="'+ivaI+'" class="form-control text-center autonumber"></td><td><input type="text" id="ITO'+i+'" name="ITO'+i+'" value="'+( ((100/100) * inst) + ( (ivaI/100) * inst)  ).toFixed(2)+'" data-parsley-group="step-3" data-parsley-required="true" placeholder=""'+inst+'"" class="form-control text-center autonumber"></td><td><a href="#" onclick=RemoveItemsInst('+i+') class="btn btn-sm btn-danger btn-block text-center">Remover</a></td></tr>');
    $('#rInstalations').append('</table>');
}

function RemoveItems(id)
{
    if(id == 1)
    {
        window.alert("El primer mes de promocion no puede ser eliminado");
    }else{
        $('#RMID'+id+'').remove();
    }
}

function RemoveItemsInst(id)
{
    if(id == 1)
    {
        window.alert("El primer mes de promocion de Instalacion no puede ser eliminado");
    }else{
        $('#IAID'+id+'').remove();
    }
}

function blockUI()
{
    $.blockUI({ css: {
    border: 'none',
    padding: '15px',
    backgroundColor: '#000',
        '-webkit-border-radius': '10px',
        '-moz-border-radius': '10px',
    opacity: .5,
    color: '#fff'
}});

}

/****************************************************************************************************/

$('#form-wizard').submit(function(){
    blockUI();

    var request = $.ajax({
        url:    '{{url('/admins/policy/register')}}',
        type:   'POST',
        data:   $('#handlerWizard').serialize(), 
        headers:{
            'X-CSRF-TOKEN': 	$('meta[name="csrf-token"]').attr('content'),
            'Content-Type': 	'application/x-www-form-urlencoded'
        }
    });
    request.done(function(data){
        $.unblockUI();
        swal({
            title: 'Success!',text: data.message,icon: 'success',
            buttons: {confirm: { text: 'Success',value: true,visible: true,className: 'btn btn-success',closeModal: true}}
        });

        setTimeout( function() { window.location = data.url; }, 3000); 
    })
    request.fail(function(response)
    {
        $.unblockUI();   
        swal({
            title: 'Error!',text: JSON.parse(response.responseText).message ,icon: 'error',
            buttons: {confirm: { text: 'Error',value: true,visible: true,className: 'btn btn-error',closeModal: true}}
        });
        swal("Error!", JSON.parse(response.responseText).message);
    });

    return false;
});

/****************************************************************************************************/

</script>


@endsection