<?php
//include_once ('components/com_socialrec/helpers/tablon/helper.php');

JHTML::_('behavior.mootools');
$document = &JFactory::getDocument();
//$document->addScript( 'http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js' );
//$document->addStyleSheet('components/com_socialrec/css/tablon/wall.css');

$js = '
  window.addEvent(\'load\', function() {
    initialize();
  });
';

$document->addScript( 'https://maps.google.com/maps/api/js?sensor=true' );
$document->addScript( 'components/com_incidencias/js/maps.js' );
$document->addScriptDeclaration($this->content);
$document->addStyleDeclaration("html { height: 100% } body { height: 100%; margin: 0px; padding: 0px } #map_canvas { height: 100% }");
$document->addScriptDeclaration($js);

?>

<h1><?php echo $this->prueba ?></h1>

<div id="map_canvas" style="width: 500px; height: 400px;">map div</div>
<!--<button id="drop" onclick="drop()">Drop Markers</button>!-->
<script type="text/javascript">	
	drop();
</script>