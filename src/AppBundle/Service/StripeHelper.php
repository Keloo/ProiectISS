<?php
namespace AppBundle\Service;

use Doctrine\Common\Util\Debug;
use Stripe\Charge;
use Stripe\Collection;
use Stripe\Coupon;
use Stripe\Customer;
use Stripe\Plan;
use Stripe\Refund;
use Stripe\Stripe;
use Stripe\Subscription;
use Stripe\Invoice;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

class StripeHelper {

    /** @var  ContainerInterface $container */
    protected  $container;

    public function __construct(ContainerInterface $containerInterface){
        $this->container = $containerInterface;
        Stripe::setApiKey($this->container->getParameter('stripe_secret_key'));
    }

    /**
     * @param ParameterBag $parameters
     * @param bool $message
     * @return null|Customer
     */
    public function addCustomer(ParameterBag $parameters,$message = false){
        try{
            $customer = Customer::create([
                'description' => $parameters->get('description'),
                'email' => $parameters->get('email'),
                'metadata' => $parameters->get('metadata'),
                'shipping' => $parameters->get('shipping'),
                'source' => $parameters->get('source')
            ]);
            return $customer;
        } catch(\Exception $e){
            if($message){
                return $e->getMessage();
            }
            return null;
        }
    }

    /**
     * @param $customerId
     * @param ParameterBag $parameters
     * @return array
     */
    public function updateCustomer($customerId,ParameterBag $parameters){
        try{
            $customer = Customer::retrieve($customerId);
            $customerArray = $customer->__toArray(true);
            $customer->__set('source',$parameters->get('source',$customerArray['default_source']));
            $customer->__set('description',$parameters->get('description',$customerArray['description']));
            $customer->save();
            return [
                'success' => true,
                'customer' => $customer
            ];
        }
        catch(\Exception $e){
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * @param $customerId
     * @return null|Customer
     */
    public function getCustomer($customerId){
        try{
            $customer = Customer::retrieve($customerId);
            return $customer;
        }
        catch(\Exception $e){
            return null;
        }
    }

    /**
     * @param $amount
     * @param $currency
     * @param $customerId
     * @param array $metadata
     * @param null $description
     * @return array
     */
    public function paymentFromCustomer($amount,$currency,$customerId,$metadata = [],$description = null){
        try {
            $charge = Charge::create([
                'amount' => $amount,
                'currency' => $currency,
                'customer' => $customerId,
                'description' => $description,
                'metadata' => $metadata
            ]);
            return [
                'success' => true,
                'charge' => $charge
            ];
        } catch (\Exception $ex){
            return [
                'success' => false,
                'message' => $ex->getMessage()
            ];
        }

    }

    /**
     * Pay with source object https://stripe.com/docs/api?lang=php#create_charge-source
     *
     * @param $amount
     * @param $currency
     * @param mixed $source check https://stripe.com/docs/api?lang=php#create_charge-source
     * @param array $metadata
     * @param null $description
     * @return array
     */
    public function paymentFromSource($amount,$currency,$source,$metadata = [], $description = null){

        try {
            $charge = Charge::create([
                'amount' => $amount,
                'currency' => $currency,
                'source' => $source,
                'description' => $description,
                'metadata' => $metadata
            ]);

            return [
                'success' => true,
                'charge' => $charge
            ];
        }catch (\Exception $ex){
            return [
                'success' => false,
                'message' => $ex->getMessage()
            ];
        }

    }

    /**
     * @param string $idPlan identification plan
     * @param $amount
     * @param $interval
     * @param $name
     * @param string $currecny
     * @param ParameterBag $optional [ 'intervalCount', 'metadata', 'statementsDescriptor', 'trialPeriods' ]
     * @return array
     */
    public function createPlan($idPlan,$amount,$interval,$name,$currecny = 'usd',ParameterBag $optional = null){
        $optional = (!empty($optional) ? $optional : new ParameterBag([]));
        try {
            $plan = Plan::create([
                'id' => $idPlan,
                'amount' => $amount,
                'interval' => $interval,
                'name' => $name,
                'currency' => $currecny,
                'interval_count' => $optional->get('intervalCount'),
                'metadata' => $optional->get('metadata'),
                'statement_descriptor' => $optional->get('statementDescriptor'),
                'trial_period_days' => $optional->get('trialPeriods')
            ]);
            return [
                'success' => true,
                'plan' => $plan
            ];
        } catch (\Exception $ex) {
             return [
                'success' => false,
                'message' => $ex->getMessage()
            ];
        }

    }

    /**
     * @param $idPlan
     * @return null|Plan
     */
    public function getPlan($idPlan){
        try{
            $plan = Plan::retrieve($idPlan);

            return $plan;
        }catch (\Exception $ex){
            return null;
        }
    }

    /**
     * @param $customer
     * @param $subscription
     * @return null|Subscription
     */
    public function getSubscription($customer,$subscription){

        try{
            $c = Customer::retrieve($customer)->__toArray();// if not exist catch Exception
            /** @var Collection $s */
            $s = $c['subscriptions'];
            return $s->retrieve($subscription); //if not exist catch Exception
        }
        catch(\Exception $ex){
            return null;
        }
    }

    /**
     * @param $customer
     * @param $subscription
     * @return array
     */
    public function cancelSubscription($customer,$subscription){
        try{
            $c = Customer::retrieve($customer)->__toArray(); // if not exist catch Exception
            /** @var Collection $s */
            $s= $c['subscriptions'];
            /** @var Subscription $sub */
            $sub = $s->retrieve($subscription);
            $sub->cancel();

            return[
                'success' => true,
                'subscription' => $sub
            ];
        }catch (\Exception $ex){
            return [
                'success' => false,
                'message' => $ex->getMessage()
            ];
        }
    }

    /**
     * @param $customer
     * @param ParameterBag $params [plan => required]
     * @return array
     */
    public function addSubscription($customer,ParameterBag $params){
        try{
            $c = Customer::retrieve($customer)->__toArray(); // if not exit catch Exception
            /** @var Collection $s */
            $s = $c['subscriptions'];
            if(!$params->get('plan')) throw new \Exception('Plan is required.');
            /** @var Subscription $subscribtion */
            $subscribtion = $s->create([
                'plan' => $params->get('plan'),
                'source' => $params->get('source'),
                'trial_end' => $params->get('trialEnd'),
                'metadata' => $params->get('metadata',[]),
                'coupon' => $params->get('discount')
            ]);
            return [
                'success' => true,
                'subscription' => $subscribtion
            ];
        }catch (\Exception $ex){
            return [
                'success' => false,
                'message' => $ex->getMessage()
            ];
        }
    }

    /**
     * @param $customer
     * @param $subscription
     * @param ParameterBag $params
     * @return array
     */
    public function updateSubscription($customer,$subscription, ParameterBag $params){
        try{
            $s = $this->getSubscription($customer,$subscription);
            if($s == null) throw new \Exception("Subscription not founded");
            if($params->get('plan')) {
                $s->__set('plan' , $params->get('plan'));
            }
            if($params->get('prorate') !== null){
                $s->__set('prorate', $params->get('prorate'));
            }
            $s->save();

            return [
                'success' => true,
                'subscription' => $s
            ];

        }catch (\Exception $ex){
            return [
                'success' => false,
                'message' => $ex->getMessage()
            ];
        }
    }

    /**
     * @param $chargeId
     * @param ParameterBag $params check params https://stripe.com/docs/api?lang=php#create_refund
     * @return array
     */
    public function refundOrder($chargeId,ParameterBag $params){
        try{
            $c = Charge::retrieve($chargeId);
            if($c == null)throw new \Exception("Charge not founded");
            $re = Refund::create(array_merge([
                'charge' => $c->__get('id')
            ],$params->all()));

            return [
                'success' => true,
                'refund' => $re
            ];
        }
        catch(\Exception $ex){
            return [
                'success' => false,
                'message' => $ex->getMessage()
            ];
        }
    }

    /**
     * @param ParameterBag $params
     * @return array
     */
    public function createCoupon(ParameterBag $params){
        try{
            $c = Coupon::create([
                "percent_off" => $params->get('percentAmount'),
                "amount_off" => $params->get('fixAmount')*100,
                "currency" => "usd",
                "duration" => "once",
//                "max_redemptions" => 1,
                "id" => $params->get('discountCode')
            ]);
            return [
                'success' => true,
                'discount' => $c
            ];
        }catch (\Exception $e){
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * @param $customerId
     * @param $subscriptionId
     * @param array $options
     * @return array
     */
    public function getInvoicesSubscription($customerId,$subscriptionId,array $options = []){
        try{
            $options['customer'] = $customerId;
            /** @var Collection $invoices */
            $invoices = Invoice::all($options)->jsonSerialize();

            $i = [];
            foreach($invoices['data'] as $line){
                if($line['subscription'] == $subscriptionId){
                    $i[] = $line;
                }
            }
            return $i;
        }
        catch(\Exception $e){
            return [];
        }

    }
}