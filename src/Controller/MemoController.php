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

        $memos = $doctrine->getRepository(Memo::class)->findAll();

        return $this->render('memo/index.html.twig', ['memos' => $memos]);
    }
}
