<?php

  class PasswordGenerator {

    public function __construct(){

    }
    
    private function generatePasswordString(){
      // Generer tekststreng
      // ASCII tal
      for($i = 48; $i <= 57; $i++){
        $allChars .= chr($i);
      }
      // ASCII store bogstaver
      for($i = 65; $i <= 90; $i++){
        $allChars .= chr($i);
      }
      // ASCII små bogstaver
      for($i = 97; $i <= 122; $i++){
        $allChars .= chr($i);
      }

      // Tilføj udvalgte specialtegn til tekststreng
      $allChars .= ".,!?#()[]=%&~^:;-_";
      
      // Bland karaktererne
      $allChars = str_shuffle($allChars);
      
      // Trim tekststreng til random antal karakterer (dog mellem 8 og 35)
      $chars = substr($allChars, 0, rand(8,35));

      return $chars;
      
    }
    
    public function returnNewPassword(){
      
      // Generer et password
      $password = $this->generatePasswordString();
      
      // Test om passwordet indeholder alle påkrævede karakterer
      if(preg_match('/[a-z][A-Z][0-9]/', $password) && preg_match('/[!]|[#-&]|[(-,]|[{-~]|[:-@]/', $password) && strlen($password) >= 8){

        return $password;

      }else {
        // Hvis password mangler en type karakterer, generer nyt password
        return $this->returnNewPassword();
      }
    }

  }
