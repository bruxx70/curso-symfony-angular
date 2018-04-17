<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/backend")
 */
class DefaultController extends Controller
{
    /**
    * @Route("/", name="index")
    */
    public function indexAction()
    {
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
        //return $this->render('BackendBundle/Default:index.html.twig');
    }

    /**
    * @Route("/show", name="show")
    */
    public function showAction()
    {

      $em = $this->getDoctrine()->getManager();
      $usuarios = $em->getRepository('BackendBundle:Users')->findAll();
      var_dump($usuarios);die;
        return $this->render('default/show.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
        //return $this->render('BackendBundle/Default:index.html.twig');
    }
}
