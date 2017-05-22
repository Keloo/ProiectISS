$( document ).ready(function() {
    $('#payButton').click (function() {
        Stripe.setPublishableKey('pk_test_l0FhbGCTojlLSbKYsxemagL2');
        Stripe.card.createToken({
            number: $('#membership-card-number').val(),
            cvc: $('#membership-card-cvv').val(),
            exp_month: $('#membership-card-exp-month').val(),
            exp_year: $('#membership-card-exp-year').val(),

            //shipping info
            name: $('#membership-card-name').val(),
            address_line1: $('#membership-card-address').val()
        }, stripeResponseCardHandlerExistingUser);
        return false;
    });

        function stripeResponseCardHandlerExistingUser(status,response){
            console.log(response);
            if(response.error){
                alert(response.error.message);
            } else {
                var id = response.id;
                // jQuery('#register-existing-user').find(".stripeTokenEventReg").val(response.id);
                // jQuery('#register_existing_user_to_event_form').trigger('submit');
                // $("#payForm").submit();
                $.ajax({
                    type: 'POST',
                    url: "/app_dev.php/payment",
                    data:{response:id},
                    dataType: 'json',
                    success: function (response) {
                        console.log('jdg');
                    },
                    error: function (jqXHR) {
                    }

                });
            }
        }


});