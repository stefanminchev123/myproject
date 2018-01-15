<?php

$monuments = $this->monuments;

$document = JFactory::getDocument();
$document->addScript('components/com_monuments/js/monuments_map.js');

// echo "DEBUG ===>>><pre>" . print_r($monuments,1) . "</pre><<<==== DEBUG"; 


?>

<script async defer src="https://maps.googleapis.com/maps/api/js"></script>

<div style="height:500px;" id='monuments_map'></div>

