{include file="header_login.tpl"}

<div class="modal modal-signin position-static d-block bg-secondary py-5 p-5" tabindex="-1" role="dialog" id="modalSignin">
  <div class="card-login">
    <div class="modal-dialog" role="document">
      <div class="modal-content rounded-4 shadow mb-5">
        <div class="card titulo-login shadow">
          <h4 class="ps-2 pe-2">Acceso Paciente</h4>
        </div>
        {if isset($mensaje) && !empty($mensaje)}
          <div class="alert alert-dismissible alert-secondary">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>{$mensaje}</strong>
          </div>
        {/if}
        <div class="modal-body pt-5 mt-5 ps-5 pe-5">
          <form class="" method="POST" action="chequear_paciente">
            <div class="form-floating mb-3">
              <input type="text" class="form-control rounded-3" id="dni" name="dni" required>
              <label for="floatingInput">Ingrese DNI</label>
            </div>
            <div class="d-flex justify-content-center">
              <button type="submit" class="btn bg-verde boton-login shadow">Ingresar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

{include file="footer.tpl"}