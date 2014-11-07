<?php 
// app/Controller/Component/SolrComponent.php
App::uses('Component', 'Controller');

class SolrComponent extends Component {
    // the other component your component uses
    //public $components = array('Existing');

    public $uses = array('User');

    public $solr_protocol = "http";
    public $solr_host = "localhost";
    public $solr_port = 8983;
    public $solr_path = "solr";
    public $solr_collection = "collection1";
    public $solr_username = "";
    public $solr_password = "";

    public function initialize(Controller $controller) {
        $this->Controller = $controller;
    }

    public function querySolr($query) {

        $query = preg_replace("/ +/", "%20", $query);
        $url = "http://" . $this->solr_host . ":" . $this->solr_port . "/" . $this->solr_path . "/" .  $this->solr_collection . "/select/?" . $query;
      
        error_log("Solr Query URL : $url");
        $result = SolrComponent::solrConnect($url);
        //error_log("Solr Query Component Result : " . $result);
        #if ( preg_match("/\"responseHeader\".*\"status\":0,\"QTime\"/", $result) ) {
            error_log("Solr Query Result : " . $result);
            return $result;
        #} else {
        #    error_log("Solr Query FAIL : " . $result);
        #    return false;
        #}
    }


    public function pushUserToSolr($user_id) {

        $options = array( 'conditions' => array ('User.id' => $user_id ), 'recursive' => 2);
        $user = $this->Controller->User->find('first', $options);

        //pr($user);

        $activity_array = array();
        if ( array_key_exists('Interest', $user)) {
            foreach ( $user['Interest'] as $interest ) {
                if ( $interest['giving'] == 1 ) {
                    array_push($activity_array, $interest['Activity']['name'] . "_G");
                }
                if ( $interest['receiving'] == 1 ) {
                    array_push($activity_array, $interest['Activity']['name'] . "_R");
                }
                if ( $interest['receiving'] == 0 && $interest['giving'] == 0 ) {
                    array_push($activity_array, $interest['Activity']['name']);
                }
            }
        }
        $likes_array = array();
        $dislikes_array = array();
        
        $birthdate = date_format(new DateTime($user['Profile']['birth_date']), 'Y-m-d\TH:i:s\Z');
        $last_login = date_format(new DateTime($user['User']['lastlogin']), 'Y-m-d\TH:i:s\Z');

        $location = "0,0";
        if ( $user['ExtendedProfile']['latitude'] && $user['ExtendedProfile']['longitude'] ) {
            $location = $user['ExtendedProfile']['latitude'] . "," . $user['ExtendedProfile']['longitude'];
        }

        $data = array(
            "add" => array(
                "doc" => array(
                    "id" => $user_id,
                    "name" => $user['User']['username'],
                    "logged_in" => $user['User']['loggedin'],
                    "scene_name" => $user['Profile']['scene_name'],
                    "birth_date" => $birthdate, // MUST BE FORMATTED PROPERLY
                    "last_login" => $last_login, // MUST BE FORMATTED PROPERLY
                    "gender_identity" => $user['ExtendedProfile']['gender_identity'], 
                    "relationship_status" => $user['ExtendedProfile']['relationship_status'], 
                    "location" => $location,
                    "activity" => $activity_array,
//                    "likes_ss" => $likes_array,
//                    "dislikes_ss => $dislikes_array,
                ),
            ),        
        );
        //pr($data);

        $url = "http://" . $this->solr_host . ":" . $this->solr_port . "/" . $this->solr_path . "/" .  $this->solr_collection . "/update/json?commit=true";
        error_log("Solr URL : $url");
        $data_string = json_encode($data);
        //error_log("Solr json data : $data_string");
        //pr($data_string);
        $result = SolrComponent::solrConnect($url,$data_string);
        //error_log("Solr Component Result : " . $result);
        if ( preg_match("/\"responseHeader\".*\"status\":0,\"QTime\"/", $result) ) {
            //error_log("Solr SUCCESS : " . $result);
            return true;
        } else {
            error_log("Solr FAIL : " . $result);
            return false;
        }
    }

    /* TODO - Make this a generic item so it can be reused */
    public function pushDataToSolr($data) {

        $url = "http://" . $this->solr_host . ":" . $this->solr_port . "/" . $this->solr_path . "/" .  $this->solr_collection . "/update/json?commit=true";

        //error_log("Solr URL : $url");
        $data_string = json_encode($data);
        //error_log("Solr json data : $data_string");
        $result = SolrComponent::solrConnect($url,$data_string);
        //error_log("Solr Component Result : " . $result);

        if ( preg_match("/\"responseHeader\".*\"status\":0,\"QTime\"/", $result) ) {
            //error_log("Solr SUCCESS : " . $result);
            return true;
        } else {
            //error_log("Solr FAIL : " . $result);
            return false;
        } 
        return false;
    }

    public function solrConnect($url, $json_data_string = null) {
        $return = 0;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//      curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//      curl_setopt($ch, CURLOPT_USERPWD ,"$username:$password");
        if ( $json_data_string ) { 
            $header = array('Content-type:application/json');
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data_string);
        } else {
            //error_log("Solr URL Only No Data Stream");
        }
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
        
        $data = curl_exec($ch);

        if (curl_errno($ch)) {
            error_log("Solr Curl Error : " . curl_error($ch));                 
            error_log("Solr Error Data   : " . $data);           
        } else {
            $return = $data;
        }
        curl_close($ch);  
        return $return;
    }
}
