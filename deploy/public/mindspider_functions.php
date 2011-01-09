<?php
require_once 'constants.php';

function head(){
    ?>
<h1>Mindspider</h1>
    <?php
}

function foot(){
    ?>
<p>footer</p>
    <?php
}

function dbConnect(){
    mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die('test1' . mysql_error());
    mysql_select_db(DB_NAME) or die('test2' . mysql_error());
}

function getGraphs(){
    dbConnect();
    $result = mysql_query("SELECT * FROM graphs") 
    or die(mysql_error());  
    $graphs = array();
    while($row = mysql_fetch_array( $result )) $graphs[] = $row;
    return $graphs;
}

function getNodes($graphId){
    dbConnect();
    $result = mysql_query("SELECT * FROM nodes WHERE graph_id = " . $graphId)
    or die(mysql_error());
    $nodes = array();
    while($row = mysql_fetch_array( $result )) $nodes[] = $row;
    return $nodes;
}

function updateNode($data){
    dbConnect();
    $sql = sprintf('UPDATE nodes SET x_position = %d, y_position = %d where id = %d', $data['x_position'], $data['y_position'], $data['id']);
    echo $sql;
    return mysql_query($sql);
    return $sql;
}

function addNode($data){
}

function processCreateGraphForm(){
    // check for post and value on form
    // add db item
    // forward to graph page with new id
}
?>
