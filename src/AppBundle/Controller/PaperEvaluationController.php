<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PaperEvaluation;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Paperevaluation controller.
 *
 * @Route("dashboard/paperevaluation")
 */
class PaperEvaluationController extends Controller
{
    /**
     * Lists all paperEvaluation entities.
     *
     * @Route("/", name="dashboard_paperevaluation_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        /** @var User $user */
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        if ($this->isGranted('ROLE_REVIEWER') || $this->isGranted('ROLE_PC')) {
            $paperEvaluations = $em->getRepository('AppBundle:PaperEvaluation')->findAll();
        } else {
            $paperEvaluations = $user->getPaperEvaluations();
        }

        return $this->render('board/paperevaluation/index.html.twig', array(
            'paperEvaluations' => $paperEvaluations,
            'user' => $user,
        ));
    }

    /**
     * Creates a new paperEvaluation entity.
     *
     * @Route("/new", name="dashboard_paperevaluation_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $paperEvaluation = new Paperevaluation();
        $form = $this->createForm('AppBundle\Form\PaperEvaluationType', $paperEvaluation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($paperEvaluation);
            $em->flush();

            return $this->redirectToRoute('dashboard_paperevaluation_show', array('id' => $paperEvaluation->getId()));
        }

        return $this->render('board/paperevaluation/new.html.twig', array(
            'paperEvaluation' => $paperEvaluation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a paperEvaluation entity.
     *
     * @Route("/{id}", name="dashboard_paperevaluation_show")
     * @Method("GET")
     */
    public function showAction(PaperEvaluation $paperEvaluation)
    {
        $deleteForm = $this->createDeleteForm($paperEvaluation);

        return $this->render('board/paperevaluation/show.html.twig', array(
            'paperEvaluation' => $paperEvaluation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing paperEvaluation entity.
     *
     * @Route("/{id}/edit", name="dashboard_paperevaluation_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, PaperEvaluation $paperEvaluation)
    {
        $deleteForm = $this->createDeleteForm($paperEvaluation);
        $editForm = $this->createForm('AppBundle\Form\PaperEvaluationType', $paperEvaluation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dashboard_paperevaluation_edit', array('id' => $paperEvaluation->getId()));
        }

        return $this->render('board/paperevaluation/edit.html.twig', array(
            'paperEvaluation' => $paperEvaluation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a paperEvaluation entity.
     *
     * @Route("/{id}", name="dashboard_paperevaluation_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, PaperEvaluation $paperEvaluation)
    {
        $form = $this->createDeleteForm($paperEvaluation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($paperEvaluation);
            $em->flush();
        }

        return $this->redirectToRoute('dashboard_paperevaluation_index');
    }

    /**
     * Creates a form to delete a paperEvaluation entity.
     *
     * @param PaperEvaluation $paperEvaluation The paperEvaluation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PaperEvaluation $paperEvaluation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('dashboard_paperevaluation_delete', array('id' => $paperEvaluation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
