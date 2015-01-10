<?php

namespace FabLab\ManagerBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Admin\AdminInterface;
use Knp\Menu\ItemInterface as MenuItemInterface;

class ThicoinAdmin extends Admin
{
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('add', 'add');
    }

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {        
        $formMapper
            ->with('Configuration', array('class' => 'col-md-12'))
                ->add('info')
                ->add('endAt', 'sonata_type_datetime_picker', array('required' => false))
                ->add('currentUser')
                ->add('code', null, array('required' => false))
            ->end()
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('info')
            ->add('currentUser')
            ->add('code')
         ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('createdAt')
            ->add('endAt')
            ->add('info')
            ->add('currentUser')
            ->addIdentifier('code')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
        if (!$childAdmin && !in_array($action, array('edit'))) {
            return;
        }

        $admin = $this->isChild() ? $this->getParent() : $this;

        $id = $admin->getRequest()->get('id');

        $menu->addChild(
            'Thicoin',
           $admin->generateMenuUrl('edit', array('id' => $id))
        );

        $menu->addChild(
            'Historique',
            $admin->generateMenuUrl('fablab.thicoinowner.admin.list', array('id' => $id))
        );

    }
}
