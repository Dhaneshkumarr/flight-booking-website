<form class="p-3 rounded-2 shadow-sm">
    <div class="flight-type mb-3">
        <div class="row justify-content-between align-items-center">
            <div class="col-auto">
                <div class="btn-group btn-group-sm" role="group" aria-label="Flight type selection">
                    <input type="radio" class="btn-check" name="JType" id="round_trip" autocomplete="off" checked onClick="show_date(this.value)" value="roundtrip">
                    <label class="btn btn-outline-primary rounded-start-pill px-3 py-1" for="round_trip">
                        <i class="fas fa-exchange-alt me-1 small"></i> Ida y vuelta
                    </label>

                    <input type="radio" class="btn-check" name="JType" id="one_way" autocomplete="off" onClick="show_date(this.value)" value="oneway">
                    <label class="btn btn-outline-primary rounded-end-pill px-3 py-1" for="one_way">
                        <i class="fas fa-arrow-right me-1 small"></i> Solo ida
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="row m-0 fm_ln1 g-2 align-items-end">
        <div class="col-lg col-md-4 col-sm-6 col-xs-12 ffrms_ppd">
            <div class="res_hh text-dark">Desde</div>
            <div class="form-group mb-0">
                <label class="frm_llbs"><i class="fas fa-plane-departure searchIcons"></i></label>
                <input type="text" required="required" class="form-control ipt1 location-fld serlocation fisrt_edus" autocomplete="off" placeholder="Ciudad o aeropuerto" name="org" id="location">
            </div>
        </div>

        <div class="col-lg col-md-4 col-sm-6 col-xs-12 ffrms_ppd">
            <div class="res_hh text-dark">Hacia</div>
            <div class="form-group mb-0">
                <label class="frm_llbs"><i class="fas fa-plane-arrival searchIcons"></i></label>
                <input required="required" type="text" class="form-control ipt1 location-fld serlocation" placeholder="Ciudad o aeropuerto" name="dest" autocomplete="off" id="location2">
                <div style="display: none;" onclick="close_btn(this.id);" id="location2_cleardata" class="closed_icon"><i class="fa fa-remove"></i></div>
            </div>
        </div>

        <div class="col-lg col-md-4 col-xs-6 ffrms_ppd">
            <div class="res_hh text-dark">Salida</div>
            <div class="form-group mb-0">
                <label class="frm_llbs"><i class="fas fa-calendar-alt searchIcons"></i></label>
                <input id="depDt" type="hidden" value=''>
                <input type="text" class="form-control ipt1 readtrue" id="datepicker" required="required" autocomplete="off" placeholder="Fecha de salida" name="depDt" readonly="true" value="">
            </div>
        </div>

        <div class="col-lg col-md-4 col-xs-6 ffrms_ppd">
            <div class="res_hh text-dark">Regreso</div>
            <div class="form-group mb-0">
                <label class="frm_llbs"><i class="fas fa-calendar-alt searchIcons"></i></label>
                <input id="retDt" type="hidden" value=''>
                <input type="text" autocomplete="off" class="form-control ipt1 readtrue" required="required" id="datepicker2" placeholder="Fecha de regreso" readonly="true" name="retDt" value="">
            </div>
        </div>

        <div class="col-lg col-md-4 col-xs-6 mt-4 ffrms_ppd">
            <div class="form-group mb-0 position-relative z-3">
                <label class="frm_llbs"><i class="fas fa-user-friends searchIcons"></i></label>
                <input type="text" class="form-control ipt1" placeholder="Pasajeros 1" name="" autocomplete="off" id="btm_clk">
                <div class="psg_dls shadow-lg" style="display: none;">
                    <div class="col-md-12 col-sm-6 col-xs-12 ffrms_ppd">
                        <div class="form-grou mb-0p" style="margin: 0;">
                            <select class="form-control form-select ipt1" name="ct" placeholder="Clase económica">
                                <option selected="selected" value="ECONOMY">Económica</option>
                                <option value="PREMIUM_ECONOMY">Económica Premium</option>
                                <option value="BUSINESS">Clase Ejecutiva</option>
                                <option value="FIRST">Primera Clase</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row">
                            <div class="pass_bx">
                                <label class="text-dark">Adultos <small>(11+ años)</small></label>
                                <div class="input-group number-spinner">
                                    <span class="input-group-btn">
                                        <a class="btn mns_btn" data-dir="dwn" onclick="Seprease_adult_rt()"><i class="fa fa-minus"></i></a>
                                    </span>
                                    <input type="text" id="AdultsRT" class="form-control text-center add_num" name="adt" value="1">
                                    <span class="input-group-btn">
                                        <a class="btn add_btn" data-dir="up" onclick="increase_adult_rt()"><i class="fa fa-plus"></i></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row">
                            <div class="pass_bx">
                                <label class="text-dark">Niños <small>(2–11 años)</small></label>
                                <div class="input-group number-spinnerinf">
                                    <span class="input-group-btn">
                                        <a class="btn mns_btn" data-dir="dwn" onclick="Seprease_child_rt()"><i class="fa fa-minus"></i></a>
                                    </span>
                                    <input type="text" id="ChildrenRT" class="form-control text-center add_num" name="chd" value="0">
                                    <span class="input-group-btn">
                                        <a class="btn add_btn" data-dir="up" onclick="increase_child_rt()"><i class="fa fa-plus"></i></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row">
                            <div class="pass_bx">
                                <label class="text-dark">Bebés <small>(Hasta 2 años)</small></label>
                                <div class="input-group number-spinnerinf">
                                    <span class="input-group-btn">
                                        <a class="btn mns_btn" data-dir="dwn" onclick="Seprease_infant_rts()"><i class="fa fa-minus"></i></a>
                                    </span>
                                    <input type="text" class="form-control text-center add_num" id="InfantsRT" name="inf" value="0">
                                    <span class="input-group-btn">
                                        <a class="btn add_btn" data-dir="up" onclick="increase_infant_rt()"><i class="fa fa-plus"></i></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-xs-12">
                        <div class="btn_dn">
                            <button type="button" onclick="all_pesenger();" class="btn_done">Listo</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-1 col-md-4 col-sm-6 col-xs-12 ffrms_ppd text-end">
            <button type="button" class="lstt_edus btn h-100 w-100 searchBtn" name="submitForm" id="searchFlightsBtn"><i class="fas fa-search"></i></button>
        </div>
    </div>
    <div class="clearfix"></div>
</form>