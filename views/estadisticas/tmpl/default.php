<?php

$document = &JFactory::getDocument();
$document->addScript( 'http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js' );
$document->addScript( 'components/com_incidencias/js/highcharts.js' );
$document->addStyleSheet('components/com_incidencias/css/incidencias.css');


$js = '
  window.addEvent(\'load\', function() {
    initialize();
  });
';

?>
<div class="incidencias">
<h1 align="center">Estadísticas</h1>
<script type="text/javascript"> <?php echo $this->content; ?></script>
<?php echo $this->div?>
</div>


