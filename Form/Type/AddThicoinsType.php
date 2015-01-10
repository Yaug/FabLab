<?php
namespace FabLab\ManagerBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class AddThicoinsType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('number', 'integer', array('required' => true, 'attr' => array('class' => 'form-control')))
                ->add('targetUser', 'entity', array(
                    'class' => 'ApplicationSonataUserBundle:User'
                 ))
		->add('info', 'text', array('required' => true, 'attr' => array('class' => 'form-control')));
    }

    public function getName()
    {
        return 'add_thicoins_form';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => null,
        ));
    }
}
