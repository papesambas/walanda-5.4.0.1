<?php

namespace App\Controller\Admin;

use App\Entity\Cycles;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CyclesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cycles::class;
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
