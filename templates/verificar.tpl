{include 'header.tpl'}
<section class="container-fluid fondo_container col-lg-10 p-1">

    <div class="d-flex justify-content-center ">

        <div class="card col-lg-8 m-4">
            <div class="card-header">
                <h1 class='h3 mb-2 font-weight-normal'>Solicitar turno </h1>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <p>Por favor, verifique sus datos:</p>
                    <form class='form' action='verificar_datos' method='POST'>
                        <input type='hidden' name='dni_paciente' id='dni_paciente' class='form-control' value={$dni}>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label for='inputEmail'>Nombre <span class="text-danger">*</span> </label>
                                <input type='text' name='nombre' id='nombre' class='form-control' required
                                    autofocus>
                            </div>
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label for='inputEmail'>Apellido <span class="text-danger">*</span></label>
                                <input type='text' name='text' id='text' class='form-control' required>
                            </div>
                            <div class="form-group col-sm-6 flex-column d-flex">
                            </div>
                        </div>

                        <div class="row justify-content-between text-left">
                            <div class="col-sm-12 flex-column d-flex">
                                <div class="form-group flex-column d-flex">
                                    <label for='inputEmail'>Domicilio <span class="text-danger">*</span> </label>
                                    <input type='text' name='domicilio' id='domicilio' class='form-control' required
                                        autofocus>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <div class="form-group flex-column d-flex">
                                    <label for='inputEmail'>Teléfono <span class="text-danger">*</span> </label>
                                    <input type='text' name='telefono' id='telefono' class='form-control' required
                                        autofocus>
                                </div>
                            </div>

                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label for='inputEmail'>Email <span class="text-danger">*</span> </label>
                                <input type='email' name='email' id='email' class='form-control' required>
                            </div>
                        </div>

                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label for='inputObraSocial'>Obra social <span class="text-danger">*</span> </label>
                                <select name="obra_elegida" class="form-control" required> 
                                    <option name="obra_elegida" value=''>Selecione</option>
                                    {foreach from=$mutuales item=mut} 
                                        <option value='{$mut->os_id}'> {$mut->os_nombre}</option>
                                    {/foreach}
                                </select>
                            </div>

                            <div class="form-group col-sm-6 flex-column d-flex">
                                <div class="form-group flex-column d-flex">
                                    <label for='inputNroAfiliado'>N° de afiliado <span class="text-danger">*</span>
                                    </label>
                                    <input type='text' name='n_afiliado' id='n_afiliado' class='form-control' required
                                        autofocus>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button class=" btn btn-primary" type="submit">Confirmar Datos</button>
                            <button class=" btn btn-danger" type="submit">Cancelar</button>
                        </div>
                </div>
            </div>
            </form>

        </div>
    </div>

    </div>
</section>

</main>
{include 'footer.tpl'}