<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\VarDumper\VarDumper;

class StripeController extends Controller {
    /**
     * Stripe payment
     *
     * @Route("/payment", name="payment_action")
     */
    public function paymentAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $user =$this->get('security.token_storage')->getToken()->getUser();
        if ($request->getMethod()=='POST'){
            $customer =  $this->container->get('app.stripe')->addCustomer($request->request,[
                'description'=>'Payment',
                'email'=>$user->getEmail(),
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