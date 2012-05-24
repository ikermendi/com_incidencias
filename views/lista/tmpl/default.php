<?php
//include_once ('components/com_socialrec/helpers/tablon/helper.php');

JHTML::_('behavior.mootools');
$document = &JFactory::getDocument();
$document->addStyleSheet('components/com_incidencias/css/incidencias.css');

?>
<div class="incidencias">
<h1 align="center">Lista de incidencias</h1>
	<?php foreach($this->listaIncidencias as $incidencias){?>
		
			<div class="incidencia">
			<table>
				<tr>
					<td><b>Estado: </b></td>
					<?php if ($incidencias->estado == 'abierto') {?>
							<td class="verde">
						<?php }	else{ ?>
							<td class="rojo">
					<?php }?>
					<?php echo $incidencias->estado;?></td>
				</tr>
				<tr>
					<td><b>Descripcion: </b></td><td class="estilo_columna"><?php echo $incidencias->descripcion;?></td>
				</tr>
				<tr>
					<td><b>Fecha: </b></td><td class="estilo_columna"><?php echo $incidencias->fecha;?></td>
				</tr>
				<tr>
					<td><b>Hora: </b></td><td class="estilo_columna"><?php echo $incidencias->hora;?></td>
				</tr>
			</table>
			</div>
		
	<?php } ?>
	</div>	