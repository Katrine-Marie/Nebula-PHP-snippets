<?php

	class Curl{
		
		public function get($rest_url){
			$ch = curl_init($rest_url);
			
			curl_setopt($ch, CURLOPT_HTTPGET, true);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				"Accept: application/json",
				"Content-Type: application/json"
			));
			
			$apiResult = curl_exec($ch);
			
			curl_close($ch);
			
			return $apiResult;
		}
		
		public function post($restURL, $jsonFieldsString){
        //open connection
        $ch = curl_init();
        //set the url, POST JSON formatted data
        curl_setopt($ch, CURLOPT_URL, $restURL);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonFieldsString);
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Accept: application/json",
            "Content-Type: application/json",
            "Content-Length: " . strlen($jsonFieldsString)
        ));
        //execute post
        $result = curl_exec($ch);

        //close connection
        curl_close($ch);
        
        return $result;
    }
		
		public function delete($url){
			$ch = curl_init();
			
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Accept: application/json",
            "Content-Type: application/json"
        ));
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			
			$result = curl_exec($ch);
			
			curl_close($ch);

			return $result;
		}
		
		public function put($url, $jsonFieldsString){
			$ch = curl_init();
			
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Accept: application/json",
            "Content-Type: application/json",
            "Content-Length: " . strlen($jsonFieldsString)
        ));
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
			curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonFieldsString);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			
			$result  = curl_exec($ch);
			
			curl_close($ch);
			
			return $result;
		}
		
	}

