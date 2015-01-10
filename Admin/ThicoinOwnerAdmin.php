<?php

namespace FabLab\ManagerBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class ThicoinOwnerAdmin extends Admin
{
    protected $datagridValues = array(
        '_page' => 1,            // display the first page (default = 1)
        '_sort_order' => 'DESC', // reverse order (default = 'ASC')
        '_sort_by' => 'createdAt'  // name of the ordered field
    );
    
    protected $parentAssociationMapping = 'thicoin';
    
    public function configure()
    {        
        $this->parentAssociationMapping = 'thicoin';
    }

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {        
        $formMapper
                ->add('owner')
		->add('isActive')
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('isActive')
         ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('createdAt')
            ->add('endAt')
            ->add('isActive')
            ->add('owner')
        ;
    }
    
}
