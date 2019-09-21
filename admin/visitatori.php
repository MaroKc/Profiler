<?php

include('profiler/main.php');

?>

<html>

<?php include('inc/header.php'); ?>

            
            <div class="container mt-5">
				<div class="col-8 m-auto">
				
				<form method="post">
					<select name="filtroCRO" class="form-control mb-3 col-4" onchange="this.form.submit()">
							<?php
							$filtri = visualizzaInterazioniDB();
								foreach ($filtri as $filtro) {
									echo '<option value="'.$filtro['iid'].'" '.($a = isset($_POST['filtroCRO']) && $_POST['filtroCRO'] == $filtro['iid'] ? 'selected' : '').'>'.$filtro['nome_filtro'].'</option>';
								}
							?>
						</select>
					</form>
					
					<?php if(isset($_GET["dettaglio"])){ 
						
						$visitatori = utenteDelSito();
						$visiteUtente = visitePerUtente();
						
						$vi = $visitatori->fetch_assoc()
						?>

						<div class="row text-center mb-5" style="font-size:20px">
							<div class="col-6">
								<i class="fa fa-user fa-2x fa-fw" data-toggle="tooltip" title="Token"></i>
								<br><?php echo $vi['token']; ?>
							</div>
							<div class="col-6 mb-3">
								<i class="fa fa-clock fa-2x fa-fw" data-toggle="tooltip" title="Visite"></i>
								<br><?php echo $vi['visite']; ?>
							</div>
							<div class="col-6">
								<i class="fa fa-history fa-2x fa-fw" data-toggle="tooltip" title="Ultima visita"></i> 
								<br><?php echo $vi['ultima_visita']; ?>
							</div>
							<div class="col-6">
								<i class="fa fa-calendar-day fa-2x fa-fw" data-toggle="tooltip" title="Giorno di registrazione"></i>
								<br><?php echo $vi['giorno_registrazione']; ?>
							</div>
						</div>


						<table class="table table-striped table-bordered shadow-sm" id="table_id">
							<thead>
							<tr class="font-weight-bold">
								<th width="40%">Pagina</th>
								<th width="20%">Visite</th>
								<th width="40%">Tempo</th>
							</tr>
							</thead>
							<tbody>


							<?php while($v = $visiteUtente->fetch_assoc()){ ?>
								<tr>
									<td><?php echo $v['nome']; ?></td>
									<td><?php echo $v['visite']; ?></td>
									<td><?php echo $v['tempo']; ?></td>
								</tr>
							<?php } ?>
							</tbody>

						</table>
					<?php } else {
											
						$sezioni = utentiDelSito();

						if(isset($_POST['filtroCRO'])) 
							$sezioni = recuperaFiltri($_POST['filtroCRO']);
					?>
						<table class="table table-striped table-bordered" id="table_id">
							<thead>
							<tr class="font-weight-bold">
								<th width="10%">Token</th>
								<th width="20%">Visite</th>
								<th width="30%">Ultima Visita</th>
								<th width="30%">Giorno Registrazione</th>
								<th width="10%">Dettagli</th>
							</tr>
							</thead>
							<tbody>


							<?php while($s = $sezioni->fetch_assoc()){ ?>
								<tr>
									<td><?php echo $s['token']; ?></td>
									<td><?php echo $s['visite']; ?></td>
									<td><?php echo $s['ultima_visita']; ?></td>
									<td><?php echo $s['giorno_registrazione']; ?></td>
									<td class="text-center"><a href="?dettaglio=<?php echo $s['token']; ?>" class="btn btn-secondary rounded"><i class="fa fa-info-circle"></i></a></td>	
								</tr>
							<?php } ?>
							</tbody>

						</table>
					<?php } ?>
				</div>
            </div>

		<?php include('inc/footer.php'); ?>
	</body>
</html>