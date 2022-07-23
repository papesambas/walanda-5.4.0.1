<?php

namespace App\Controller\Admin;

use App\Entity\Users;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;

class UsersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Users::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Utilisateurs')
            ->setEntityLabelInSingular('Utilisateur')
            ->setSearchFields(['username', 'nom', 'prenom', 'etablissement.designation'])
            ->setDefaultSort(['nom' => 'ASC'], ['prenom' => 'ASC'], ['username' => 'ASC'], ['createdAt' => 'ASC']);
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('nom');
        yield TextField::new('prenom');
        yield TextField::new('username');
        yield TelephoneField::new('telephone')->hideOnIndex();
        yield EmailField::new('email')->hideOnIndex();
        yield BooleanField::new('isVerified');
        yield BooleanField::new('isActif');
        yield DateTimeField::new('iscreatedAt')->hideOnForm();
        yield AssociationField::new('etablissement');
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