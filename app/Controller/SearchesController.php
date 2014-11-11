<?php

App::uses('AppController', 'Controller');

class SearchesController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array('User','Connection','Interest');
    public $components = array('Session','Solr','RequestHandler');

    public function matches($id = null) {
        $this->set('matches', $this->return_matches($id)); 
    }

    public function return_matches($id = null) {
         
        $loggedInUser = $this->Session->read('Auth.User');
        $user_id = $loggedInUser['id'];

        $options = array( 'conditions' => array ('User.id' => $user_id ), 'recursive' => 2);
        $user = $this->User->find('first', $options);

        $my_blocked_connections = $this->Connection->findAllByUserIdAndConnectionType($user_id, 'blocked');
        $their_blocked_connections = $this->Connection->findAllByConnectionIdAndConnectionType($user_id, 'blocked');
        $blocked_users = "";
        foreach( $my_blocked_connections as $blocked_connection ) {
            if ( ! preg_match("/NOT\+id:" . $blocked_connection['Connection']['connection_id']. "/", $blocked_users) ) {
                $blocked_users .= "NOT+id:" . $blocked_connection['Connection']['connection_id'];
            }
        }
        foreach( $their_blocked_connections as $blocked_connection ) {
            if ( ! preg_match("/NOT\+id:" . $blocked_connection['Connection']['user_id'] . "/", $blocked_users) ) {
                $blocked_users .= "+NOT+id:" . $blocked_connection['Connection']['user_id'];
            }
        }
        $blocked_users .= "";

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
            $activities .= "activity:\"$activity\"";
            if( end($activities_array) != $activity ) {
                $activities .= "+OR+";
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
           $geo_query = "fq={!geofilt}&pt=$location&sfield=location&d=6000&";
        }

        # http://wiki.apache.org/solr/SpatialSearch#How_to_boost_closest_reults
        $boost_closest = "{!boost+f=recip(geodist(),2,200,20}";

        $query = "q=" . $boost_closest . "NOT+id:$user_id%20$blocked_users%20$activities&fl=activity,score,id,name,location,_dist_:geodist()&" . $geo_query. "&sort=score%20desc&wt=json&indent=true&";

        $solr_result = $this->Solr->querySolr($query);
        //pr($solr_result);        
        return $solr_result;
    }

    public function users($string = null) {

    }

    public function connections($string = null) {

    }

/*
 * admin_reconcile_all_users
 *
 */
    public function admin_reconcile_all_users() {
       $all_users = $this->User->find('all', array('recursive' => -1));
       $result;
       foreach( $all_users as $each_user ) {
           $result .= $this->Solr->pushUserToSolr($each_user['id']);
       }
       return $result;
    }
}
