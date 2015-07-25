<?php

namespace Darkwood\HearthbreakerBundle\Services;

use Darkwood\HearthbreakerBundle\Entity\DeckCard;
use Darkwood\HearthbreakerBundle\Entity\Card;
use Darkwood\HearthbreakerBundle\Entity\Deck;
use Doctrine\ORM\EntityManager;
use Darkwood\HearthbreakerBundle\Repository\DeckCardRepository;

class DeckCardService
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var CacheService
     */
    private $cacheService;

    /**
     * @var DeckCardRepository
     */
    private $deckCardRepository;

    /**
     * @param EntityManager $em
     * @param CacheService  $cacheService
     */
    public function __construct(EntityManager $em, CacheService $cacheService)
    {
        $this->em = $em;
		$this->deckCardRepository = $em->getRepository('HearthbreakerBundle:DeckCard');
        $this->cacheService = $cacheService;
    }

    /**
     * Save a deckCard.
     *
     * @param DeckCard $deckCard
     */
    public function save(DeckCard $deckCard)
    {
        $this->em->persist($deckCard);
        $this->em->flush();
    }

    /**
     * Remove one deckCard.
     *
     * @param DeckCard $deckCard
     */
    public function remove(DeckCard $deckCard)
    {
        $this->em->remove($deckCard);
        $this->em->flush();
    }

    /**
     * @param Deck $deck
     * @param Card $card
     * @return null|DeckCard
     */
    public function findByDeckAndCard($deck, $card)
    {
        if(!$deck->getId() || !$card->getId()) return null;

        return $this->deckCardRepository->findOneBy(array('deck' => $deck, 'card' => $card));
    }
}
