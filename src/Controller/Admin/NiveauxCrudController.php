<?php

namespace App\Controller\Admin;

use App\Entity\Niveaux;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class NiveauxCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Niveaux::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
