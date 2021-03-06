<!-- SideBar -->
<section class="full-box cover dashboard-sideBar">
		<div class="full-box dashboard-sideBar-bg btn-menu-dashboard"></div>
		<div class="full-box dashboard-sideBar-ct">
			<!--SideBar Title -->
			<div class="full-reset logo">
                <img src="../../assets/img/logo2.png" alt="Logo" class="hidden-xs hidden-sm" style="align-content: right">
            </div>
			<!-- SideBar User info -->
			<div class="full-box dashboard-sideBar-UserInfo">
				<figure class="full-box">
                    <p class="text-center text-muted"><i class="zmdi zmdi-account-circle zmdi-hc-5x"></i></p>
				</figure>
				<ul class="full-box list-unstyled text-center">
					<li>
						<a href="#!">
							<i class="zmdi zmdi-settings"></i>
						</a>
					</li>
					<li>
						<a href="#!" class="btn-exit-system">
							<i class="zmdi zmdi-power"></i>
						</a>
					</li>
				</ul>
			</div>
			<!-- SideBar Menu -->
			<ul class="list-unstyled full-box dashboard-sideBar-Menu">
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-case zmdi-hc-fw"></i> Administración <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="period.php"><i class="zmdi zmdi-timer zmdi-hc-fw"></i> Periodos</a>
						</li>
						<li>
							<a href="matricula.php"><i class="zmdi zmdi-font zmdi-hc-fw"></i> Matriculas</a>
						</li>
						<li>
							<a href="asignatura.php"><i class="zmdi zmdi-book zmdi-hc-fw"></i> Asignaturas</a>
						</li>
						<li>
							<a href="section.html"><i class="zmdi zmdi-graduation-cap zmdi-hc-fw"></i> Cursos</a>
						</li>
						<li>
							<a href="building.html"><i class="zmdi zmdi-balance zmdi-hc-fw"></i> Edificios</a>
						</li>
						<li>
							<a href="salon.html"><i class="zmdi zmdi-font zmdi-hc-fw"></i> Aulas</a>
						</li>
						<li>
							<a href="docente_asignatura.php"><i class="zmdi zmdi-case zmdi-hc-fw"></i> Registro de asignaturas por docente</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="gestion_persona.php">
						<i class="zmdi zmdi-account zmdi-hc-fw"></i> Gestión de Usuarios
					</a>
				</li>
				<li>
					<a href="gestion_aspirante.php">
						<i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Gestión de Aspirantes
					</a>
				</li>
			
			</ul>
		</div>
    </section>
    	<!--====== Scripts -->
	<script src="../js/jquery-3.1.1.min.js"></script>
	<script src="../js/sweetalert2.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/material.min.js"></script>
	<script src="../js/ripples.min.js"></script>
	<script src="../js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="../js/main.js"></script>
	<script>
		$.material.init();
	</script>