<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Conference;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Conference controller.
 *
 * @Route("dashboard/conference")
 */
class ConferenceController extends Controller
{
    /**
     * Lists all conference entities.
     *
     * @Route("/", name="dashboard_conference_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $conferences = $em->getRepository('AppBundle:Conference')->findAll();

        return $this->render('board/conference/index.html.twig', array(
            'conferences' => $conferences,
        ));
    }

    /**
     * Creates a new conference entity.
     *
     * @Route("/new", name="dashboard_conference_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $conference = new Conference();
        $form = $this->createForm('AppBundle\Form\ConferenceType', $conference);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($conference);
            $em->flush();

            return $this->redirectToRoute('dashboard_conference_show', array('id' => $conference->getId()));
        }

        return $this->render('board/conference/new.html.twig', array(
            'conference' => $conference,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a conference entity.
     *
     * @Route("/{id}", name="dashboard_conference_show")
     * @Method("GET")
     */
    public function showAction(Conference $conference)
    {
        $deleteForm = $this->createDeleteForm($conference);

        return $this->render('board/conference/show.html.twig', array(
            'conference' => $conference,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing conference entity.
     *
     * @Route("/{id}/edit", name="dashboard_conference_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Conference $conference)
    {
        $deleteForm = $this->createDeleteForm($conference);
        $editForm = $this->createForm('AppBundle\Form\ConferenceType', $conference);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dashboard_conference_edit', array('id' => $conference->getId()));
        }

        return $this->render('board/conference/edit.html.twig', array(
            'conference' => $conference,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a conference entity.
     *
     * @Route("/{id}", name="dashboard_conference_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Conference $conference)
    {
        $form = $this->createDeleteForm($conference);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($conference);
            $em->flush();
        }

        return $this->redirectToRoute('dashboard_conference_index');
    }

    /**
     * Creates a form to delete a conference entity.
     *
     * @param Conference $conference The conference entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Conference $conference)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('dashboard_conference_delete', array('id' => $conference->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
