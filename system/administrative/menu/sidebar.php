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
					<a href="home.html">
						<i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i> Panel de Administración
					</a>
				</li>
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
							<a href="subject.html"><i class="zmdi zmdi-book zmdi-hc-fw"></i> Asignaturas</a>
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
							<a href="teacher_subject.html"><i class="zmdi zmdi-case zmdi-hc-fw"></i> Registro de asignaturas por docente</a>
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
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-card zmdi-hc-fw"></i> Pagos <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="registration.html"><i class="zmdi zmdi-money-box zmdi-hc-fw"></i> Registro</a>
						</li>
						<li>
							<a href="payments.html"><i class="zmdi zmdi-money zmdi-hc-fw"></i> Pagos</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-shield-security zmdi-hc-fw"></i> Ajustes <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="school.html"><i class="zmdi zmdi-balance zmdi-hc-fw"></i> Datos de la institución</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-graduation-cap zmdi-hc-fw"></i> Escolar <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="homework.html"><i class="zmdi zmdi-book zmdi-hc-fw"></i> Tareas</a>
						</li>
						<li>
							<a href="release.html"><i class="zmdi zmdi-card zmdi-hc-fw"></i> Comunicados</a>
						</li>
						<li>
							<a href="score.html"><i class="zmdi zmdi-font zmdi-hc-fw"></i> Calificaciones</a>
						</li>
						<li>
							<a href="assistance.html"><i class="zmdi zmdi-alert-triangle zmdi-hc-fw"></i> Faltas</a>
						</li>
					</ul>
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