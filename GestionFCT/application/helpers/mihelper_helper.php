<?php

// function to geocode address, it will return false if unable to geocode address
function geocode($address)
{
    //si no hay dirección en eventos nuevos por defecto será España
    if(strlen($address)==0)$address="España";
    
    // url encode the address
    $address = urlencode($address);
    
    // google map geocode api url
    $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key=AIzaSyC7ARrETKonBt7eXq9MYlF5v2UIOeatYUg";
    
    // get the json response
    $resp_json = file_get_contents($url);
    
    // decode the json
    $resp = json_decode($resp_json, true);
    
    // response status will be 'OK', if able to geocode given address
    if ($resp['status'] == 'OK') {
        
        // get the important data
        $lati = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : "";
        $longi = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : "";
        $formatted_address = isset($resp['results'][0]['formatted_address']) ? $resp['results'][0]['formatted_address'] : "";
        
        // verify if data is complete
        if ($lati && $longi && $formatted_address) {
            
            // put the data in the array
            $data_arr = array();
            
            array_push($data_arr, $lati, $longi, $formatted_address);
            
            return $data_arr;
        } else {
            return false;
        }
    }
    else {
        echo "<strong>ERROR: {$resp['status']}</strong>";
        return false;
    }
}

function session_start_seguro() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}

function verificarLogin(){
    session_start_seguro();
    if(!isset($_SESSION['user'])){
        redirect(base_url());
        //redirect(base_url().'home/index');
        //header('Location: '.base_url().'home/login');
    }
}

?>