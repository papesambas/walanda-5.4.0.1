<?php

namespace App\Controller\Admin;

use App\Entity\Classes;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class ClassesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Classes::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Classes')
            ->setEntityLabelInSingular('Classes')
            ->setSearchFields(['designation', 'niveau.designation'])
            ->setDefaultSort(['designation' => 'ASC']);
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('designation');
        yield TextField::new('slug')->onlyOnIndex();
        yield IntegerField::new('capacite');
        yield IntegerField::new('effectif');
        yield AssociationField::new('niveau');
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