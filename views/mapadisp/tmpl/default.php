<?php

JHTML::_('behavior.mootools');
$document = &JFactory::getDocument();

$js = '
  window.addEvent(\'load\', function() {
    initialize();
  });
';

$document->addScript( 'https://maps.google.com/maps/api/js?sensor=true' );
$document->addScript( 'components/com_incidencias/js/maps.js' );
$document->addScriptDeclaration($this->content);
$document->addStyleDeclaration("html { height: 100% } body { height: 100%; margin: 0px; padding: 0px } #map_canvas { height: 100%; width:100% }");
$document->addScriptDeclaration($js);

?>

<h1>Dispositivos</h1>
<center>
	<br><br>
<div id="map_canvas" style="width: 500px; height: 400px;">map div</div>
</center>
<!--<button id="drop" onclick="drop()">Drop Markers</button>!-->
<script type="text/javascript">	
	drop();
</script>