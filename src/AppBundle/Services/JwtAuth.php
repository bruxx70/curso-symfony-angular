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



  public function __construct($manager)
  {
    $this->manager = $manager;

  }


  public function singup($email, $password)
  {
    // var_dump($this->manager);
    // die();
    // var_dump("AWASDASDSDASD");die;
    $user = $this->manager->getRepository('BackendBundle:Users')->findOneBy(array("email" => $email, "password" => $password));

    if(is_object($user))
    {
      //generar token jwt
      $data = array('status' => 'success','user' => $user );
    }else {
      $data = array('status' => 'error','data' => 'login failed' );
    }
    return $data;
  }

}


 ?>
