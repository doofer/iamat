<?php

namespace Doofer\IamatBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Doofer\IamatBundle\Entity\Interval;
use Doofer\IamatBundle\Form\IntervalType;

/**
 * Interval controller.
 *
 * @Route("/interval")
 */
class IntervalController extends Controller
{

    /**
     * Lists all Interval entities.
     *
     * @Route("/", name="interval")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DooferIamatBundle:Interval')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Interval entity.
     *
     * @Route("/", name="interval_create")
     * @Method("POST")
     * @Template("DooferIamatBundle:Interval:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Interval();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('interval_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Interval entity.
     *
     * @param Interval $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Interval $entity)
    {
        $form = $this->createForm(new IntervalType(), $entity, array(
            'action' => $this->generateUrl('interval_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Interval entity.
     *
     * @Route("/new", name="interval_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Interval();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Interval entity.
     *
     * @Route("/{id}", name="interval_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DooferIamatBundle:Interval')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Interval entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Interval entity.
     *
     * @Route("/{id}/edit", name="interval_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DooferIamatBundle:Interval')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Interval entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Interval entity.
    *
    * @param Interval $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Interval $entity)
    {
        $form = $this->createForm(new IntervalType(), $entity, array(
            'action' => $this->generateUrl('interval_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Interval entity.
     *
     * @Route("/{id}", name="interval_update")
     * @Method("PUT")
     * @Template("DooferIamatBundle:Interval:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DooferIamatBundle:Interval')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Interval entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('interval_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Interval entity.
     *
     * @Route("/{id}", name="interval_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DooferIamatBundle:Interval')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Interval entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('interval'));
    }

    /**
     * Creates a form to delete a Interval entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('interval_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
