<?php

namespace App\Controller\Admin;

use App\Entity\Etablissements;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class EtablissementsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Etablissements::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Etablissements')
            ->setEntityLabelInSingular('Etablissement')
            ->setSearchFields(['designation'])
            ->setDefaultSort(['createdAt' => 'DESC', 'designation' => 'ASC']);
    }


    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('designation');
        //yield SlugField::new('slug')->setTargetFieldName('designation')->hideOnIndex();
        yield ChoiceField::new('forme')->setChoices([
            'Entrepreneur individuel' => 'E.I',
            'Entreprise unipersonnelle à responsabilité limitée' => 'E.U.R.L.',
            'Société à responsabilité limitée' => 'S.A.R.L.',
            'Société anonyme' => 'S.A.',
            'Société par actions simplifiée unipersonnelle' => 'S.A.S.U.',
            'Société par actions simplifiée' => 'S.A.S',
            'Société en nom collectif' => 'S.N.C',
            'Société en commandite simple' => 'S.C.S',
            'Société en commandite par actions' => 'S.C.A'
        ]);
        yield TextareaField::new('adresse')->hideOnIndex();
        yield TextField::new('numDecisionCreation')->hideOnIndex();
        yield TextField::new('numDecisionOuverture')->hideOnIndex();
        yield DateTimeField::new('dateOuverture');
        yield TextField::new('numSocial')->hideOnIndex();
        yield TextField::new('numFiscal')->hideOnIndex();
        yield TextField::new('cpteBancaire')->hideOnIndex();
        yield TelephoneField::new('telephone');
        yield TelephoneField::new('telephoneMobile');
        yield EmailField::new('email');
        //    //TextEditorField::new('description'),
    }
}