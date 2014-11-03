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
                array_push($activities_array, $interest['Activity']['name'] . "_G");
            }
            if ( array_key_exists('receiving', $interest) && $interest['receiving'] ) {
                array_push($activities_array, $interest['Activity']['name'] . "_R");
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

        $query = "q=$activities&fl=score,id,name&wt=json&indent=true&";

        $solr_result = $this->Solr->querySolr($query);
        //pr($solr_result);        
        return $solr_result;
    }

    public function users($string = null) {

    }

    public function connections($string = null) {

    }
}
