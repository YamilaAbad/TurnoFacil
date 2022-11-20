{include 'header.tpl'}
<section>

<div class="portada">

    <img class="img-portada" src="img/1.jpg" alt="Consultorios">

    <h1 class="titulo-portada-home ms-5"> Bienvenido a TurnoFacil</h1>
    <p class="texto-portada ms-5">Ingrese al listado para ver cuando es su proximo turno o consulte al médico que desee</p>
     <div class="botones-portada ms-5">
    {* if es paciente *}
        <button type="button" class="btn bg-verde me-2"><a class="nav-link"  href="listar_turnos">Ver mis turnos</a></button>
    {*/if*}
    <button type="button" class="btn bg-verde ms-2" ><a class="nav-link nav-item" href="nuevo-turno">Sacar un turno</a></button>

    </div>
</div>




</section>

{include 'footer.tpl'}