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


  public function singup($email, $password)
  {
    // var_dump($this->manager);
    // die();
    // var_dump("AWASDASDSDASD");die;
    $user = $this->manager->getRepository('BackendBundle:Users')->findOneBy(array("email" => $email, "password" => $password));

    if(is_object($user))
    {

      $token = array("sub" => $used->getId(),
                     "email" => $used->getEmail(),
                     "name" => $used->getName(),
                     "surname" => $used->getSurname()
                     "iat" => time()
                     "exp" => time() + 7 * 24 * 60 * 60
                   );

     JWT::encode($token,$this->key);


      $data = array('status' => 'success','user' => $user );
    }else {
      $data = array('status' => 'error','data' => 'login failed' );
    }
    return $data;
  }

}


 ?>
