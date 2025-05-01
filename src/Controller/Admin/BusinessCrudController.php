<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Business;
use App\Entity\HistoricalEvent;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BusinessCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Business::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            TextField::new('slug'),
            ChoiceField::new('businessTypeEnum'),
            AssociationField::new('category'),
            CollectionField::new('images')
                ->useEntryCrudForm(BusinessImageCrudController::class)
                ->setEntryIsComplex(true)
                ->setFormTypeOption('by_reference', false)
                ->onlyOnForms(),
        ];
    }
}
