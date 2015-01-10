<?php

namespace FabLab\ManagerBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Admin\AdminInterface;
use Knp\Menu\ItemInterface as MenuItemInterface;

class MachineAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {        
        $formMapper
            ->with('Configuration', array('class' => 'col-md-12'))
                ->add('name')
                ->add('priceMember', null, array('required' => false))
                ->add('priceNotMember', null, array('required' => false))
                ->add('pricePrivate', null, array('required' => false))
            ->end()
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('priceMember')
            ->add('priceNotMember')
            ->add('pricePrivate')
         ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('priceMember', 'currency', array('currency' => 'EUR'))
            ->add('priceNotMember', 'currency', array('currency' => 'EUR'))
            ->add('pricePrivate', 'currency', array('currency' => 'EUR'))
        ;
    }
}
