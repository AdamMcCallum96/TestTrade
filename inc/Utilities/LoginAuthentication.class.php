


<?php



 class LoginAuthentication {


    static function login($email, $password){

        UserDAO::initialize();
        if($email != NULL && $password != NULL){
            $result = UserDAO::getUserPass($email, $password);
            return $result;

            
        }
        
    }

    static function validate(){

    }
}





?>