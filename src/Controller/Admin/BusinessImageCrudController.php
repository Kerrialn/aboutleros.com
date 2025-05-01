<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\BusinessImage;
use App\Entity\HistoricalEvent;
use App\Entity\HistoricalEventImage;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class BusinessImageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BusinessImage::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('caption')->setRequired(false),
            IntegerField::new('position')->setRequired(false),
            Field::new('imageFile')
                ->setFormType(VichImageType::class)
                ->onlyOnForms(),
            ImageField::new('filename', 'Uploaded Image')
                ->setBasePath('/uploads/business_images')
                ->onlyOnIndex(),
        ];
    }
}
