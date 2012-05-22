<?php

namespace Lyrica\EirinBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Lyrica\EirinBundle\Entity\Appearance;

class AppearanceController extends Controller
{
    /**
     * Links a role to the appearance
     */
    public function addRoleAction($app_id)
    {
        // Getting the appearance
        $em = $this->getDoctrine()->getEntityManager();
        $ar = $em->getRepository('LyricaEirinBundle:Appearance');
        $app = $ar->find($app_id);
        // Template argument
        $argts['app'] = $app;
        
        // Role options (form)
        $opt['class'] = 'LyricaEirinBundle:Role';
        $opt['empty_value'] = false;
        $opt['query_builder'] =
            function(EntityRepository $er)
            {
                return $this->createQueryBuilder('r')
                            ->orderBy('r.order', 'ASC');
            };
        
        // Then the form
        $form = $this->createFormBuilder($app);
        $form->add('id', 'hidden');
        $form->add('role', 'entity', $opt);
        // Template argument
        $argts['form'] = $form->createView();
        
        // And finally render everything
        $tpl_path = 'LyricaEirinBundle:Appearance:addRole.html.twig';
        return $this->render($tpl_path, $argts);
    }
    
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
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