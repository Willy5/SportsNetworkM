<?php

namespace TheFireflies\SportBundle\Controller;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TheFireflies\SportBundle\Entity\InstanceTeam;
use TheFireflies\SportBundle\Form\InstanceTeamType;

/**
 * InstanceTeam controller.
 *
 */
class InstanceTeamController extends Controller
{

    /**
     * Lists all InstanceTeam entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TheFirefliesSportBundle:InstanceTeam')->findAll();

        return $this->render('TheFirefliesSportBundle:InstanceTeam:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new InstanceTeam entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new InstanceTeam();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('instanceteam_show', array('id' => $entity->getId())));
        }

        return $this->render('TheFirefliesSportBundle:InstanceTeam:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a InstanceTeam entity.
    *
    * @param InstanceTeam $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(InstanceTeam $entity)
    {
        $form = $this->createForm(new InstanceTeamType(), $entity, array(
            'action' => $this->generateUrl('instanceteam_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new InstanceTeam entity.
     *
     */
    public function newAction()
    {
        $entity = new InstanceTeam();
        $form   = $this->createCreateForm($entity);

        return $this->render('TheFirefliesSportBundle:InstanceTeam:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a InstanceTeam entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TheFirefliesSportBundle:InstanceTeam')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find InstanceTeam entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TheFirefliesSportBundle:InstanceTeam:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing InstanceTeam entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TheFirefliesSportBundle:InstanceTeam')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find InstanceTeam entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TheFirefliesSportBundle:InstanceTeam:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a InstanceTeam entity.
    *
    * @param InstanceTeam $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(InstanceTeam $entity)
    {
        $form = $this->createForm(new InstanceTeamType(), $entity, array(
            'action' => $this->generateUrl('instanceteam_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing InstanceTeam entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TheFirefliesSportBundle:InstanceTeam')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find InstanceTeam entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('instanceteam_edit', array('id' => $id)));
        }

        return $this->render('TheFirefliesSportBundle:InstanceTeam:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a InstanceTeam entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TheFirefliesSportBundle:InstanceTeam')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find InstanceTeam entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('instanceteam'));
    }

    /**
     * Creates a form to delete a InstanceTeam entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('instanceteam_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
