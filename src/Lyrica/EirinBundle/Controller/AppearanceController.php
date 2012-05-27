<?php

namespace Lyrica\EirinBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Lyrica\EirinBundle\Entity\Appearance;
use Lyrica\EirinBundle\Form\AppearanceRoleType;

class AppearanceController extends Controller
{
    /**
     * A form to link a role to an appearance
     */
    public function addRoleAction($app_id)
    {
        // Getting the appearance
        $em = $this->getDoctrine()->getEntityManager();
        $ar = $em->getRepository('LyricaEirinBundle:Appearance');
        $app = $ar->find($app_id);
        // Template argument
        $argts['app'] = $app;
        
        // Then the form
        $form = $this->createFormBuilder(new AppearanceRoleType, $app);
        $argts['form'] = $form->createView();
        
        // And finally render everything
        $tpl_path = 'LyricaEirinBundle:Appearance:addRole.html.twig';
        return $this->render($tpl_path, $argts);
    }
    
    /**
     * Creates a form (not its view) to delete an appearance
     * @param integer $id The appearance's id
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    /**
     * Links a role to the appearance, then forwards to the appearance's view
     */
    public function linkRoleAction()
    {
        // Request, Entity Repository
        $request = $this->get('request');
        $em = $this->getDoctrine()->getEntityManager();
        $ar = $em->getRepository('LyricaEirinBundle:Appearance');
        
        // Get the form and its data
        $form = $this->createFormBuilder(new AppearanceRoleType);
        $form->bindRequest($request);
        $data = $form->getData();
        
        // Get entities and link them
        $app = $ar->find($data['app_id']);
        $app->addRole($data['role']);
        $em->persist($app);
        $em->flush();
        
        // Finally redirect
        $opt['id'] = $data['app_id'];
        $url = $this->generateUrl('persona_show', $opt);
        return $this->redirect($url);
    }
    
    /**
     * Shows one appearance
     */
    public function showAction(Appearance $app)
    {
        $argts['entity'] = $app;
        
        $deleteForm = $this->createDeleteForm($app->getId());
        $argts['delete_form'] = $deleteForm->createView();
        
        $tpl_path = 'LyricaEirinBundle:Appearance:show.html.twig';
        return $this->render($tpl_path, $argts);
    }
}