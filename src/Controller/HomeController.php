<?php

namespace App\Controller;

use App\Repository\QuestionRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
  #[Route('/', name: 'home')]
  public function index(QuestionRepository $questionRepository): Response
  {
    $questions = $questionRepository->getLastQuestionsWithAuthors();
    return $this->render('home/index.html.twig', [
      'questions' => $questions
    ]);
  }
}