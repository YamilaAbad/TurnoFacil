{include 'header.tpl'}
<section class="container-fluid fondo_container col-lg-10 p-1">

    <div class="d-flex justify-content-center">

        <div class="card col-lg-8 m-4 p-0">
            <div class="card-header">
                <h1 class='h3 mb-2 font-weight-normal'>Solicitar turno </h1>
            </div>
            <div class="card-body">
                <form class='form' action='filtrar_turnos' method='POST'>
                     <div class="form-group">
                        <input type='hidden' name='dni' id='dni' class='form-control' value='{$dni}' required>
                        <div class="row justify-content-between text-left mt-4">
                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label for='inputMedico'>Médico:</label>
                                <select name="medico" id="medicoSeleccionado" class="form-select">
                                    <option name="medico" value=''>Seleccione</option>
                                    {foreach from=$medicos item=med} 
                                        <option name="medico" value='{$med->medico_id}'> {$med->medico_apellido}, {$med->medico_nombre}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                       
                    </div>    
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-md-4 flex-column d-flex">
                        <label for='inputFechaDesde'>Desde<span class="text-danger">*</span> </label>
                        <div class="input-group date">
                            <input id="datepickerDesde" type="text" class="form-control clickable input-md" id="fechaDesde" name="fechaDesde" required>
                            <span class="input-group-append">
                                <span class="input-group-text bg-white">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </span>
                        </div>
                     </div>
                    <div class="form-group col-md-4 flex-column d-flex">
                        <label for='inputFechaHasta'>Hasta<span class="text-danger">*</span> </label>
                        <div class="input-group date">
                        <input id="datepickerHasta" type="text" class="form-control clickable input-md" id="fechaHasta" name="fechaHasta" required>
                            <span class="input-group-append">
                                <span class="input-group-text bg-white">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </span>
                        </div>
                    </div>

                    <div class="form-group col-md-4 flex-column d-flex">
                        <label for='checkTurno'>Seleccione el turno:<span class="text-danger">*</span> </label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="turno" id="turnoManiana" value="maniana" required>
                            <label class="form-check-label" for="turno">
                                Mañana
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="turno" id="turnoTarde" value="tarde" required>
                            <label class="form-check-label" for="turno">
                                Tarde
                            </label>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end m-2">
                        <input class=" btn btn-primary" type="submit" value="Filtrar">
                    </div>
                </form>
            </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Elegir</th>
                            <th>Médico</th>
                            <th>Fecha y hora</th>
                        </tr>
                    </thead>
                    <tbody>
                        {if isset($filtro) && !empty($filtro)}  
                            <form action="confirmar_turno" method="POST" class="form-inline my-2 my-lg-0"> 
                                <input type="hidden" name="paciente" id="paciente" value="{$dni}">
                                {foreach from=$filtro item=resu}
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="check_list" value="{$resu->turno_id}">
                                        </td>
                                        <td>
                                            {$resu->medico_apellido}, {$resu->medico_nombre}
                                        </td>
                                        <td>
                                            {$resu->turno_fecha} - {$resu->turno_hora}
                                        </td>
                                    </tr>
                                {/foreach}
                            </tbody>
                        </table>
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button class=" btn btn-primary" type="submit">Confirmar Turno</button>
                                <button class=" btn btn-danger" type="button">Cancelar</button>
                            </div>
                        </form>
                    {/if}

            </div>
            </div>

        <script type="text/javascript" src="./js/script.js"></script>
    </div> {* fin del div d-flex justify-content-center *}

</section>
