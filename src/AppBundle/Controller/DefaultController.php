<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Conference;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted(['ROLE_SUPER_ADMIN'])) {
            return $this->redirectToRoute('sonata_admin_dashboard');
        }
        if ($this->get('security.authorization_checker')->isGranted(['ROLE_USER'])) {
            if ($this->getUser()->getConferences()->count()) {
                return $this->redirectToRoute('dashboard');
            } else {
                return $this->redirectToRoute('select_conference');
            }
        }

        return $this->render('default/index.html.twig', [
            'conferences' => $this->getDoctrine()->getRepository('AppBundle:Conference')->findAll(),
        ]);
    }

    /**
     * @Route("/selectConference", name="select_conference")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function selectConference(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted(['ROLE_SUPER_ADMIN'])) {
            return $this->redirectToRoute('sonata_admin_dashboard');
        }
        return $this->render(':default:selectConference.html.twig', [
            'conferences' => $this->getDoctrine()->getRepository('AppBundle:Conference')->findAll(),
        ]);
    }

    /**
     * @Route("/userAttachConference/{conference}", name="user_attach_conference")
     * @param Conference $conference
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function userAttachConference(Conference $conference)
    {
        /** @var User $user */
        $user = $this->getUser();
        $user->addConference($conference);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('homepage');
    }
}
