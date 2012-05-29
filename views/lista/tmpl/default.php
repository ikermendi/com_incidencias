<?php
//include_once ('components/com_socialrec/helpers/tablon/helper.php');

JHTML::_('behavior.mootools');
$document = &JFactory::getDocument();
$document->addStyleSheet('components/com_incidencias/css/incidencias.css');

?>
<div class="incidencias">
<h1 align="center">Lista de incidencias</h1>
	<?php if(count($this->listaIncidencias) > 0) {?>
	<?php foreach($this->listaIncidencias as $incidencias){?>
		
			<div class="incidencia">
			<table>
				<tr>
					<td><b>Estado: </b></td>
					<?php if ($incidencias->estado == 'abierto') {?>
							<td class="rojo">
						<?php }	else{ ?>
							<td class="verde">
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
				<tr>
					<td><b>Mapa</b></td><td class="estilo_columna"><a href="index.php?option=com_incidencias&view=mapadisp&disp=<?php echo $incidencias->iddispositivo;?>">Link</a></td>
				</tr>
				<?php if($incidencias->estado === "abierto") {?>
				<tr>
				<td><b>Cerrar incidencia:</b></td><td class="estilo_columna"><a href="index.php?option=com_incidencias&view=lista&task=cerrar&id=<?php echo $incidencias->idincidencia?>&disp=<?php echo $incidencias->iddispositivo?>">Cerrar</a></td>
				</tr>
				<?php }?>
			</table>
			</div>
		
	<?php } 
	} else {?>
		No se han encontrado incidencias.
	<?php }?>
	</div>