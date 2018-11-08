<?php
namespace App\Controller;

//use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/test/{name}", name="user", methods="get")
     */
    public function index($name, \Swift_Mailer $mailer)
    {

        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('symfony@captusite.fr')
            ->setTo('valentin@captusite.fr')
            ->setBody(
                $this->renderView(
                // templates/emails/registration.html.twig
                    'index.html.twig',
                    array('test' => 'oui', 'test2' => $name)
                ),
                'text/html'
            );

        $mailer->send($message);

        return $this->render('index.html.twig', array('test' => 'oui', 'test2' => $name));
    }
}