<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Conference;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\VarDumper\VarDumper;

class DashboardController extends Controller
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function indexAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted(['ROLE_SUPER_ADMIN'])) {
            return $this->redirectToRoute('sonata_admin_dashboard');
        }
        if (empty($this->get('security.token_storage')->getToken()->getUser()->getCustomer()) ) {
            return $this->redirectToRoute('payment_action');
        }

        return $this->render(':board:index.html.twig', [
            'user' => $this->getUser(),
            'conferences' => $this->getDoctrine()->getRepository('AppBundle:Conference')->findAll(),
        ]);
    }
}
