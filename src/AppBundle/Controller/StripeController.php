<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StripeController extends Controller {
    /**
     * Stripe payment
     *
     * @Route("/payment", name="payment_action")
     * @Method("GET")
     */
    public function indexAction(Request $request){
        $user=null;
        if ($request->getMethod()=='POST'){
            $customer =  $this->container->get('app.stripe')->addCustomer($request->$request->get('stripeTokenEventReg'),[
                'description'=>'Payment',
                'email'=>$user->getEmail(),
            ]);
            $user->setCustomer($customer);
        }
        return $this->render('stripe/stripe.html.twig', array(
        ));
    }
}