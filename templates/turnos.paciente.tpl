{include 'header.tpl'}
<section class="container-fluid fondo_container col-lg-10 p-1">

<div class="d-flex justify-content-center">
    <div class="col-lg-12 list-turnos m-5">
        <div class="card p-0">
            <div class="card-header">
                <h1 class='h3'>Listado de turnos </h1>
            </div>
            <div class="card-body d-flex justify-content-center">
                <table class="table table-striped m-4 ps-5">
                    <thead class="ps-5">
                        <tr>
                            <th class="ps-4">Médico</th>
                            <th>Especialidad</th>
                            <th>Fecha y hora</th>
                        </tr>
                    </thead>
                    <tbody >
                        {if isset($turnos) && !empty($turnos)}   
                            {foreach from=$turnos item=turno}
                                <tr>
                                    <td class="ps-4">
                                        {$turno->medico_nombre}
                                    </td>
                                    <td>
                                        {$turno->esp_nombre}
                                    </td>
                                    <td>
                                        {$turno->turno_fecha} - {$turno->turno_hora}
                                    </td>
                                </tr>
                            {/foreach} 
                        {/if}
                    </tbody>
                </table>      
            </div>
        </div>
    </div>
</div>

</section>
    {include 'footer.tpl'}