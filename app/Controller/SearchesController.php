<?php

App::uses('AppController', 'Controller');

class SearchesController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array('User');
    public $components = array('Session','Solr','RequestHandler');

    public function matches($id = null) {
        $this->set('matches', $this->return_matches($id)); 
    }

    public function return_matches($id = null) {
         
        $loggedInUser = $this->Session->read('Auth.User');
        $user_id = $loggedInUser['id'];

        $options = array( 'conditions' => array ('User.id' => $user_id ), 'recursive' => 2);
        $user = $this->User->find('first', $options);

        //pr($user);

        $activities_array= array();
        foreach( $user['Interest'] as $interest) {

            if ( array_key_exists('giving', $interest) && $interest['giving'] ) {
                array_push($activities_array, $interest['Activity']['name'] . "_R"); // REPLACE WITH THE OPPOSITE TO MATCH WITH THE CORRESPONDING USER
            }
            if ( array_key_exists('receiving', $interest) && $interest['receiving'] ) {
                array_push($activities_array, $interest['Activity']['name'] . "_G"); // REPLACE WITH THE OPPOSITE TO MATCH WITH THE CORRESPONDING USER
            }
            if ( ( array_key_exists('receiving', $interest) && ! $interest['receiving'] ) && (  array_key_exists('giving', $interest) && ! $interest['giving'] ) ) {
                array_push($activities_array, $interest['Activity']['name'] );
            }
        }

        $activities = "";
        foreach ( $activities_array as $activity ) {
            $activities .= "activity:$activity";
            if( end($activities_array) != $activity ) {
                $activities .= "%20OR%20";
            }
        }

        $location = "";
        if ( $user['ExtendedProfile']['latitude'] ) {
            if ( $user['ExtendedProfile']['longitude'] ) {
                $location = $user['ExtendedProfile']['latitude'] . "," . $user['ExtendedProfile']['longitude'];
            }            
        }

        $geo_query = "";
        if ( $location ) {
           $geo_query = "fq={!geofilt%20pt=$location%20sfield=location%20d=6000}&";
        }

        $query = "q=NOT%20id:$user_id%20$activities&fl=score,id,name,activity,location&" . $geo_query. "wt=json&indent=true&";

        $solr_result = $this->Solr->querySolr($query);
        //pr($solr_result);        
        return $solr_result;
    }

    public function users($string = null) {

    }

    public function connections($string = null) {

    }
}
