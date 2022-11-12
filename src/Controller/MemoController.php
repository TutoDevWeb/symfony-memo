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

        $memos = $MemoRepository->findNextAndTagItDone();

        if (count($memos) !== 0) {
            $form = $this->createForm(TaskType::class, $memos[0]);
            return $this->renderForm('memo/index.html.twig', ['formMemo' => $form]);
        }
    }
}
