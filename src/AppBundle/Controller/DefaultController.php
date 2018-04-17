<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JSONResponse;
use AppBundle\Services\HelperService;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }


    /**
     * @Route("/login", name="login")
     * @Method("POST")
     */
    public function loginAction(Request $request)
    {
      $helper = $this->get(HelperService::class);
      $json = $request->get('json', null);

      $data = array('status' => 'error', 'data' => 'Send json via post');
      if(! is_null($json))
      {

      }else {
        # code...
      }

      return $helper->json($data);
        // replace this example code with whatever you need
    }



        /**
        * @Route("/show", name="show")
        */
        public function showAction()
        {

          $em = $this->getDoctrine()->getManager();
          $usuarios = $em->getRepository('BackendBundle:Users')->findAll();

          $helper = $this->get(HelperService::class);
          return $helper->json($usuarios);


          /*var_dump($usuarios);die;
            return $this->render('default/show.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            ]);*/
            //return $this->render('BackendBundle/Default:index.html.twig');
        }
}
