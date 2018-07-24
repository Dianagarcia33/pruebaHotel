<?php 

    class Config{
        private $inicio=0;
        private $fin=0; 

        public function __construct(){
        }


    public function consultarDestino($dato){
    //    $apiKey = 'mpqfutedsbz583qaryjz74sa';
      // $Secret = 'wDU5fsXg2P';
        $apiKey = "nfpx65hc8qh6dtqkq37gxm3x";
        $Secret = "RY8ehQ8cUs";
     //   $apiKey = 'x4snycwk7rzrezqjxya3esus';
       // $Secret = 'suMb6YAGXk';
       // $apiKey = "wpedjqjwv62vh84wze8srbqv";
        //$Secret = "AqWSXwmaN9";
      //  $apiKey="u6zxr3fsrvyb78gv9m3w45gp";
        //$Secret="PARcy9M4FK";
       // $apiKey="m7rw3xqh73jfrmftzt6vspd7";
        //$Secret="7yAuq2f8GA";
        //$apiKey="mpqfutedsbz583qaryjz74sa";
        //$Secret="wDU5fsXg2P";
       // $apiKey="dcbqt4fa3jzs7592hhqhdm3d";
       // $Secret="bqNxnNnTVQ";
      //  $apiKey="ddts9fx4nkd8nwdspaxbtqb9";
       // $Secret="Q6JXqyR5V9";
        $signature = hash("sha256", $apiKey.$Secret.time());
        //$endpoint = "https://api.test.hotelbeds.com/hotel-content-api/1.0/locations/destinations?&content=cali&fields=all&";
        //$endpoint = "https://api.test.hotelbeds.com/hotel-content-api/1.0/locations/destinations?fields=Columbia&countryId=US&language=ENG&from=1&to=100";
        //$endpoint = "https://api.test.hotelbeds.com/hotel-content-api/1.0/locations/destinations?fields=all&language=ENG&from=1&to=100&Code=Manizales";
        //$endpoint = "https://api.test.hotelbeds.com/hotel-content-api/1.0/hotels?fields=all&language=ENG&from=10&to=100";
        //$endpoint = "https://api.test.hotelbeds.com/hotel-api/1.0/bookings?start=2015-09-10&end=2015-09-15&filterType=CREATION&status=CONFIRMED&from=1&to=25";
        $resultado="";
        do{
            $resultado="";
            $this->fin+=1000;
            $this->inicio=$this->fin-999;
           // echo "inicio ".$this->inicio." fin ".$this->fin;
            $endpoint = "https://api.test.hotelbeds.com/hotel-content-api/1.0/locations/destinations?fields=all&language=ENG&from=".$this->inicio."&to=".$this->fin;
            $validacion=false;
            try{
                // Get cURL resource
                $curl = curl_init();
                // Set some options 
                curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $endpoint,
                CURLOPT_HTTPHEADER => ['Accept:application/json' , 'Api-key:'.$apiKey.'', 'X-Signature:'.$signature.'']));
                // Send the request & save response to $resp
                $resp = curl_exec($curl);
                // Check HTTP status code
                if (!curl_errno($curl)) {
                    switch ($http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE)) {
                        case 200:  # OK
                            $data = json_decode($resp,true);
                            //return $resp;
                            $datapost = new stdClass();
                            $datapost->destination = array('datos'=>$data['destinations']);
                            for ($i=0; $i < count($datapost->destination['datos']) ; $i++) { 
                                if (strpos($datapost->destination['datos'][$i]['name']['content'], $dato) !== false) {
                                    //$resultado.=$datapost->destination['datos'][$i]['name']['content']."<br/>";
                                    //echo json_encode(array('codigo' => $datapost->destination['datos'][$i]['code'],
                                    //'nombre'=>$datapost->destination['datos'][$i]['name']['content']));
                                    //$validacion=true;
                                    $resultado.='<a onclick="destino(\''.$datapost->destination['datos'][$i]['code'].'\',\''.$datapost->destination['datos'][$i]['name']['content'].'\');" class="list-group-item list-group-item-action" id="listDestino" data-toggle="list" href="#txtDestino" role="tab" aria-controls="profile">'.$datapost->destination['datos'][$i]['name']['content'].'</a>'.
                                    '<input type="hidden" name="txtCodigoDestino" id="txtCodigoDestino" value="'.
                                    $datapost->destination['datos'][$i]['code'].'"">'.
                                    "<br/>";
                                }
                            }
                            break;
                        default:
                            $resultado= 'Unexpected HTTP code: '. $http_code;
                            $resultado.= $resp;
                    }
                }
                // Close request to clear up some resources
                curl_close($curl);
            }catch(Exception $e){
                $resultado="Error while sending request, reason: %s\n".$e->getMessage();
            }
        }while ($resultado=="");
        echo $resultado;
    }



    public function consultarHotel($codigoDestino){
      
        
        $apiKey = "nfpx65hc8qh6dtqkq37gxm3x";
        $Secret = "RY8ehQ8cUs";
    //    print_r($_POST);
   //         $apiKey="u6zxr3fsrvyb78gv9m3w45gp";
     //   $Secret="PARcy9M4FK";
        //$apiKey = "nfpx65hc8qh6dtqkq37gxm3x";
       //  $apiKey="m7rw3xqh73jfrmftzt6vspd7";
     //   $Secret="7yAuq2f8GA";

      //  $apiKey="ddts9fx4nkd8nwdspaxbtqb9";
        //$Secret="Q6JXqyR5V9";
        //$Secret = "RY8ehQ8cUs";
        //$apiKey = 'x4snycwk7rzrezqjxya3esus';
        //$Secret = 'suMb6YAGXk';
        $signature = hash("sha256", $apiKey.$Secret.time());
        //$endpoint = "https://api.test.hotelbeds.com/hotel-content-api/1.0/locations/destinations?&content=cali&fields=all&";
        //$endpoint = "https://api.test.hotelbeds.com/hotel-content-api/1.0/locations/destinations?fields=Columbia&countryId=US&language=ENG&from=1&to=100";
        //$endpoint = "https://api.test.hotelbeds.com/hotel-content-api/1.0/locations/destinations?fields=all&language=ENG&from=125&to=250";
        $endpoint = "https://api.test.hotelbeds.com/hotel-content-api/1.0/hotels?fields=all&destinationCode=".$codigoDestino."&language=ENG&from=1&to=1000";
        //$endpoint = "https://api.test.hotelbeds.com/hotel-content-api/1.0/hotels?fields=all&language=ENG&from=10&to=100";

        //$endpoint = "https://api.test.hotelbeds.com/hotel-api/1.0/bookings?start=2015-09-10&end=2015-09-15&filterType=CREATION&status=CONFIRMED&from=1&to=25";

        try{
            // Get cURL resource
            $curl = curl_init();
            // Set some options 
            curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $endpoint,
            CURLOPT_HTTPHEADER => ['Accept:application/json' , 'Api-key:'.$apiKey.'', 'X-Signature:'.$signature.'']));
            // Send the request & save response to $resp
            $resp = curl_exec($curl);
            // Check HTTP status code
            if (!curl_errno($curl)) {

                switch ($http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE)) {
                    case 200:  # OK
                        $data = json_decode($resp,true);
                      //  print_r($data);
                            //return $resp;
                            $datapost = new stdClass();
                            $datapost->destination = array('datos'=>$data['hotels']);
                            for ($i=0; $i < count($datapost->destination['datos']) ; $i++) { 
                                    //$resultado.=$datapost->destination['datos'][$i]['name']['content']."<br/>";
                                    //echo json_encode(array('codigo' => $datapost->destination['datos'][$i]['code'],
                                    //'nombre'=>$datapost->destination['datos'][$i]['name']['content']));
                                    //$validacion=true;
                                    $resultado.='<div><a  class="list-group-item ">'.$datapost->destination['datos'][$i]['name']['content'].'</a><a  class="list-group-item list-group-item-action" id="listDestino" data-toggle="list" href="#txtDestino" role="tab" aria-controls="profile">'.$datapost->destination['datos'][$i]['description']['content'].'</a></div><br/>';

                            }
                        echo "<h1>Resultados: ".$i."</h1>";
                        //$datapost = new stdClass();
                        //$datapost = array('checkIn'=>$resp['stay']['checkIn'], 'checkOut'=>$resp['stay']['checkOut']);
                        /*$datapost->occupancies = array(
                            array('rooms'=>$data['occupancies'][0]['rooms'], 'adults'=>$data['occupancies'][0]['adults'], 'children'=>$data['occupancies'][0]['children'], 'paxes'=>array(
                            //array('type'=>'AD','age'=>30),
                            //array('type'=>'AD','age'=>30)
                        )));*/
                        //$datapost->destination = array('datos'=>$data['hotels']);
                     //   print_r($data);
                        //$datapost->filter = array('maxRooms'=>5,'minRate'=>100.000,'maxRate'=>1700.000,'maxRatesPerRoom'=>2);
                        //return $resp;
                        //print_r($datapost->destination['datos'][0]['name']['content']);
                        //print_r($datapost->destination['datos'][0]['description']['content']);
                        break;
                    default:
                        echo 'Unexpected HTTP code: ', $http_code, "\n";
                        echo $resp;
                }
            }
            // Close request to clear up some resources
            curl_close($curl);
        }catch(Exception $e){
            printf("Error while sending request, reason: %s\n",$e->getMessage());
        }
        echo $resultado;
    }

}
 
?>