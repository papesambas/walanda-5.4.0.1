<?php

namespace App\Controller\Admin;

use App\Entity\Niveaux;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class NiveauxCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Niveaux::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Niveaux')
            ->setEntityLabelInSingular('niveau')
            ->setSearchFields(['designation', 'cycle.designation'])
            ->setDefaultSort(['designation' => 'ASC']);
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('designation');
        yield TextField::new('slug')->onlyOnIndex();
        yield AssociationField::new('cycle');
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