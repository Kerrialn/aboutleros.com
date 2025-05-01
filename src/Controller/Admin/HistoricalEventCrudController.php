<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\HistoricalEvent;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class HistoricalEventCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return HistoricalEvent::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            TextareaField::new('description'),
            TextField::new('location'),
            DateTimeField::new('startAt'),
            DateTimeField::new('endAt')->setRequired(false),
            CollectionField::new('images')
                ->useEntryCrudForm(HistoricalEventImageCrudController::class)
                ->setEntryIsComplex(true)
                ->setFormTypeOption('by_reference', false)
                ->onlyOnForms(),
        ];
    }
}
