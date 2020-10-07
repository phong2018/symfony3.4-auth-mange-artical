<?php
// src/AppBundle/Controller/DefaultController.php
// ...
namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends Controller
{
    /**
     * @Route("/hello")
     */
    public function heloAction()
    {
        return new Response('<html><body>HELLO page!'.$this->get('translator')->trans('Symfony is great').'</body></html>');
    }

    /**
     * @Route("/admin")
     */
    public function adminAction()
    {
        return new Response('<html><body>HELLO ADMIN page!</body></html>');
    }
}