<?php

include('profiler/main.php');

include('inc/header.php'); ?>

            
            <div class="container d-flex h-100" style="align-items:center">
				<div class="col-8 m-auto">
					<?php if(isset($_GET["new"])){ 
						
						if(isset($_POST['tipologia'])){
							$risultato = aggiungiInterazione();
							echo alert($risultato[0], $risultato[1]);
						}
						?>
						<div class="steps">
							<form method="post">
							<input type="hidden" name="tipologia" value="1"/>

								<div class="cro_step-1">
									<div class="row">
										<div class="col">
											<input type="text" name="nome_filtro" class="form-control mb-3" placeholder="Nome filtro"/>
                                            <button class="float-right btn btn-primary cro_gotostep2" type="button">Avanti <i class="fa fa-arrow-alt-circle-right fa-lg"></i></button>
											<button class="float-right btn btn-secondary cro_back_to_table mr-2" type="button"><i class="fa fa-arrow-alt-circle-left fa-lg"></i> Indietro</button>
										</div>
									</div>
								</div>
							</div>

								<div class="cro_step-2" style="display:none">

								<div class="row text-center">
									<div class="col">
                                       <select name='id_sezione' class="form-control mb-3">
                                                <?php 
                                                    $sezioni  = sezioniDelSitoDB();
                                                    foreach($sezioni as $sezione){
                                                        echo "<option value='".$sezione['id']."'>".$sezione['nome']."</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
									</div>
									<div class="row">
										<div class="col">
                                            Compila una o più regole<br/><br/>
                                            <input type="checkbox" name='checkboxvar[]' value="1"/> Mostra agli utenti con <input class="form-control d-inline" name='checkboxval[]' style="width:50px" type="text" placeholder="N°"/> visite<br/>
                                            <input type="checkbox" name='checkboxvar[]' value="2"/> Mostra agli utenti che non visitano il sito da <input class="form-control d-inline" name='checkboxval[]' style="width:50px" type="text" placeholder="N°"/> giorni<br/>
											<button class="float-right btn btn-primary cro_gotostep3" type="button">Avanti <i class="fa fa-arrow-alt-circle-right fa-lg"></i></button>
											<button class="float-right btn btn-secondary cro_backtostep1 mr-2" type="button"><i class="fa fa-arrow-alt-circle-left fa-lg"></i> Indietro</button>
                                        </div>
									</div>
								</div>

								<div class="cro_step-3 text-center" style="display:none">
                                    <input type="hidden" name="tipo_interazione" value="0">
									<div class="row text-center text-dark h5">
										<div class="col text-right">
											<div class="header pointer border d-inline-block p-5 rounded" data-toggle="tooltip" title="Header" data-placement="bottom">
												 <img src="header.png" width="90">
												 <br><span class="mt-2 text-center d-block">Header</span>
											</div>
										</div>
										<div class="col text-left">
											<div class="popup pointer border d-inline-block p-5 rounded" data-toggle="tooltip" title="Popup" data-placement="bottom">
												 <img src="popup.png" width="90">
												 <br><span class="mt-2 text-center d-block">Popup</span>
											</div>
										</div>
									</div>
									<button class="btn btn-secondary cro_backtostep2 mr-2 mt-1" type="button"><i class="fa fa-arrow-alt-circle-left fa-lg"></i> Indietro</button>
								</div>
                                
								<div class="cro_step-4" style="display:none">
									<div class="row">
										<div class="col">
											<textarea name="testo_interazione" placeholder="Contenuto html" rows="5" class="form-control mb-3"></textarea>
											<button class="float-right btn btn-primary gotostep3" type="submit">Fine <i class="fas fa-check fa-lg"></i></button>
											<button class="float-right btn btn-secondary cro_backtostep3 mr-2" type="button"><i class="fa fa-arrow-alt-circle-left fa-lg"></i> Indietro</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					<?php } else {
						if(isset($_GET['rimuovi']))
							if(rimuoviCRODB($_GET['rimuovi']))
								header("location:?success");

						if(isset($_GET['success']))
							echo alert("success", "Interazione eliminata con successo!");

						$interazioni = visualizzaInterazioni();
					?>

						<a href="?new" class="btn btn-primary float-right mb-3"><i class="fa fa-plus-circle fa-lg"></i> Nuovo</a>
						<div class="clearfix"></div>
						<table class="table table-striped table-bordered table-responsive" id="table_id">
							<thead>
								<tr class="font-weight-bold">
									<th width="15%">URL Sezione</th>
									<th width="10%">Nome Sezione</th>
									<th width="10%">Tipo filtro</th>
									<th width="5%">Valore filtro</th>
									<th width="20%">Testo interazione</th>
									<th width="10%">Tipo interazione</th>
									<th width="10%">Azione</th>
								</tr>
							</thead>
							<tbody>

							<?php while($i = $interazioni->fetch_assoc()){ ?>
								<tr>
									<td><?php echo $i['url']; ?></td>
									<td><?php echo $i['snome']; ?></td>
									<td><?php echo $i['fnome']; ?></td>
                                    <td><?php echo $i['valore_filtro']; ?></td>
									<td><?php echo $i['testo_interazione']; ?></td>
									<td><?php echo $i['tnome']; ?></td>
									<td class="text-center"><a href="?rimuovi=<?php echo $i['iid']; ?>" class="btn btn-danger rounded"><i class="fa fa-trash"></i></a></td>
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