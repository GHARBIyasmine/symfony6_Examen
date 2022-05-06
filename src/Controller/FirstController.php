<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    #[Route('/first', name: 'app_first')]
    public function index(): Response
    {
        return $this->render('first/index.html.twig', [
            'name' => 'yasmine',
            'age' => '20'
        ]);
    }
     #[Route('/first/colortab/users', name: 'colored_tab')]
public function tab(): Response{

        $tab=[
            ['firstname'=> 'nawel', 'age'=> '19'],
            ['firstname'=> 'mouna', 'age'=> '20']


        ];
        return $this->render('first/ColoredTab.html.twig',[
            'tab'=>$tab
        ]);
     }


}
