<?php

namespace AppBundle\Services;
use Doctrine\ORM\EntityManager;

use Firebase\JWT\JWT;

/**
 *
 */
class JwtAuth
{
  public $manager;
  public $key;



  public function __construct($manager)
  {
    $this->manager = $manager;
    $this->key = "19030324";

  }


  public function singup($email, $password, $getHash = null)
  {
    // var_dump($this->manager);
    // die();
    // var_dump("AWASDASDSDASD");die;
    $user = $this->manager->getRepository('BackendBundle:Users')->findOneBy(array("email" => $email, "password" => $password));

    if(is_object($user))
    {

      $token = array("sub" => $user->getId(),
                     "email" => $user->getEmail(),
                     "name" => $user->getName(),
                     "surname" => $user->getSurname(),
                     "iat" => time(),
                     "exp" => time() + 7 * 24 * 60 * 60
                   );

     $jwt = JWT::encode($token,$this->key, 'HS256');
     $decoded = JWT::decode($jwt, $this->key, ['HS256']);

     if (is_null($getHash)) {
       $data = $jwt;
     }else {
       $data = $decoded;
     }
    }else {
      $data = array('status' => 'error','data' => 'login failed' );
    }
    return $data;
  }

  public function checkToken($jwt,$getIdentity = false)
  {
    $auth = false;
    try {
        $decoded = JWT::decode($jwt,$this->key, ['HS256']);
    } catch (\UnexpectedValueException $e) {
      $auth = false;
    }catch(\DomainException $e){
      $auth = false;
    }

    if(is_object($decoded) && isset($decoded->sub)){
      $auth = true;
    }

    if($getIdentity == false)
      return $auth;
    else
      return $decoded;


  }

}


 ?>
