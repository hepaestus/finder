<?php 
$matches_arr = json_decode($matches, true);
echo "<ul>\n";
foreach( $matches_arr['response']['docs'] as $doc ) {
    echo "<li>" . $this->Html->link($doc['name'], array('controller' => 'users', 'action' => 'view_match', $doc['id']));
    echo "<ul>\n";
    echo "<li>Location:" . $doc['location'] . "</li>\n";
    echo "<li>Distance:" . $doc['_dist_'] . "km</li>\n";
    echo "<li>Score:" . $doc['score'] . "</li>\n";
    echo "</ul>\n";
    echo "</li>\n";
}
echo "</ul>\n";
?>
