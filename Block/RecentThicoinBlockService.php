<?php

namespace FabLab\ManagerBundle\Block;

use Sonata\BlockBundle\Block\BlockContextInterface;
use FabLab\ManagerBundle\Manager\BaseManager;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;

use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BaseBlockService;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RecentThicoinBlockService extends BaseBlockService
{
    protected $manager;

    /**
     * @param string           $name
     * @param EngineInterface  $templating
     * @param ManagerInterface $manager
     */
    public function __construct($name, EngineInterface $templating, BaseManager $manager)
    {
        $this->manager = $manager;

        parent::__construct($name, $templating);
    }

    /**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {

        
        $params = array(
            'limit' => $blockContext->getSetting('number')
        );
        $lastThicoins = $this->manager->getLast($params);
        $templatesParams = array(
            'settings'  => $blockContext->getSettings(),
            'block'     => $blockContext->getBlock(),
            'listing'   => $lastThicoins  
        );

        //var_dump($blockContext->getTemplate());die;
        return $this->renderResponse($blockContext->getTemplate(), $templatesParams, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Recent Thicoins';
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultSettings(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'number'     => 5,
            'mode'       => 'public',
            'title'      => 'Recent Thicoins',
//            'tags'      => 'Recent Posts',
            'template'   => 'FabLabManagerBundle:Block:thicoins.html.twig'
        ));
    }
}
