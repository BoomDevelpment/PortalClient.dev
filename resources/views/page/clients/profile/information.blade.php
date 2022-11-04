<div class="card">
    <div class="card-header"></div>
    <div class="card-block">
        <div class="row">
            <div class="col-lg-12">
                <div class="general-info">
                    <div id="err-INFO"></div>
                    <div class="row m-t-10">
                        <div class="col-lg-5">
                            <div class="table-responsive">
                                <div class="card bg-c-yellow text-white" style="text-align: center;">
                                    <div class="card-block">
                                        <div class="row m-l-0">
                                            <h6 class="m-b-10 text-white" >Plan Contratado</h6>
                                        </div>
                                        <h5 class="m-b-0">Internet Fibra Hasta 5Mb / 5 Mb</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card text-center text-white bg-c-green">
                                        <div class="card-block">
                                            <h6 class="m-b-0">Total Descarga</h6>
                                            <h4 class="m-t-10 m-b-10"><i class="feather icon-arrow-down m-r-15"></i>60.1 GB</h4>
                                            <p class="m-b-0">Resumen Mensual</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card text-center text-white bg-c-lite-green">
                                        <div class="card-block">
                                            <h6 class="m-b-0">Total Subida</h6>
                                            <h4 class="m-t-10 m-b-10"><i class="feather icon-arrow-up m-r-15"></i>7.8 GB</h4>
                                            <p class="m-b-0">Resumen Mensual</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <form method="post" class="md-float-material form-material" id="handleINFO" name="handleINFO" action="{{url('profile/update')}}" >
                                <div class="row">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icofont icofont-user"></i></span>
                                        <input type="text" class="form-control" id="iName" name="iName" placeholder="Nombre Completo" value="{{ $data['name'] }}"> 
                                        <input type="text" name="iId" id="iId" value="{{ $data['id'] }}" class="form-control" hidden>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icofont icofont-user"></i></span>
                                        <input type="text" class="form-control" id="iBirthday" name="iBirthday" placeholder="Fecha de Nacimiento" value="{{ $data['birthday'] }}"> 
                                    </div>
                                    <div class="input-group">
                                        <div class="form-radio">
                                            <div class="group-add-on">
                                                <div class="radio radiofill radio-inline">
                                                    <label>
                                                        <input type="radio" id="iGender" name="iGender" value="1" <?php if ($data['gender_id'] == "1") echo "checked"; ?>><i class="helper"></i> Male
                                                    </label>
                                                </div>
                                                <div class="radio radiofill radio-inline">
                                                    <label>
                                                        <input type="radio" id="iGender" name="iGender" value="2" <?php if ($data['gender_id'] == "2") echo "checked"; ?>><i class="helper"></i> Female
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icofont icofont-location-pin"></i></span>
                                        <input type="text" class="form-control" id="iAddress" name="iAddress" placeholder="Direcci&oacute;n Principal" value="{{ $data['address'] }}">
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icofont icofont-location-pin"></i></span>
                                        <input type="text" class="form-control" id="iLatitud" name="iLatitud" placeholder="Latitud" value="{{ $data['latitude'] }}">
                                        <span class="input-group-addon"><i class="icofont icofont-location-pin"></i></span>
                                        <input type="text" class="form-control" id="iLongitud" name="iLongitud" placeholder="Longitud" value="{{ $data['longitude'] }}">
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icofont icofont-mobile-phone"></i></span>
                                        <input type="number" class="form-control" id="iPhone" name="iPhone" placeholder="Tel&eacute;fono Fijo" value="{{ $data['phone_principal'] }}">
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icofont icofont-mobile-phone"></i></span>
                                        <input type="number" class="form-control" id="iPhoneAlt" name="iPhoneAlt" placeholder="Tel&eacute;fono Alterno" value="{{ $data['phone_alternative'] }}">
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icofont icofont-email"></i></span>
                                        <input type="email" class="form-control" id="iEmail" name="iEmail" placeholder="Email Principal" value="{{ $data['email_principal'] }}">
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icofont icofont-email"></i></span>
                                        <input type="text" class="form-control" id="iEmailAlt" name="iEmailAlt" placeholder="Email Secundario" value="{{ $data['email_alternative'] }}">
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icofont icofont-social-instagram"></i></span>
                                        <input type="text" class="form-control" id="iInstagram" name="iInstagram" placeholder="Instagram" value="{{ $data['instagram'] }}">
                                        <span class="input-group-addon"><i class="icofont icofont-social-facebook"></i></span>
                                        <input type="text" class="form-control" id="iFacebook" name="iFacebook" placeholder="Facebook" value="{{ $data['facebook'] }}">
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icofont icofont-social-twitter"></i></span>
                                        <input type="text" class="form-control" id=""iTwitter name="iTwitter" placeholder="Twitter" value="{{ $data['twitter'] }}">
                                        <span class="input-group-addon"><i class="icofont icofont-social-youtube"></i></span>
                                        <input type="text" class="form-control" id="iYoutube" name="iYoutube" placeholder="Youtube" value="{{ $data['youtube'] }}">
                                    </div>
                                    <h6>Desea Recibir publicidad de nuestras redes sociales ?</h6>
                                    <div class="input-group">
                                        <div class="form-radio">
                                            <div class="group-add-on">
                                                <div class="radio radiofill radio-inline">
                                                    <label>
                                                        <input type="radio" id="iAdvs" name="iAdvs"  value="SI" <?php if ($data['advertising'] == "SI") echo "checked"; ?> ><i class="helper"></i> Si
                                                    </label>
                                                </div>
                                                <div class="radio radiofill radio-inline">
                                                    <label>
                                                        <input type="radio" id="iAdvs" name="iAdvs" value="NO" <?php if ($data['advertising'] == "NO") echo "checked"; ?>><i class="helper"></i> No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Actualizar</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>