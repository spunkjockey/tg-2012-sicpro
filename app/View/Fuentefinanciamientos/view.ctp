<!-- File: /app/View/Fuentefinanciamientos/view.ctp -->

<ul>
			<p><h3>Nombre Fuente:</h3><?php echo $fuentes['Fuentefinanciamiento']['nombrefuente']; ?></p>

			<p><h3>Monto Inicial: </h3><?php echo $fuentes['Fuentefinanciamiento']['montoinicial']; ?></p>

			<p><h3>Fecha de Disponibilidad:</h3><?php echo ($fuentes['Fuentefinanciamiento']['fechadisponibilidad']); ?></p>
			
			<p><h3>Tipo de Fuente:</h3><?php echo ($fuentes ['Fuentefinanciamiento']['tipofuente']); ?></p>
</ul>