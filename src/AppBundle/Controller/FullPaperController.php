<?php

namespace AppBundle\Controller;

use AppBundle\Entity\FullPaper;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Fullpaper controller.
 *
 * @Route("dashboard/fullpaper")
 */
class FullPaperController extends Controller
{
    /**
     * Lists all fullPaper entities.
     *
     * @Route("/", name="dashboard_fullpaper_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $fullPapers = $em->getRepository('AppBundle:FullPaper')->findAll();

        return $this->render('board/fullpaper/index.html.twig', array(
            'fullPapers' => $fullPapers,
        ));
    }

    /**
     * Creates a new fullPaper entity.
     *
     * @Route("/new", name="dashboard_fullpaper_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $fullPaper = new Fullpaper();
        $form = $this->createForm('AppBundle\Form\FullPaperType', $fullPaper);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fullPaper);
            $em->flush();

            return $this->redirectToRoute('dashboard_fullpaper_show', array('id' => $fullPaper->getId()));
        }

        return $this->render('board/fullpaper/new.html.twig', array(
            'fullPaper' => $fullPaper,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a fullPaper entity.
     *
     * @Route("/{id}", name="dashboard_fullpaper_show")
     * @Method("GET")
     */
    public function showAction(FullPaper $fullPaper)
    {
        $deleteForm = $this->createDeleteForm($fullPaper);

        return $this->render('board/fullpaper/show.html.twig', array(
            'fullPaper' => $fullPaper,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing fullPaper entity.
     *
     * @Route("/{id}/edit", name="dashboard_fullpaper_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, FullPaper $fullPaper)
    {
        $deleteForm = $this->createDeleteForm($fullPaper);
        $editForm = $this->createForm('AppBundle\Form\FullPaperType', $fullPaper);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dashboard_fullpaper_edit', array('id' => $fullPaper->getId()));
        }

        return $this->render('board/fullpaper/edit.html.twig', array(
            'fullPaper' => $fullPaper,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a fullPaper entity.
     *
     * @Route("/{id}", name="dashboard_fullpaper_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, FullPaper $fullPaper)
    {
        $form = $this->createDeleteForm($fullPaper);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($fullPaper);
            $em->flush();
        }

        return $this->redirectToRoute('dashboard_fullpaper_index');
    }

    /**
     * Creates a form to delete a fullPaper entity.
     *
     * @param FullPaper $fullPaper The fullPaper entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FullPaper $fullPaper)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('dashboard_fullpaper_delete', array('id' => $fullPaper->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
