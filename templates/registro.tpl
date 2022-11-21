{include 'header.tpl'}
    <section class="container-fluid fondo_container col-lg-10 p-1">
       
    <div class="d-flex justify-content-center">

        <div class="card col-lg-8 m-4">
        <div class="card-header bg-verde">
        <h1 class='h3 mb-3 font-weight-normal'>Registrar paciente </h1>
        </div>
            <div class="card-body">
                <div class="form-group">  
                   
                    <form class='form' action='guardar_datos' method='POST'>  

                        <div class="row justify-content-between text-left m-2 mt-2  mt-3">       
                            <div class="form-group col-sm-6 flex-column d-flex" >
                                <label for='inputEmail'>Apellido <span class="text-danger">*</span> </label>
                                <input type='text' name='apellido' id='apellido' class='form-control' required>
                            </div>
                            <div class="form-group col-sm-6 flex-column d-flex" >
                                <div class="form-group flex-column d-flex" >
                                    <label for='inputEmail' >Nombre <span class="text-danger">*</span>  </label>
                                    <input type='text' name='nombre' id='nombre' class='form-control' required autofocus>
                                </div>
                            </div>
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <div class="form-group flex-column d-flex" >
                                    <label for='inputEmail' >Nro doc. <span class="text-danger">*</span>  </label>
                                    <input type='text' name='dni' id='dni' class='form-control' required autofocus>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-between text-left m-2 mt-2  mt-3"> 
                            <div class="form-group col-sm-6 flex-column d-flex" >
                                <div class="form-group flex-column d-flex">
                                    <label for='inputEmail' >Domicilio:> <span class="text-danger">*</span>  </label>
                                    <input type='text' name='domicilio' id='domicilio' class='form-control' required autofocus>
                                </div>
                            </div>

                                <div class="form-group col-sm-6 flex-column d-flex" >
                                <div class="form-group flex-column d-flex">
                                    <label for='inputEmail'>Telefono <span class="text-danger">*</span> </label>
                                    <input type='text' name='telefono' id='telefono' class='form-control' required
                                    autofocus>
                                </div>
                            </div>
                        </div> 

                        <div class="row justify-content-between text-left m-2 mt-2  mt-3"> 

                            <div class="form-group col-sm-6 flex-column d-flex" >
                                <label for='inputEmail'>Email</label>
                                <input type='email' name='email' id='email' class='form-control' required>
                            </div>
                        </div>
                        </div>
        </div>
        <div class="card-footer card-header bg-verde">
        <h5> Si posee obra social complete</h5>
        </div>
        <div class="card-body">
  
            <div class="row justify-content-between text-left m-2 mt-2  mt-3">       
                <div class="form-group col-sm-6 flex-column d-flex" >
                    <label for='inputEmail'>Obra social </label>
                    <select name="obra_elegida" class="form-control" required> 
                        <option name="obra_elegida" value=''>Seleccione</option>
                        {foreach from=$mutuales item=mut} 
                            <option value='{$mut->os_id}'> {$mut->os_nombre}</option>
                        {/foreach}
                    </select>
                </div>

                <div class="form-group col-sm-6 flex-column d-flex" >
                    <div class="form-group flex-column d-flex" >
                        <label for='inputEmail' >N° de afiliado  </label>
                        <input type='text' name='afiliado' id='afiliado' class='form-control' autofocus>
                    </div>
                </div>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button class=" btn btn-primary" type="submit">Guardar</button>
                <button class=" btn btn-danger" type="button">Cancelar</button>
            </div>                                 
        </form>                  
                </div>
            </div>
        </div>

    </div>
</section>

</main>
{include 'footer.tpl'}