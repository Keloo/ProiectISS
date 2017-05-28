<?php
namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\VarDumper\VarDumper;

class StripeController extends Controller
{

    /**
     * Stripe payment
     *
     * @Route("/payment", name="payment_action")
     */
    public function paymentAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if ($this->get('security.authorization_checker')->isGranted(['ROLE_USER'])) {
            return $this->redirectToRoute("fos_user_security_login");
        }

        /** @var User $user */
        $user = $this->getUser();

        if ($request->getMethod()=='POST'){
            $customer =  $this->get('app.stripe')->addCustomer($request->request,[
                'description' => 'Payment',
                'email' => $user->getEmail(),
            ]);

            $user->setCustomer($customer['id']);
            $em->persist($user);
            $em->flush();

            return new JsonResponse('succes',200);
        }

        return $this->render('stripe/stripe.html.twig', array(
        ));
    }

}