<?php

namespace App\EventListener;

use App\Entity\Classes;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Security;
use function PHPUnit\Framework\throwException;

use Symfony\Component\String\Slugger\SluggerInterface;

class classesEntityListener
{

    public function __construct(Security $security, SluggerInterface $Slugger)
    {
        $this->Securty = $security;
        $this->Slugger = $Slugger;
    }

    public function prePersist(Classes $classes, LifecycleEventArgs $arg): void
    {
        $user = $this->Securty->getUser();
        /*if ($user === null) {
            throw new \LogicException('User cannot be null here ...');
        }*/

        $classes
            //->setCreatedAt(new \DateTimeImmutable('now'))
            ->setSlug($this->getClassesSlug($classes));
    }

    private function getClassesSlug(Classes $classes): string
    {
        $slug = mb_strtolower($classes->getDesignation(), 'UTF-8');
        return $this->Slugger->slug($slug);
    }
}