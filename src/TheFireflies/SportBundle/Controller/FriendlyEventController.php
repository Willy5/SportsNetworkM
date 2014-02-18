<?php

namespace TheFireflies\SportBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TheFireflies\SportBundle\Entity\FriendlyEvent;
use TheFireflies\SportBundle\Form\FriendlyEventType;

/**
 * FriendlyEvent controller.
 *
 */
class FriendlyEventController extends Controller
{

    /**
     * Lists all FriendlyEvent entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TheFirefliesSportBundle:FriendlyEvent')->findAll();

        return $this->render('TheFirefliesSportBundle:FriendlyEvent:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new FriendlyEvent entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new FriendlyEvent();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('friendlyevent_show', array('id' => $entity->getId())));
        }

        return $this->render('TheFirefliesSportBundle:FriendlyEvent:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a FriendlyEvent entity.
    *
    * @param FriendlyEvent $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(FriendlyEvent $entity)
    {
        $form = $this->createForm(new FriendlyEventType(), $entity, array(
            'action' => $this->generateUrl('friendlyevent_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new FriendlyEvent entity.
     *
     */
    public function newAction()
    {
        $entity = new FriendlyEvent();
        $form   = $this->createCreateForm($entity);

        return $this->render('TheFirefliesSportBundle:FriendlyEvent:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a FriendlyEvent entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TheFirefliesSportBundle:FriendlyEvent')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FriendlyEvent entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TheFirefliesSportBundle:FriendlyEvent:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing FriendlyEvent entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TheFirefliesSportBundle:FriendlyEvent')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FriendlyEvent entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TheFirefliesSportBundle:FriendlyEvent:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a FriendlyEvent entity.
    *
    * @param FriendlyEvent $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(FriendlyEvent $entity)
    {
        $form = $this->createForm(new FriendlyEventType(), $entity, array(
            'action' => $this->generateUrl('friendlyevent_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing FriendlyEvent entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TheFirefliesSportBundle:FriendlyEvent')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FriendlyEvent entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('friendlyevent_edit', array('id' => $id)));
        }

        return $this->render('TheFirefliesSportBundle:FriendlyEvent:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a FriendlyEvent entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TheFirefliesSportBundle:FriendlyEvent')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find FriendlyEvent entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('friendlyevent'));
    }

    /**
     * Creates a form to delete a FriendlyEvent entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('friendlyevent_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
