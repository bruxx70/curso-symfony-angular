<?php

namespace AppBundle\Services;



class HelperService
{
  public $manager;


  public function __construct($manager)
  {
    $this->manager = $manager;
  }



  public function json($data='')
  {
    $normalizers = array(new \Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer());//Symfony\Component\Serializer\Normalizer\
    $encoders = array("json" => new \Symfony\Component\Serializer\Encoder\JsonEncoder());
    $serializer = new \Symfony\Component\Serializer\Serializer($normalizers,$encoders);

    $json = $serializer->serialize($data, 'json');

    $response = new \Symfony\Component\HttpFoundation\Response();
    $response->SetContent($json);
    $response->headers->set('Content-Type', 'application/json');

    return $response;
  }
}



 ?>
