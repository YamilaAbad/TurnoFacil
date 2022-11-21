{include file="header.tpl"}

<div class="modal modal-signin position-static d-block bg-secondary py-5" tabindex="-1" role="dialog" id="modalSignin">
<div class="modal-dialog" role="document">
  <div class="modal-content rounded-4 shadow">
    <div class="pt-5 pb-2 border-bottom-0">
    <h1 class="text-center fw-bold mb-0 fs-2 ">Buscar paciente</h1> 
    </div>
    {if isset($mensaje) && !empty($mensaje)}
      <div class="alert alert-dismissible alert-secondary">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>{$mensaje}</strong>
      </div>
    {/if}
    <div class="modal-body p-5 pt-0">
      <form class="" method="POST" action="buscar_paciente">
        <div class="form-floating mb-3">
          <input type="text" class="form-control rounded-3" id="dni" name="dni" required>
          <label for="floatingInput">DNI</label>
        </div>
        <div class="d-flex justify-content-center">
          <button type="submit" class="btn bg-verde boton-login shadow">Buscar</button>
        </div>
        
      </form>
    </div>
  </div>
  </div>
</div>

{include file="footer.tpl"}