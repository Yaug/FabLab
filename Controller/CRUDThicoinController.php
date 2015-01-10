<?php

namespace FabLab\ManagerBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Sonata\AdminBundle\Controller\CRUDController as Controller;
use FabLab\ManagerBundle\Entity\Thicoin;

class CRUDThicoinController extends Controller
{
    public function addAction()
    {
        $request = $this->getRequest();

        $data = array();
        $form = $this->createForm('add_thicoins_form', $data);
        $form->handleRequest($request);

        if ($request->isMethod('POST') && $form->isValid()) {
            $data = $form->getData();
            for($i = 0; $i < $data['number']; $i++) {
                $thicoin = new Thicoin();
                $thicoin->setCurrentUser($data['targetUser']);
                $thicoin->setInfo($data['info']);
                $this->admin->create($thicoin);
            }
            $this->addFlash(
                'sonata_flash_success',
                $data['number'] . " thicoins ajoutés à l'utilisateur ".$data['targetUser']->getUsername()
            );
            return new RedirectResponse($this->admin->generateUrl('add', array()));
        }
        return $this->render(
                    'FabLabManagerBundle:CRUD:addthicoin.html.twig', array(
                    'form' => $form->createView()
               )
        );
    }
}
