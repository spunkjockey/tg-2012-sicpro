<h3>Observaciones de otros:</h3>
<?php
	if($otros!=false){
	foreach ($otros as $ot): 
		?>
		<p><strong class:'etiqueta'>
			<?php echo $ot['Persona']['nombrespersona']." ".$ot['Persona']['apellidospersona'].
						" (".$ot['Observacion']['userc'].") el ".date('d/m/Y',strtotime( $ot['Observacion']['fechaingresoobservacion']))." dijo:"; 
						?>
			</strong> 
			<br>
		<?php echo $ot['Observacion']['observacioninforme']; ?><br>
		</p>
	<?php endforeach; 
}?>