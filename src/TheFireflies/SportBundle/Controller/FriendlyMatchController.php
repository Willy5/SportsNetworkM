<?php

namespace TheFireflies\SportBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TheFireflies\SportBundle\Entity\FriendlyMatch;
use TheFireflies\SportBundle\Form\FriendlyMatchType;

/**
 * FriendlyMatch controller.
 *
 */
class FriendlyMatchController extends Controller
{

    /**
     * Lists all FriendlyMatch entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TheFirefliesSportBundle:FriendlyMatch')->findAll();

        return $this->render('TheFirefliesSportBundle:FriendlyMatch:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new FriendlyMatch entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new FriendlyMatch();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('friendlymatch_show', array('id' => $entity->getId())));
        }

        return $this->render('TheFirefliesSportBundle:FriendlyMatch:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a FriendlyMatch entity.
    *
    * @param FriendlyMatch $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(FriendlyMatch $entity)
    {
        $form = $this->createForm(new FriendlyMatchType(), $entity, array(
            'action' => $this->generateUrl('friendlymatch_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new FriendlyMatch entity.
     *
     */
    public function newAction()
    {
        $entity = new FriendlyMatch();
        $form   = $this->createCreateForm($entity);

        return $this->render('TheFirefliesSportBundle:FriendlyMatch:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a FriendlyMatch entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TheFirefliesSportBundle:FriendlyMatch')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FriendlyMatch entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TheFirefliesSportBundle:FriendlyMatch:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing FriendlyMatch entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TheFirefliesSportBundle:FriendlyMatch')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FriendlyMatch entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TheFirefliesSportBundle:FriendlyMatch:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a FriendlyMatch entity.
    *
    * @param FriendlyMatch $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(FriendlyMatch $entity)
    {
        $form = $this->createForm(new FriendlyMatchType(), $entity, array(
            'action' => $this->generateUrl('friendlymatch_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing FriendlyMatch entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TheFirefliesSportBundle:FriendlyMatch')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FriendlyMatch entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('friendlymatch_edit', array('id' => $id)));
        }

        return $this->render('TheFirefliesSportBundle:FriendlyMatch:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a FriendlyMatch entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TheFirefliesSportBundle:FriendlyMatch')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find FriendlyMatch entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('friendlymatch'));
    }

    /**
     * Creates a form to delete a FriendlyMatch entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('friendlymatch_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
