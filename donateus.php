
<?php
include('navbar.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>Donate US</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body style="background-repeat: no-repeat;">
<div class="container">
<div class="row">
<div class="col-xs-12 col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <!-- <h4 class="panel-title">Charge Rs.10 INR</h4> -->
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="billing_name" id="billing_name" placeholder="Enter name" required autofocus>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="billing_email" id="billing_email" placeholder="Enter email" required>
            </div>
            <div class="form-group">
                <label>Mobile Number</label>
                <input type="tel" class="form-control" name="billing_mobile" id="billing_mobile" pattern="[0-9]{10}" placeholder="Enter Mobile Number" required>
            </div>
            <div class="form-group">
                <label>Payment Amount</label>
                <input type="number" class="form-control" name="payAmount" id="payAmount" value="0" placeholder="Enter Amount" required>
            </div>
            <!-- submit button -->
            <button id="PayNow" class="btn btn-success btn-lg btn-block">Submit & Pay</button>
        </div>
    </div>
</div>
</div>
</div>
<script>
    // Pay Amount
    jQuery(document).ready(function($) {
        jQuery('#PayNow').click(function(e) {
            e.preventDefault(); // Prevent default form submission

            var paymentOption = '';
            let billing_name = $('#billing_name').val();
            let billing_mobile = $('#billing_mobile').val();
            let billing_email = $('#billing_email').val();
            var shipping_name = $('#billing_name').val();
            var shipping_mobile = $('#billing_mobile').val();
            var shipping_email = $('#billing_email').val();
            var paymentOption = "netbanking";
            var payAmount = $('#payAmount').val();
            
            if (!billing_name || !billing_mobile || !billing_email || !payAmount) {
                alert('Please fill all the required fields.');
                return;
            }

            var request_url = "submitpayment.php";
            var formData = {
                billing_name: billing_name,
                billing_mobile: billing_mobile,
                billing_email: billing_email,
                shipping_name: shipping_name,
                shipping_mobile: shipping_mobile,
                shipping_email: shipping_email,
                paymentOption: paymentOption,
                payAmount: payAmount,
                action: 'payOrder'
            };

            $.ajax({
                type: 'POST',
                url: request_url,
                data: formData,
                dataType: 'json',
                encode: true,
            }).done(function(data) {
                if (data.res == 'success') {
                    var orderID = data.order_number;
                    var orderNumber = data.order_number;
                    var options = {
                        "key": data.razorpay_key, // Enter the Key ID generated from the Dashboard
                        "amount": data.userData.amount, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                        "currency": "INR",
                        "name": "ShikshaShastra", // your business name
                        "description": data.userData.description,
                        "image": "img/logo-no-background.png",
                        "order_id": data.userData.rpay_order_id, // This is a sample Order ID. Pass 
                        "handler": function(response) {
                            window.location.replace("index.php?oid=" + orderID + "&rp_payment_id=" + response.razorpay_payment_id + "&rp_signature=" + response.razorpay_signature);
                        },
                        "modal": {
                            "ondismiss": function() {
                                window.location.replace("index.php?oid=" + orderID);
                            }
                        },
                        "prefill": { // We recommend using the prefill parameter to auto-fill customer's contact information especially their phone number
                            "name": data.userData.name, // your customer's name
                            "email": data.userData.email,
                            "contact": data.userData.mobile // Provide the customer's phone number for better conversion rates 
                        },
                        "notes": {
                            "address": "ShikshaShastra"
                        },
                        "config": {
                            "display": {
                                "blocks": {
                                    "banks": {
                                        "name": 'Pay using ' + paymentOption,
                                        "instruments": [
                                            {
                                                "method": paymentOption
                                            }
                                        ]
                                    }
                                },
                                "sequence": ['block.banks'],
                                "preferences": {
                                    "show_default_blocks": true
                                }
                            }
                        },
                        "theme": {
                            "color": "#3399cc"
                        }
                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.on('payment.failed', function(response) {
                        window.location.replace("index.php?oid=" + orderID + "&reason=" + response.error.description + "&paymentid=" + response.error.metadata.payment_id);
                    });
                    rzp1.open();
                }
            });
        });
    });
</script>
</body>
</html>
