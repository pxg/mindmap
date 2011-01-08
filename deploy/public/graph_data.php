<?php
require_once 'mindspider_functions.php';
$graph_id = $_GET['id'];
$nodes = getNodes($graph_id);
echo json_encode($nodes);