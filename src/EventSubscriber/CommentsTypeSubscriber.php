<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpKernel\KernelEvents;

class CommentsTypeSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::POST_SET_DATA => 'onPreSetData',
        ];
    }

    public function onPreSetData(FormEvent $Event): void
    {
        $form = $Event->getForm();
        $userRoles = $form->getConfig()->getOption('user-roles');
        if (in_array('ROLE_USER', $userRoles) === true) {
            $form->add(
                'save',
                SubmitType::class,
                [
                    'label' => 'Envoyer',
                    'attr' => [
                        'class' => 'btn btn-primary btn-sm',
                    ],
                ]
            );
        }
    }
}