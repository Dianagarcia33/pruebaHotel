<?php 

    class Config{

        public function __construct(){
         
        }


            public function consultar(){
              //     $apiKey = 'mpqfutedsbz583qaryjz74sa';
            //$Secret = 'wDU5fsXg2P';
           // $apiKey = "5vd4hx4m7twegykbb24v9aps";
            //$Secret = "UQgAQGXXUD";
               $apiKey = 'x4snycwk7rzrezqjxya3esus';
    $Secret = 'suMb6YAGXk';
            $signature = hash("sha256", $apiKey.$Secret.time());
           // $endpoint = "https://api.test.hotelbeds.com/hotel-content-api/1.0/locations/destinations?&content=cali&fields=all&";
            $endpoint = "https://api.test.hotelbeds.com/hotel-content-api/1.0/hotels?fields=all&language=ENG&from=125&to=250&destinationCode=MZL";
           


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
                      //  $data = json_decode($resp);
                        $data = json_decode(json_encode($resp));
                        print_r($data);
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