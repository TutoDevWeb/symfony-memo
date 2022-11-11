<?php

namespace App\Controller;

use App\Entity\Memo;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MemoController extends AbstractController
{
    #[Route('/', name: 'app_memo')]
    public function index(ManagerRegistry $doctrine): Response
    {

        $em = $doctrine->getManager();
        $repo = $em->getRepository(Memo::class);

        $memo = $repo->find(1);

        return $this->render('memo/index.html.twig');
    }
}
