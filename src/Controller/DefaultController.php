<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/default", name="default")
     *
     * I used this controller to create homepage
     */
    public function index()
    {
        return $this->render('index.html.twig');
    }
}
