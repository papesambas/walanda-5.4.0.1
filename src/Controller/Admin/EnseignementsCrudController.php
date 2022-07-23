<?php

namespace App\Controller\Admin;

use App\Entity\Enseignements;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EnseignementsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Enseignements::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Types d\'Enseignement')
            ->setEntityLabelInSingular('Type d\'Enseignement')
            ->setSearchFields(['type', 'etablissement.designation'])
            ->setDefaultSort(['type' => 'ASC']);
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('type');
        yield AssociationField::new('etablissement');
    }
}