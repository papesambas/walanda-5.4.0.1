<?php

namespace App\EventListener;

use App\Entity\Niveaux;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Security;
use function PHPUnit\Framework\throwException;

use Symfony\Component\String\Slugger\SluggerInterface;

class niveauxEntityListener
{

    public function __construct(Security $security, SluggerInterface $Slugger)
    {
        $this->Securty = $security;
        $this->Slugger = $Slugger;
    }

    public function prePersist(Niveaux $niveau, LifecycleEventArgs $arg): void
    {
        $user = $this->Securty->getUser();
        /*if ($user === null) {
            throw new \LogicException('User cannot be null here ...');
        }*/

        $niveau
            //->setCreatedAt(new \DateTimeImmutable('now'))
            ->setSlug($this->getNiveauxSlug($niveau));
    }

    private function getNiveauxSlug(Niveaux $niveau): string
    {
        $slug = mb_strtolower($niveau->getDesignation() . '-' . time(), 'UTF-8');
        return $this->Slugger->slug($slug);
    }
}