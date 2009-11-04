<?php

# Collectd Entropy plugin

require_once 'conf/common.inc.php';
require_once 'type/Default.class.php';

## LAYOUT
# entropy/entropy.rrd

$obj = new Type_Default;
$obj->datadir = $CONFIG['datadir'];
$obj->args = array(
	'host' => $host,
	'plugin' => $plugin,
	'pinstance' => $pinstance,
	'type' => $type,
	'tinstance' => $tinstance,
);
$obj->data_sources = array('entropy');
$obj->ds_names = array(
	'entropy' => 'Entropy bits',
);
$obj->colors = array(
	'entropy' => '0000f0',
);
$obj->width = $width;
$obj->heigth = $heigth;
$obj->seconds = $seconds;
$obj->rrd_title = "Available entropy on $host";
$obj->rrd_vertical = 'Bits';
$obj->rrd_format = '%4.0lf';

$obj->rrd_graph();

?>
