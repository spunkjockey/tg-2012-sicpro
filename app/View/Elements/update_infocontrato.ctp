<!-- /app/views/elements/update_infocontrato.ctp -->
	<?php foreach ($informacion as $inf): ?>
		<p><strong class:'etiqueta'>Nombre Contrato: </strong> <?php echo $inf['Contratoconstructor']['nombrecontrato']; ?></p>
		<p><strong class:'etiqueta'>Estado Actual: </strong><?php echo $inf['Contratoconstructor']['estadocontrato']; ?></p>
	<?php endforeach; ?>

