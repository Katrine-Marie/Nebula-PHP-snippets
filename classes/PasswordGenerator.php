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
      
    }
    
    public function returnNewPassword(){
    }

  }
