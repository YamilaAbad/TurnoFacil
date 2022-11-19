{include 'head.tpl'}

<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">

            <div class="">
                <a class="navbar-brand" href="#"><img class="img-logo" src="img/logobco.png"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
                
            <div class="d-flex me-5 m-2">
                <div class="collapse navbar-collapse  justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        {* <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li> *}
                        <li class="nav-item me-3 ms-5">
                            <button type="button" class="btn bg-verde"><a class="nav-link nav-item p-0 text-light" href="login-user">Acceso institución</a></button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="btn bg-verde"><a class="nav-link nav-item p-0 text-light" href="login">Acceso paciente</a></button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>

<section>

    <div class="portada">

        <img class="img-portada" src="img/image.png">

        <h1 class="titulo-portada ms-5"> TurnoFacil Gestión de turnos online</h1>
        <p class="texto-portada ms-5">Bienvenido a Turno Facil, la turnera online más intuitiva y flexible que te permitirá gestionar tus turnos desde la comodidad de tu casa </p>
        <div class="botones-portada ms-5">
            <button type="button" class="btn bg-verde me-2"><a class="nav-link nav-item" href="login-user">Acceso institución</a></button>
            <button type="button" class="btn bg-verde ms-2"><a class="nav-link nav-item" href="login">Acceso paciente</a></button>
        </div>
    </div>




</section>

{include 'footer.tpl'}