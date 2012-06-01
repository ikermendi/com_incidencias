<?php
//include_once ('components/com_socialrec/helpers/tablon/helper.php');

JHTML::_('behavior.mootools');
$document = &JFactory::getDocument();
$document->addStyleSheet('components/com_incidencias/css/incidencias.css');

?>
<div class="incidencias">
<h1 align="center">Configuración dispositivo</h1>
		<form name="input" action="index.php" method="get">
			<input type="hidden" name="option" value="com_incidencias" />
			<input type="hidden" name="view" value="config" />
			<input type="hidden" name="action" value="safe" />
			<input type="hidden" name="disp" value="<?php echo $this->disp->iddispositivo;?>" />
			<div class="incidencia">
			<table>
				<tr>
					<td><b>ID: </b></td><td class="estilo_columna"><?php echo $this->disp->iddispositivo;?></td>
				</tr>
				<tr>
					<td><b>IP: </b></td><td class="estilo_columna"><?php echo $this->disp->ip;?></td>
				</tr>
				<tr>
					<td><b>Tiempo espera: </b></td><td class="estilo_columna"><input type="text" name="time" value="<?php echo $this->disp->tiempo_espera;?>"/></td>
				</tr>
				<tr>
					<td><b>IP WebService: </b></td><td class="estilo_columna"><input type="text" name="serverip" value="<?php echo $this->disp->ip_ws;?>"/></td>
				</tr>
				<tr>
					<td class="estilo_columna"><input type="submit" value="Cambiar" /></td>
				</tr>
			</table>
			</div>
	
	</div>
	</form>
	