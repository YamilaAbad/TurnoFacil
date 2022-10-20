{include 'header.tpl'}
<section class="container-fluid fondo_container col-lg-10 p-1">

    <div class="d-flex justify-content-center ">

        <div class="card col-lg-8 m-4">
            <div class="card-header">
                <h1 class='h3 mb-2 font-weight-normal'>Solicitar turno </h1>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <form class='form' action='obtener_turnos' method='POST'>

                        <div class="row justify-content-between text-left mt-4">
                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label for='inputMedico'>Especialidad:<span class="text-danger">*</span> </label>
                                <select name="especialidad" class="form-control" required>
                                    <option name="obra_elegida" value=''>Selecione</option>
                                    {foreach from=$especialidades item=esp} 
                                        <option value='{$esp->esp_id}'> {$esp->esp_nombre}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                        <div class="row justify-content-between text-left mt-4">
                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label for='inputMedico'>Obra Social <span class="text-danger">*</span> </label>
                                <select name="obra_elegida" class="form-control" required> 
                                    <option name="obra_elegida" value=''>Selecione</option>
                                    {foreach from=$mutuales item=mut} 
                                        <option value='{$mut->os_id}'> {$mut->os_nombre}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div><br/>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-md-4 flex-column d-flex">
                                <label for='inputFechaDesde'>Desde<span class="text-danger">*</span> </label>
                                <div class="input-group date">
                                     <input id="datepickerDesde" type="text" class="form-control clickable input-md" id="fechaDesde">
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
                                <input id="datepickerHasta" type="text" class="form-control clickable input-md" id="fechaHasta">
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
                                <input class="form-check-input" type="radio" name="turno" id="maniana" required>
                                <label class="form-check-label" for="turno">
                                    Mañana
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="turno" id="tarde" required>
                                <label class="form-check-label" for="turno">
                                    Tarde
                                </label>
                            </div>
                        </div>
                </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end m-2">
                        <input class=" btn btn-primary" type="button" value="Filtrar">
                    </div>
                </form>
                {if (!empty($filtro)) }
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Elegir</th>
                                <th>Médico</th>
                                <th>Atiende por</th>
                                <th>Fecha y hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach from=$filtro item=resu}
                                <tr>
                                    <td>
                                        <input type="checkbox" name="check_list[]" value="{$resu->turno_id}">
                                    </td>
                                    <td>
                                        {$resu->usuario_apellido}, {$resu->usuario_nombre}
                                    </td>
                                    <td>
                                        {$resu->os_nombre}
                                    </td>
                                    <td>
                                        {$resu->turno_fecha} - {$resu->turno_hora}
                                    </td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>

<<<<<<< HEAD
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class=" btn btn-primary" type="submit">Confirmar Turno</button>
                        <button class=" btn btn-danger" type="submit">Cancelar</button>
                    </div>
            {else}
                <p> No hay turnos elegidos para el rango filtrado</p>
            {/if}
=======
                <div class="d-grid gap-2 d-md-flex justify-content-md-end m-2">
                    <input class=" btn btn-primary" type="button" value="Filtrar">
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Elegir</th>
                            <th>Médico</th>
                            <th>Atiende por</th>
                            <th>Fecha y hora</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> <input type="radio" name="turnoElegido" id="fila-1" required></td>
                            <td>Rodriguez Pablo</td>
                            <td>Av. Moreno 415</td>
                            <td>10/11/2022 - 10:15am</td>
                        </tr>
                        <tr>
                            <td> <input type="radio" name="turnoElegido" id="fila-2" required></td>
                            <td>Prueba</td>
                            <td>Av. Rivadavia 155</td>
                            <td>15/11/2022 - 9:15am</td>
                        </tr>
                    </tbody>
                </table>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class=" btn btn-primary" type="submit">Confirmar Turno</button>
                    <button class=" btn btn-danger" type="submit">Cancelar</button>
                </div>

>>>>>>> templates
            </div>

        </div>
        </form>

    </div>
    </div>

    </div>
</section>
<script type="text/javascript">

var nowTemp = new Date();
var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

var checkin = $('#datepickerDesde').datepicker({
    format: "yyyy-mm-dd",
    beforeShowDay: function(date) {
    return date.valueOf() >= now.valueOf();
  },
  autoclose: true

});

var checkout = $('#datepickerHasta').datepicker({
    format: "yyyy-mm-dd",
    beforeShowDay: function(date) {
    return date.valueOf() >= now.valueOf();
  },
  autoclose: true

});

    // $(function() {

    //     $('#datepickerDesde').datepicker({
    //         disable: [
    //             new Date(2022, 10, 10),
    //             new Date(2022, 10, 11)
    //         ]
    //     });
    //     $('#datepickerHasta').datepicker();
    // });
</script>
</main>
{include 'footer.tpl'}