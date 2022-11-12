{include 'header.tpl'}
<section class="container-fluid fondo_container col-lg-10 p-1">

<div class="col-lg-12">
<div class="d-flex justify-content-end">
    <table class="table table-striped m-5 ps-5">
        <thead class="ps-5">
            <tr>
                <th class="ps-4">Médico</th>
                <th>Especialidad</th>
                <th>Fecha y hora</th>
            </tr>
        </thead>
        <tbody >
            {* {if isset($turnos) && !empty($turnos)}   *}
                <form action="registrar_turno" method="POST" class="form-inline my-2 my-lg-0"> 
                    
                    {* {foreach from=$turnos item=turno}
                        <tr>
                            <td class="ps-4">
                                 {$turno->medico_nombre}
                            </td>
                            <td>
                                {$turno->medico_especialidad},
                            </td>
                            <td>
                                {$turno->turno_fecha} - {$turno->turno_hora}
                            </td>
                        </tr>
                    {/foreach} *}
                {* {/if} *}
        </tbody>
    </table>

</div>
</div>

</section>

    {include 'footer.tpl'}