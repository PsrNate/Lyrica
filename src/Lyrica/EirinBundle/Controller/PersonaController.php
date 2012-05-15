<?php

namespace Lyrica\EirinBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Lyrica\EirinBundle\Entity\Persona;
use Lyrica\EirinBundle\Form\PersonaType;

/**
 * Persona controller.
 *
 */
class PersonaController extends Controller
{
    /**
     * Lists all Persona entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('LyricaEirinBundle:Persona')->findAll();

        return $this->render('LyricaEirinBundle:Persona:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Persona entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $pr = $em->getRepository('LyricaEirinBundle:Persona');

        $entity = $pr->findComplete($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Persona entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('LyricaEirinBundle:Persona:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Persona entity.
     *
     */
    public function newAction()
    {
        $entity = new Persona();
        $form   = $this->createForm(new PersonaType(), $entity);

        return $this->render('LyricaEirinBundle:Persona:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Persona entity.
     *
     */
    public function createAction()
    {
        $entity  = new Persona();
        $request = $this->getRequest();
        $form    = $this->createForm(new PersonaType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('persona_show', array('id' => $entity->getId())));
            
        }

        return $this->render('LyricaEirinBundle:Persona:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Persona entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('LyricaEirinBundle:Persona')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Persona entity.');
        }

        $editForm = $this->createForm(new PersonaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('LyricaEirinBundle:Persona:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Persona entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('LyricaEirinBundle:Persona')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Persona');
        }

        $editForm   = $this->createForm(new PersonaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('persona_edit', array('id' => $id)));
        }

        return $this->render('LyricaEirinBundle:Persona:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Persona entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('LyricaEirinBundle:Persona')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Persona');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('persona'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    /**
     * Displays rankings of every persona, with only global Elo
     */
    public function rankingsAction()
    {
        // Short for Entity Manager
        $em = $this->getDoctrine()->getEntityManager();
        // Short for Persona Repository
        $pr = $em->getRepository('LyricaEirinBundle:Persona');
        
        // Configure the query
        $criteria = array();
        $order = array('elo' => 'desc');
        
        // Fetch personae
        $argts['personae'] = $pr->findBy($criteria, $order);
        
        // Then return a response
        $tpl_path = 'LyricaEirinBundle:Persona:rankings.html.twig';
        return $this->render($tpl_path, $argts);
    }
}
