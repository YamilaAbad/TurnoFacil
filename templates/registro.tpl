{include 'header.tpl'}
    <section class="container-fluid fondo_container col-lg-10 p-1">
       
      

    <div class="d-flex justify-content-center ">

    


        <div class="card col-lg-8 m-4">
        <div class="card-header bg-verde">
        <h1 class='h3 mb-3 font-weight-normal'>Registrar paciente </h1>
        </div>
            <div class="card-body">
                <div class="form-group">  
                   
                        <form class='form' action='registrar_datos' method='POST'>  

                           <div class="row justify-content-between text-left m-2 mt-2  mt-3">       
                                <div class="form-group col-sm-6 flex-column d-flex" >
                                    <label for='inputEmail'>Apellido <span class="text-danger">*</span> </label>
                                    <input type='email' name='email' id='email' class='form-control'>
                                </div>
                                <div class="form-group col-sm-6 flex-column d-flex" >
                                    <div class="form-group flex-column d-flex" >
                                        <label for='inputEmail' >Nombre <span class="text-danger">*</span>  </label>
                                        <input type='text' name='telefono' id='telefono' class='form-control' required autofocus>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-between text-left m-2 mt-2  mt-3"> 
                               <div class="form-group col-sm-6 flex-column d-flex" >
                                    <div class="form-group flex-column d-flex" >
                                        <label for='inputEmail' >Domicilio <span class="text-danger">*</span>  </label>
                                        <input type='text' name='telefono' id='telefono' class='form-control' required autofocus>
                                    </div>
                                </div>

                                 <div class="form-group col-sm-6 flex-column d-flex" >
                                    <div class="form-group col-sm-4 flex-column d-flex" >
                                        <label for='inputEmail' >Numero <span class="text-danger">*</span>  </label>
                                        <input type='number' name='telefono' id='telefono' class='form-control' required autofocus>
                                    </div>
                                </div>
                            </div> 


                            <div class="row justify-content-between text-left m-2 mt-2  mt-3"> 
                                <div class="form-group col-sm-6 flex-column d-flex" >
                                    <div class="form-group flex-column d-flex" >
                                        <label for='inputEmail' >Telefono <span class="text-danger">*</span>  </label>
                                        <input type='text' name='telefono' id='telefono' class='form-control' required autofocus>
                                    </div>
                                </div>

                                <div class="form-group col-sm-6 flex-column d-flex" >
                                    <label for='inputEmail'>email</label>
                                    <input type='email' name='email' id='email' class='form-control'>
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
                                    <select name="calle" class="form-control" required>
                                        <option value=''>selecione aqui</option> 
                                       
                                                <option value="1"> Avalian</option>
                                                <option value="1"> Aca Salud</option>
                                                <option value="1"> Sancor Seguros</option>
                                                <option value="1"> Pami</option>
                                       
                                    </select> 
                                </div>

                                <div class="form-group col-sm-6 flex-column d-flex" >
                                    <div class="form-group flex-column d-flex" >
                                        <label for='inputEmail' >N° de afiliado  </label>
                                        <input type='number' name='telefono' id='telefono' class='form-control' required autofocus>
                                    </div>
                                </div>
                            </div>

                     
                        </form>

                        
                </div>
            </div>
        </div>

         </div>
        </section>

</main>
{include 'footer.tpl'}