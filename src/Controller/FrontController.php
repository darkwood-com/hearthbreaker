<?php

namespace App\Controller;

use App\Service\HSReplay;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    public function __construct(private HSReplay $hsReplay)
    {
    }

    #[Route('/', name: 'home')]
    public function index(Request $request): Response
    {
        $collection = $this->hsReplay->getCollection(
            $this->getParameter('app.region'),
            $this->getParameter('app.account'),
            $this->getParameter('app.session_id'),
        )['collection'];
        $cards = $this->hsReplay->getCards();

        $uncraft = $request->get('uncraft', false);
        if($uncraft) {
            $collection = array_filter($collection, static function($counts, $card) use ($cards) {
                if($counts[0] + $counts[1] <= 2) {
                    return false;
                }

                $card = $cards[$card];
                return !in_array($card['set'], ['CORE', 'LEGACY', 'VANILLA'], true);
            }, ARRAY_FILTER_USE_BOTH);
        }

        return $this->render('front/home.html.twig', [
            'collection' => $collection,
            'cards' => $cards,
        ]);
    }
}
