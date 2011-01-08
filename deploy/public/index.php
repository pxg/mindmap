<?php
require_once 'mindspider_functions.php';
processCreateGraphForm();
head();

echo '<h2>Graphs</h2>';

$graphs = getGraphs();
echo '<ul>';
foreach($graphs as $key => $graph){
    echo '<li><a href="/graph.php?id=' . $graph['id'] .  '">'. $graph['name'] . '</a></li>';
}
echo '</ul>';
?>

<form method="post" target="">
    <input type="text" name="graph-name" id="graph-name">
    <input type="submit" value="Create Graph" />
</form>

<?php
foot();
?>