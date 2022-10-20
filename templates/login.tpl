{include file="header.tpl"}

<div class="modal modal-signin position-static d-block bg-secondary py-5" tabindex="-1" role="dialog" id="modalSignin">
<div class="modal-dialog" role="document">
  <div class="modal-content rounded-4 shadow">
    <div class="pt-5 pb-2 border-bottom-0">
      <!-- <h1 class="modal-title fs-5" >Modal title</h1> -->
      <h1 class="text-center fw-bold mb-0 fs-2 ">Iniciar sesión</h1>
    </div>

    <div class="modal-body p-5 pt-0">
      <form class="">
        <div class="form-floating mb-3">
          <input type="number" class="form-control rounded-3" id="floatingInput">
          <label for="floatingInput">DNI</label>
        </div>
        <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit">Ingresar</button>
      </form>
    </div>
  </div>
</div>
</div>

{include file="footer.tpl"}