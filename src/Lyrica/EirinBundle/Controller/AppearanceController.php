<?php

namespace Lyrica\EirinBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Lyrica\EirinBundle\Entity\Appearance;

class AppearanceController extends Controller
{
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