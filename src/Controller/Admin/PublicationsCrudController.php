<?php

namespace App\Controller\Admin;

use App\Entity\Publications;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PublicationsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Publications::class;
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
