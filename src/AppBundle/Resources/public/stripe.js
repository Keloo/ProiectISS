
Stripe.setPublishableKey(gos.stripe.stripe_public_key);
Stripe.card.createToken({
    number: modal.find('#membership-card-number').val(),
    cvc: modal.find('#membership-card-cvv').val(),
    exp_month: modal.find('#membership-card-exp-month').val(),
    exp_year: modal.find('#membership-card-exp-year').val(),

    //shipping info
    name: modal.find('#membership-card-name').val(),
    address_line1: modal.find('#membership-card-address').val()
}, stripeResponseCardHandlerExistingUser);
return false;

function stripeResponseCardHandlerExistingUser(status,response){
    if(response.error){
        alert(response.error.message);
    } else {
        jQuery('#register-existing-user').find(".stripeTokenEventReg").val(response.id);
        jQuery('#register_existing_user_to_event_form').trigger('submit');
    }
}