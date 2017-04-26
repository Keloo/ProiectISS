<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Conference;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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

        return $this->render('default/dashboard.html.twig', [
        ]);
    }


}
