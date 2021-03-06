<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Paper;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * Paper controller.
 *
 * @Route("dashboard/paper")
 */
class PaperController extends Controller
{
    /**
     * Lists all paper entities.
     *
     * @Security("has_role('ROLE_USER')")
     * @Route("/", name="paper_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        /** @var User $user */
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        if ($this->isGranted('ROLE_REVIEWER') || $this->isGranted('ROLE_PC')) {
            $papers = $em->getRepository('AppBundle:Paper')->findAll();
        } else {
            $papers = $em->getRepository('AppBundle:Paper')->findBy(['user' => $user]);
        }

        return $this->render('board/paper/index.html.twig', array(
            'papers' => $papers,
            'user' => $user,
            'paperEvaluationHelper' => $this->get('app.paper_evaluation_helper'),
        ));
    }

    /**
     * Creates a new paper entity.
     *
     * @Security("has_role('ROLE_SPEAKER')")
     * @Route("/new", name="paper_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $paper = new Paper();
        $form = $this->createForm('AppBundle\Form\PaperType', $paper);
        $form->handleRequest($request);
        $paper->setUser($this->getUser());

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($paper);
            $em->flush($paper);

            return $this->redirectToRoute('paper_index');
        }

        return $this->render('board/paper/new.html.twig', array(
            'paper' => $paper,
            'form' => $form->createView(),
            'user' => $this->getUser(),
        ));
    }

    /**
     * Finds and displays a paper entity.
     *
     * @Security("has_role('ROLE_USER')")
     * @Route("/{id}", name="paper_show")
     * @Method("GET")
     */
    public function showAction(Paper $paper)
    {
        $deleteForm = $this->createDeleteForm($paper);

        return $this->render('board/paper/show.html.twig', array(
            'paper' => $paper,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing paper entity.
     *
     * @Security("has_role('ROLE_SPEAKER')")
     * @Route("/{id}/edit", name="paper_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Paper $paper)
    {
        $deleteForm = $this->createDeleteForm($paper);
        $editForm = $this->createForm('AppBundle\Form\PaperType', $paper);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('paper_edit', array('id' => $paper->getId()));
        }

        return $this->render('board/paper/edit.html.twig', array(
            'paper' => $paper,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a paper entity.
     *
     * @Security("has_role('ROLE_SPEAKER')")
     * @Route("/{id}", name="paper_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Paper $paper)
    {
        $form = $this->createDeleteForm($paper);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($paper);
            $em->flush($paper);
        }

        return $this->redirectToRoute('paper_index');
    }

    /**
     * View paper file
     *
     * @Security("has_role('ROLE_SPEAKER')")
     * @Route("/file/{id}", name="paper_file")
     * @Method("GET")
     */
    public function paperFileAction(Request $request, Paper $paper)
    {
        return $this->redirect('/papers/'.$paper->getFileName());
    }

    /**
     * Creates a form to delete a paper entity.
     *
     * @param Paper $paper The paper entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Paper $paper)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('paper_delete', array('id' => $paper->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
