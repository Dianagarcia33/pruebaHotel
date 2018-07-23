<?php 

    class Config{
        private $inicio=0;
        private $fin=0; 

        public function __construct(){
        }


    public function consultarDestino($dato){
        //$apiKey = 'mpqfutedsbz583qaryjz74sa';
        //$Secret = 'wDU5fsXg2P';
        //$apiKey = "nfpx65hc8qh6dtqkq37gxm3x";
        //$Secret = "RY8ehQ8cUs";
        $apiKey = 'x4snycwk7rzrezqjxya3esus';
        $Secret = 'suMb6YAGXk';
        //$apiKey = "wpedjqjwv62vh84wze8srbqv";
        //$Secret = "AqWSXwmaN9";
        $signature = hash("sha256", $apiKey.$Secret.time());
        //$endpoint = "https://api.test.hotelbeds.com/hotel-content-api/1.0/locations/destinations?&content=cali&fields=all&";
        //$endpoint = "https://api.test.hotelbeds.com/hotel-content-api/1.0/locations/destinations?fields=Columbia&countryId=US&language=ENG&from=1&to=100";
        //$endpoint = "https://api.test.hotelbeds.com/hotel-content-api/1.0/locations/destinations?fields=all&language=ENG&from=1&to=100&Code=Manizales";
        //$endpoint = "https://api.test.hotelbeds.com/hotel-content-api/1.0/hotels?fields=all&language=ENG&from=10&to=100";
        //$endpoint = "https://api.test.hotelbeds.com/hotel-api/1.0/bookings?start=2015-09-10&end=2015-09-15&filterType=CREATION&status=CONFIRMED&from=1&to=25";
        $resultado="";
        do{
            $resultado="";
            $this->fin+=10;
            $this->inicio=$this->fin-9;
            echo "inicio ".$this->inicio." fin ".$this->fin;
            $endpoint = "https://api.test.hotelbeds.com/hotel-content-api/1.0/locations/destinations?fields=all&language=ENG&from=".$this->inicio."&to=".$this->fin;
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
                            
                            print_r("size ".count($datapost->destination['datos']));
                            for ($i=0; $i < count($datapost->destination['datos']) ; $i++) { 
                                if (strpos($datapost->destination['datos'][$i]['name']['content'], $dato) !== false) {
                                    $resultado.=$datapost->destination['datos'][$i]['name']['content']."<br/>";
                                }
                            }
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
        }while ($resultado=="");
        print_r($resultado);

    }



    public function consultarHotel(){
        $apiKey = 'mpqfutedsbz583qaryjz74sa';
        $Secret = 'wDU5fsXg2P';
        print_r($_POST);
        //$apiKey = "nfpx65hc8qh6dtqkq37gxm3x";
        //$Secret = "RY8ehQ8cUs";
        //$apiKey = 'x4snycwk7rzrezqjxya3esus';
        //$Secret = 'suMb6YAGXk';
        $signature = hash("sha256", $apiKey.$Secret.time());
        //$endpoint = "https://api.test.hotelbeds.com/hotel-content-api/1.0/locations/destinations?&content=cali&fields=all&";
        //$endpoint = "https://api.test.hotelbeds.com/hotel-content-api/1.0/locations/destinations?fields=Columbia&countryId=US&language=ENG&from=1&to=100";
        $endpoint = "https://api.test.hotelbeds.com/hotel-content-api/1.0/locations/destinations?fields=all&language=ITA&from=125&to=250";
        //$endpoint = "https://api.test.hotelbeds.com/hotel-content-api/1.0/locations/destinations?fields=all&language=ENG&from=1&to=100&Code=Manizales";
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
                        //return $resp;
                        //$datapost = new stdClass();
                        //$datapost = array('checkIn'=>$resp['stay']['checkIn'], 'checkOut'=>$resp['stay']['checkOut']);
                        /*$datapost->occupancies = array(
                            array('rooms'=>$data['occupancies'][0]['rooms'], 'adults'=>$data['occupancies'][0]['adults'], 'children'=>$data['occupancies'][0]['children'], 'paxes'=>array(
                            //array('type'=>'AD','age'=>30),
                            //array('type'=>'AD','age'=>30)
                        )));*/
                        //$datapost->destination = array('datos'=>$data['hotels']);
                        print_r($data);
                        //$datapost->hotels = array('hotel'=>$data['hotels']['hotel']);
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
    }

}
 
?>