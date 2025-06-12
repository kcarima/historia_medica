<footer id="footer" class="footer light-background py-3"> <!-- Reduje el padding vertical -->
    <div class="container footer-top">
      <div class="row gy-2"> <!-- Cambié gy-4 a gy-2 para menos espacio entre filas -->
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="#" class="logo d-flex align-items-center">
            <span class="sitename">Registro Médico ANFE</span>
          </a>
          <div class="footer-contact pt-2"> <!-- Reduje el padding-top -->
            {{-- Información de contacto comentada --}}
       </div>
          <div class="social-links d-flex mt-2"> <!-- Reduje el margin-top -->
            <a href="#"><i class="bi bi-question-circle"></i></a> <!-- Icono de ayuda -->
          <a href="{{ route('respaldo.bdd') }}" title="Descargar respaldo de base de datos">
            <i class="bi bi-database"></i>
             </a> <!-- Icono de base de datos -->

          </div>
        </div>

        {{-- Columnas de enlaces (comentadas) --}}
        <div class="col-lg-2 col-md-3 footer-links"></div>
        <div class="col-lg-2 col-md-3 footer-links"></div>
        <div class="col-lg-2 col-md-3 footer-links"></div>
        <div class="col-lg-2 col-md-3 footer-links"></div>
      </div>
    </div>

    <div class="container copyright text-center mt-3"> <!-- Reduje el margin-top -->
      <p class="mb-0">© <span>Copyright</span> <strong class="px-1 sitename">Matiguan</strong> <span>All Rights Reserved</span></p>
    </div>
</footer>
