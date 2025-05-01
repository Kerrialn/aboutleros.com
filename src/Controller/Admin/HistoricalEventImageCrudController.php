<?php

namespace App\Controller\Admin;

use App\Entity\HistoricalEventImage;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class HistoricalEventImageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return HistoricalEventImage::class;
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
                ->setBasePath('/uploads/historical_event_images')
                ->onlyOnIndex(),
        ];
    }
}
