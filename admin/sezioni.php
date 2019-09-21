<?php

include('profiler/main.php');

?>

<html>

<?php include('inc/header.php'); ?>

	
            
            <div class="container d-flex h-100" style="align-items:center">
				<div class="col-8 m-auto">
					<?php if(isset($_GET["new"])){ 
						
						if(isset($_POST['nome'])){
							$risultato = aggiungiSezione();
							echo alert($risultato[0], $risultato[1]);
						}
						?>
						<div class="steps">
							<form method="post">
							<input type="hidden" name="tipologia" value="1"/>

								<div class="step-1">
									<div class="row text-center display-2">
										<h2 class="col-12 mb-5 display-4">Scegli il tipo di sezione</h2>
										<div class="col text-right">
											<i class="far fa-file single pointer border p-5 rounded text-primary" data-placement="bottom" data-toggle="tooltip" title="Singolo"></i>
										</div>
										<div class="col text-left">
											<i class="far fa-copy multi pointer border p-5 rounded text-primary" data-placement="bottom" data-toggle="tooltip" title="Multiplo"></i>
										</div>
									</div>
								</div>

								<div class="step-2" style="display:none">
									<div class="row">
										<div class="col">
											<input type="text" name="nome" class="form-control mb-3" placeholder="Nome sezione"/>
											<button class="float-right btn btn-primary gotostep3" type="button">Avanti <i class="fa fa-arrow-alt-circle-right fa-lg"></i></button>
											<button class="float-right btn btn-secondary backtostep1 mr-2" type="button"><i class="fa fa-arrow-alt-circle-left fa-lg"></i> Indietro</button>
										</div>
									</div>
								</div>

								<div class="step-3" style="display:none">
									<div class="row">
										<div class="col">
											<input type="text" name="url" class="form-control mb-3" placeholder="URL"/>
											<button class="float-right btn btn-primary" type="submit">Fine <i class="fas fa-check fa-lg"></i></button>
											<button class="float-right btn btn-secondary backtostep2 mr-2" type="button"><i class="fa fa-arrow-alt-circle-left fa-lg"></i> Indietro</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					<?php } else {
						$sezioni = controllaSezioni();

						if(isset($_GET['rimuovi'])) {
							$conf = confermaEliminazione($_GET['rimuovi']);
							echo alert($conf[0], $conf[1]);

							if($conf[0] == "success")
								header("location: sezioni.php?success");
						}

						if(isset($_GET['success']))
							echo alert("success", "Sezione eliminata con successo!");
					?>

						<a href="?new" class="btn btn-primary float-right my-3"><i class="fa fa-plus-circle fa-lg"></i> Nuovo</a>
						<div class="clearfix"></div>
						<table class="table table-striped table-bordered shadow-sm" id="table_id">
							<thead>
							<tr class="font-weight-bold">
								<th width="40%">URL</th>
								<th width="30%">Nome</th>
								<th width="10%">Tipo</th>
								<th width="10%">Azione</th>
							</tr>
							</thead>
							<tbody>


							<?php while($s = $sezioni->fetch_assoc()){ ?>
								<tr>
									<td><?php echo $s['url']; ?></td>
									<td><?php echo $s['nome']; ?></td>
									<td><?php echo $s['tipo_pagina']; ?></td>
									<td class="text-center"><a href="?rimuovi=<?php echo $s['id']; ?>" class="btn btn-danger rounded"><i class="fa fa-trash"></i></a></td>
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