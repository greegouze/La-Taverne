<?php

namespace App\Controller\Admin;

use App\Entity\Beer;
use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class BeerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Beer::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextField::new('pays'),
            TextEditorField::new('description'),
            AssociationField::new('category'),
        ];
    }
    
}
