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
     * @Route("/admin1")
     */
    public function adminAction()
    {
        return new Response('<html><body>HELLO ADMIN page!</body></html>');
    }

    /** 
   * @Route("/mailsample/send", name="mail_sample_send") 
    */ 
    public function MailerSample($name="TEST MAIL", \Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('send@example.com')
            ->setTo('phong2018@gmail.com')
            ->setBody(
                $this->renderView(
                    // app/Resources/views/emails/registration.html.twig
                    'emails/registration.html.twig',
                    ['name' => $name]
                ),
                'text/html'
            )

            // you can remove the following code if you don't define a text version for your emails
            ->addPart(
                $this->renderView(
                    'emails/registration.html.twig',
                    ['name' => $name]
                ),
                'text/plain'
            )
        ;

        $mailer->send($message);

        // or, you can also fetch the mailer service this way
        // $this->get('mailer')->send($message);

        return new Response('<html><body>HELLO ADMIN page!</body></html>');
    }
}