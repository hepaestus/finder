    <h4>Reputation Summary</h4>
    <?php if (! empty($reputationSummary) ): ?>
      <ul>
      <?php 
          echo "<li>Average Reputation: " . $reputationSummary['Average'] . "</li>"; 
          if ( $reputationSummary['Average']       >  2 ) { echo "<li>People Seem To <strong>Really</strong> Like " . $reputationSummary['Username'] . "! " . ucfirst($reputationSummary['Username']) . " is Awesome!</li>";
          } else if( $reputationSummary['Average'] >  1 ) { echo "<li>People Seem To Think " . $reputationSummary['Username'] . " is great!</li>";
          } else if( $reputationSummary['Average'] >  0 ) { echo "<li>People Seem To Like " . $reputationSummary['Username'] . "!</li>"; 
          } else if( $reputationSummary['Average'] > -1 ) { echo "<li>People Seem To be indifferent towards " . $reputationSummary['Username'] . ".</li>";  
          } else if( $reputationSummary['Average'] > -2 ) { echo "<li>People Seem To Not Like " . $reputationSummary['Username'] . " Very Much.</li>"; 
          } else if( $reputationSummary['Average'] > -3 ) { echo "<li>People Seem To Not Like " . $reputationSummary['Username'] . " At All.</li>";  
          } else { echo "<li>People Seem To Really Dislike " . $reputationSummary['Username'] . ". Maybe " . $reputationSummary['Username'] . " could use some counseling?</li>"; 
          }
      ?>
      </ul>
      <br/>
    <?php else: ?>
      <ul><li>This user has no reputation.</li></ul>
      <br/>
    <?php endif; ?>
