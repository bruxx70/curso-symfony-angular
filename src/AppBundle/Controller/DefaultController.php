<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JSONResponse;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Services\HelperService;
use AppBundle\Services\JwtAuth;


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
     * @Method("POST");
     */
    public function loginAction(Request $request)
    {
      $helper = $this->get(HelperService::class);
      $json = $request->get('json', null);

      $data = array('status' => 'error', 'data' => 'Send json via post');



       if(! is_null($json))
       {
        $params = json_decode($json);//convertimos un json a array php

        $email = (isset($params->email)) ? $params->email : null;
        $password = (isset($params->password)) ? $params->password : null;

        $emailConstraint = new Assert\Email();
        $emailConstraint->message = 'El email es invalido';
        $emailValidated = $this->get('validator')->validate($email,$emailConstraint);

        // var_dump(count($emailValidated));
        // var_dump($password);
        // die();
        if(count($emailValidated) == 0 && !is_null($password))
        {


          $jwtAuth = $this->get(JwtAuth::class);
          $singup = $jwtAuth->singup($email,$password);


          $data = array('status' => 'success', 'data' => 'Send json via post OK!', 'singup' => $singup);
          // $data = array('status' => 'success', 'data' => 'Send json via post OK!', 'singup' => "A");

        }else {
          $data = array('status' => 'error', 'data' => 'email or password invalid');
        }

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
