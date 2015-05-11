<?php 
  $matches_arr = json_decode($matches, true);
  echo "<ul data-role='listview' data-split-icon='gear' data-split-theme='a' data-inset='true'>\n";
  foreach( $matches_arr['response']['docs'] as $doc ) {
      echo "    <li data-user-id='/" . $doc['id'] . "'>\n";
      echo "        <a href='/finder/users/view/" . $doc['id'] . "' data-user-id='" . $doc['id'] . "' class='match_user_profile' data-rel='popup' data-position-to='window' data-transition='pop'>\n";
      if ( array_key_exists('image_url', $doc) ) { 
        echo "                <img src='/" . $doc['image_url'] . "' class='profile_image' alt='profile image'>\n";
      }
      echo "                <h2 class='user'>" . $doc['name']  . "</h2>\n";
      echo "                <p>Affinity Score: <span class='affinity'>" . $doc['score'] . "</span></p>\n";
      echo "                <p>Location:<span class='location'>" . $doc['location'] . "</span>, Distance: <span class='distance'>" . $doc['_dist_'] . " km</span></p>\n";
      echo "        </a>\n";
      echo "    </li>\n";
  }
  echo "    </ul>\n";
?>
