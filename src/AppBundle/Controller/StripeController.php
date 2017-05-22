<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
        $user = $em->getRepository('AppBundle:User')->findOneBy(array('email' => 'user@example.com'));
        if ($request->getMethod()=='POST'){
//            VarDumper::dump($request->request->get('response'));die;
            $customer =  $this->container->get('app.stripe')->addCustomer($request->request,[
                'description'=>'Payment',
                'email'=>$user->getEmail(),
            ]);
//            VarDumper::dump($customer['id']);die;
            $user->setCustomer($customer['id']);
            $em->flush();
        }
        return $this->render('stripe/stripe.html.twig', array(
        ));
    }

}