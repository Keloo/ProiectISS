<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PaperType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * Papertype controller.
 *
 * @Route("papertype")
 */
class PaperTypeController extends Controller
{
    /**
     * Lists all paperType entities.
     *
     * @Security("has_role('ROLE_USER')")
     * @Route("/", name="papertype_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $paperTypes = $em->getRepository('AppBundle:PaperType')->findAll();

        return $this->render('papertype/index.html.twig', array(
            'paperTypes' => $paperTypes,
        ));
    }

    /**
     * Creates a new paperType entity.
     *
     * @Security("has_role('ROLE_PC')")
     * @Route("/new", name="papertype_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $paperType = new Papertype();
        $form = $this->createForm('AppBundle\Form\PaperTypeType', $paperType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($paperType);
            $em->flush($paperType);

            return $this->redirectToRoute('papertype_show', array('id' => $paperType->getId()));
        }

        return $this->render('papertype/new.html.twig', array(
            'paperType' => $paperType,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a paperType entity.
     *
     * @Security("has_role('ROLE_USER')")
     * @Route("/{id}", name="papertype_show")
     * @Method("GET")
     */
    public function showAction(PaperType $paperType)
    {
        $deleteForm = $this->createDeleteForm($paperType);

        return $this->render('papertype/show.html.twig', array(
            'paperType' => $paperType,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing paperType entity.
     *
     * @Security("has_role('ROLE_PC')")
     * @Route("/{id}/edit", name="papertype_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, PaperType $paperType)
    {
        $deleteForm = $this->createDeleteForm($paperType);
        $editForm = $this->createForm('AppBundle\Form\PaperTypeType', $paperType);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('papertype_edit', array('id' => $paperType->getId()));
        }

        return $this->render('papertype/edit.html.twig', array(
            'paperType' => $paperType,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a paperType entity.
     *
     * @Security("has_role('ROLE_PC')")
     * @Route("/{id}", name="papertype_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, PaperType $paperType)
    {
        $form = $this->createDeleteForm($paperType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($paperType);
            $em->flush($paperType);
        }

        return $this->redirectToRoute('papertype_index');
    }

    /**
     * Creates a form to delete a paperType entity.
     *
     * @param PaperType $paperType The paperType entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PaperType $paperType)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('papertype_delete', array('id' => $paperType->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
