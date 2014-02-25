<?php

namespace TheFireflies\SportBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TheFireflies\SportBundle\Entity\InstanceTeam;
use TheFireflies\SportBundle\Entity\PlayerDetail;
use TheFireflies\SportBundle\Form\PlayerDetailType;

/**
 * PlayerDetail controller.
 *
 */
class PlayerDetailController extends Controller
{

    /**
     * Lists all PlayerDetail entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TheFirefliesSportBundle:PlayerDetail')->findAll();

        return $this->render('TheFirefliesSportBundle:PlayerDetail:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new PlayerDetail entity.
     *
     */
    public function createAction($instanceTeamId, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $instanceTeam = $em->getRepository('TheFirefliesSportBundle:InstanceTeam')->find($instanceTeamId);
        
        if (!$instanceTeam) {
            throw $this->createNotFoundException('Unable to find InstanceTeam entity.');
        }
        
        $entity = new PlayerDetail();
        $entity->setInstanceTeam($instanceTeam);
        $form = $this->createCreateForm($entity, $instanceTeam);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('playerdetail_show', array('id' => $entity->getId())));
        }

        return $this->render('TheFirefliesSportBundle:PlayerDetail:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a PlayerDetail entity.
    *
    * @param PlayerDetail $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(PlayerDetail $entity, InstanceTeam $instanceTeam)
    {
        $form = $this->createForm(new PlayerDetailType(), $entity, array(
            'action' => $this->generateUrl('playerdetail_create', array('instanceTeamId' => $instanceTeam->getId())),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new PlayerDetail entity.
     *
     */
    public function newAction($instanceTeamId)
    {
        $em = $this->getDoctrine()->getManager();
        
        $instanceTeam = $em->getRepository('TheFirefliesSportBundle:InstanceTeam')->find($instanceTeamId);
        
        if (!$instanceTeam) {
            throw $this->createNotFoundException('Unable to find InstanceTeam entity.');
        }
        
        $entity = new PlayerDetail();
        
        $form   = $this->createCreateForm($entity, $instanceTeam);

        return $this->render('TheFirefliesSportBundle:PlayerDetail:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a PlayerDetail entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TheFirefliesSportBundle:PlayerDetail')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PlayerDetail entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TheFirefliesSportBundle:PlayerDetail:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing PlayerDetail entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TheFirefliesSportBundle:PlayerDetail')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PlayerDetail entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TheFirefliesSportBundle:PlayerDetail:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a PlayerDetail entity.
    *
    * @param PlayerDetail $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(PlayerDetail $entity)
    {
        $form = $this->createForm(new PlayerDetailType(), $entity, array(
            'action' => $this->generateUrl('playerdetail_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing PlayerDetail entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TheFirefliesSportBundle:PlayerDetail')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PlayerDetail entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('playerdetail_edit', array('id' => $id)));
        }

        return $this->render('TheFirefliesSportBundle:PlayerDetail:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a PlayerDetail entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TheFirefliesSportBundle:PlayerDetail')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PlayerDetail entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('playerdetail'));
    }

    /**
     * Creates a form to delete a PlayerDetail entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('playerdetail_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
