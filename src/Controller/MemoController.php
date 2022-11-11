<?php

namespace App\Controller;

use App\Repository\MemoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MemoController extends AbstractController
{
    #[Route('/', name: 'app_memo')]
    public function index(MemoRepository $MemoRepository): Response
    {

        $memos = $MemoRepository->findNext();

        return $this->render('memo/index.html.twig', ['memos' => $memos]);
    }
}
