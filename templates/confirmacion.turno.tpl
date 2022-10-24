{include 'header.tpl'}
<div class="d-flex justify-content-center">

    <div class="col-lg-6"> 
        {foreach from=$datos item=$dat}
        <div class="card m-4 tarjeta">
            <div class="card-header bg-verde p-4">
             <h1><i class="far fa-check-circle pe-2"></i>Turno confirmado</h1>
            </div>
            <div class="card-body m-3">
                <p class="card-text m-0">Dia y horario </p>
                <p class="card-text  m-0"><strong>{$dat->turno_hora}{$dat->turno_fecha} </strong></p>
                <p class="card-text linea pb-2">{}</p>

                <p class="card-text  m-0">Médico</p>
                <p class="card-text linea pb-2"><strong>{$dat->medico_nombre}{$dat->medico_apellido}</strong></p>

                <p class="text-danger"> <strong> Recordatorio: </strong> {$mensaje}</p>
            </div>

        {/foreach}
 
            <div class="col-lg-12 mb-3">
            <div class="row">
                <div class="d-flex ">
                    
                        <div class="col-lg-6 d-flex justify-content-end pe-3">
                            <button type="button" class="btn bg-naranja ps-4 pe-4">Imprimir</button>
                        </div>
                        <div class="col-lg-6 ps-3">
                            <button type="button" class="btn bg-verde">Ver mis turnos</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>







{include 'footer.tpl'}