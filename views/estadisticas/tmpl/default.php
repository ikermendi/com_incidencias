<?php

$document = &JFactory::getDocument();
$document->addScript( 'http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js' );
$document->addScript( 'components/com_incidencias/js/highcharts.js' );
//$document->addStyleSheet('components/com_socialrec/css/tablon/wall.css');

$js = '
  window.addEvent(\'load\', function() {
    initialize();
  });
';

/*$document->addScript( 'https://maps.google.com/maps/api/js?sensor=true' );
$document->addScript( 'components/com_incidencias/js/maps.js' );
$document->addScriptDeclaration($this->content);
$document->addStyleDeclaration("html { height: 100% } body { height: 100%; margin: 0px; padding: 0px } #map_canvas { height: 100% }");
$document->addScriptDeclaration($js);*/

?>
<script type="text/javascript"> <?php echo $this->content; ?></script>
<?php echo $this->div?>


