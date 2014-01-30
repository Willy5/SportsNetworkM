<?php

namespace TheFireflies\SportBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TheFireflies\SportBundle\Entity\Sport;
use TheFireflies\SportBundle\Form\SportType;

/**
 * Sport controller.
 *
 */
class SportController extends Controller
{

    /**
     * Lists all Sport entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TheFirefliesSportBundle:Sport')->findAll();

        return $this->render('TheFirefliesSportBundle:Sport:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Sport entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Sport();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('sport_show', array('id' => $entity->getId())));
        }

        return $this->render('TheFirefliesSportBundle:Sport:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Sport entity.
    *
    * @param Sport $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Sport $entity)
    {
        $form = $this->createForm(new SportType(), $entity, array(
            'action' => $this->generateUrl('sport_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Sport entity.
     *
     */
    public function newAction()
    {
        $entity = new Sport();
        $form   = $this->createCreateForm($entity);

        return $this->render('TheFirefliesSportBundle:Sport:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Sport entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TheFirefliesSportBundle:Sport')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sport entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TheFirefliesSportBundle:Sport:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Sport entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TheFirefliesSportBundle:Sport')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sport entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TheFirefliesSportBundle:Sport:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Sport entity.
    *
    * @param Sport $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Sport $entity)
    {
        $form = $this->createForm(new SportType(), $entity, array(
            'action' => $this->generateUrl('sport_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Sport entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TheFirefliesSportBundle:Sport')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sport entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('sport_edit', array('id' => $id)));
        }

        return $this->render('TheFirefliesSportBundle:Sport:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Sport entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TheFirefliesSportBundle:Sport')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Sport entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('sport'));
    }

    /**
     * Creates a form to delete a Sport entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sport_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
