<?php
	echo '
		<!-- Image and text -->
		<header class="bg-light" style="height: 60px;padding-right: 70px;">
			<nav class="navbar navbar-expand-lg navbar-light" style="float: right;">
				<a class="navbar-brand" href="./">
				<!--<img src="img/logo.png" width="70" height="50" class="d-inline-block align-top" alt="">-->
				</a>

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav">
					  <li class="nav-item">
					    <a class="nav-link" href="./inicio.php">Início <span class="sr-only">(current)</span></a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link" href="./form_config_messenger.php">Gerenciar Mensagem</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link" href="./form_config_email.php">Gerenciar E-mail</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link" href="./form_config_grupo.php">Gerenciar Grupo</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link" href="./desloga.php">Sair</a>
					  </li>
					</ul>
				</div>
			</nav>
		</header>
';