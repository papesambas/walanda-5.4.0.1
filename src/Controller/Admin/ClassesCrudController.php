<?php

namespace App\Controller\Admin;

use App\Entity\Classes;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ClassesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Classes::class;
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
