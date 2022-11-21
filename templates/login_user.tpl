{include file="header_login.tpl"}

<div class="modal modal-signin position-static d-block bg-secondary py-5" tabindex="-1" role="dialog" id="modalSignin">
 <div class="card-login">
<div class="modal-dialog" role="document">
  <div class="modal-content rounded-4 shadow mb-5">
  <div class="card titulo-login shadow">
  <h4 class="">Acceso institución</h4>
  </div>
   
    {if isset($mensaje) && !empty($mensaje)}
      <div class="alert alert-dismissible alert-secondary">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>{$mensaje}</strong>
      </div>
    {/if}
    <div class="modal-body ps-5 pe-5 pt-5 mt-4">
      <form class="" method="POST" action="chequear_usuario">
        <div class="form-floating mb-3">
          <input type="text" class="form-control rounded-3" id="user" name="user" required>
          <label for="floatingInput">Usuario:</label>
        </div>
        <div class="form-floating mb-3">
          <input type="password" class="form-control rounded-3" id="pass" name="pass" required>
          <label for="floatingInput">Password:</label>
        </div>
        <div class="form-floating mb-3 d-flex justify-content-center">
          <input type="submit" class="form-control p-1 bg-verde boton-login shadow" value="Iniciar Sesion">
        </div>
      </div>
       </div>
  </div>
</div>

{include file="footer.tpl"}