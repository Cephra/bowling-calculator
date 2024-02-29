<?php

namespace App\Controller;

use App\Form\Type\BowlingGameType;
use App\Model\BowlingGame;
use App\Service\BowlingCalculator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BowlingController extends AbstractController
{
    #[Route(path: '/', name: 'index_route')]
    public function indexAction(Request $request, BowlingCalculator $calculator)
    {
        $form = $this->createForm(BowlingGameType::class, new BowlingGame());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $score = $calculator->calculate($data);
        }

        return $this->render('index.html.twig', [
            'form' => $form,
            'result' => $score ?? 0,
        ]);
    }
}
