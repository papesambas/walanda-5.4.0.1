<?php

namespace App\Controller\Admin;

use App\Entity\Categories;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class CategoriesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Categories::class;
    }


    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Catégories')
            ->setEntityLabelInSingular('Catégorie')
            ->setSearchFields(['nom', 'niveau.designation'])
            ->setDefaultSort(['nom' => 'ASC']);
    }


    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('nom');
        yield TextField::new('slug')->onlyOnIndex();
        yield TextareaField::new('description');
        yield ColorField::new('couleur');
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