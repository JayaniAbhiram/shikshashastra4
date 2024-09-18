<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Oswald:400,700,300');
 @import url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,600');
 body {
	 /* background-color: #24282e; */
	 font-family: 'Open Sans', sans-serif;
	 display: flex;
	 justify-content: center;
	 padding: 50px 0;
     background-image:url('img/bg_image.jpg');
}
 .donate {
	 /* background-color: #171b24; */
     background-image:url('img/bg_image.jpg');
	 width: 500px;
	 color: #fff;
}
 .donate p {
	 line-height: 24px;
	 font-size: 14px;
	 font-weight: 300;
}
 .donate h3 {
	 font-size: 14px;
	 font-weight: 300;
	 margin-bottom: 30px;
}
 .denomination {
	 float: left;
	 width: 33%;
	 text-align: center;
	 padding: 13px 0;
	 cursor: pointer;
	 /* background-color: #171b24; */
     background-image:url('img/bg_image.jpg');
	 margin: 0 1px 1px 0;
	 transition: background-color 0.2s ease;
}
 .denomination label {
	 font-weight: 600;
	 cursor: pointer;
}
 .denomination input {
	 left: -10001px;
	 position: absolute;
}
 .denomination-other {
	 width: 99.8%;
}
 .denomination-other input {
	 position: relative;
	 color: #fff;
	 font-size: 14px;
	 font-weight: 600;
	 width: inherit;
	 text-align: center;
	 /* background-color: #171b24; */
     background-image:url('img/bg_image.jpg');
	 border: none;
	 padding: 13px 0;
	 transition: background-color 0.2s ease;
}
 .denomination-other input:hover {
	 background-color: orange;
}
 .denomination-other input:before {
	 position: absolute;
	 left: 6px;
	 top: 2px;
	 content: '$';
}
 .donate-amount .selected, .denomination-other input.selected, .donate-amount .denomination:hover {
	 background-color: orange;
	 border: 0;
}
 .donate-black h2 {
	 font-family: 'Oswald', sans-serif;
	 color: #fff;
	 font-size: 32px;
	 margin-bottom: 30px;
}
 .donate-black h2 span {
	 display: block;
	 float: left;
	 font-size: 16px;
	 padding-top: 7px;
	 margin-right: 20px;
	 text-align: center;
	 width: 30px;
	 height: 25px;
	 background-color: orange;
	 border-radius: 50%;
}
 .donate-type label, .donate-payment label {
	 font-size: 14px;
	 font-weight: 300;
	 margin-right: 30px;
}
 .donate-blue {
	 /* background-color: #1e252d; */
     background-image:url('img/bg_image.jpg');
	 padding: 25px;
}
 .donate-black {
	 padding: 25px;
}
 .donate-submit button {
	 font-family: 'Oswald', sans-serif;
	 width: 100%;
	 background-color: orange;
	 border: none;
	 color: #fff;
	 font-size: 20px;
	 line-height: 20px;
	 padding: 14px 0;
	 margin: 30px 0;
	 text-transform: uppercase;
	 cursor: pointer;
}
 .donate-submit small {
	 color: rgba(255, 255, 255, 0.4);
	 font-size: 13px;
}
 ::-webkit-input-placeholder {
	 color: #fff;
	 font-size: 14px;
	 font-weight: 300;
}
 :-moz-placeholder {
	 color: #fff;
	 font-weight: 300;
}
 ::-moz-placeholder {
	 color: #fff;
	 font-weight: 300;
}
 :-ms-input-placeholder {
	 font-weight: 300;
	 color: #fff;
}
 *:focus {
	 outline: none;
}
 
        </style>
    </style>
</head>
<body>
    <div class="donate">
        <div class="donate-black">
          <h2><span>₹</span> Donate</h3>
          <p>Your contribution is vital to the success of our initiative.<br>Choose the amount you wish to donate, as one-time or monthly payment. </p>
        </div>
        <div class="donate-blue">
          <h3>Donation amount*</h3>
          <div class="donate-amount-box">
            <div class="donate-amount">
              <div class="denomination selected">
                <input autocomplete="off" type="radio" name="amount" id="amount5" value="5" checked="">
                <label for="amount5">₹5</label>
              </div>
              <div class="denomination">
                <input autocomplete="off" type="radio" name="amount" id="amount10" value="10">
                <label for="amount10">₹10</label>
              </div>
              <div class="denomination">
                <input autocomplete="off" type="radio" name="amount" id="amount15" value="15">
                <label for="amount15">₹15</label>
              </div>
              <div class="denomination">
                <input autocomplete="off" type="radio" name="amount" id="amount25" value="25">
                <label for="amount25">₹25</label>
              </div>
              <div class="denomination">
                <input autocomplete="off" type="radio" name="amount" id="amount50" value="50">
                <label for="amount50">₹50</label>
              </div>
              <div class="denomination">
                <input autocomplete="off" type="radio" name="amount" id="amount100" value="100">
                <label for="amount100">₹100</label>
              </div>
            </div>
            <div class="denomination-other">
                <input autocomplete="off" type="text" name="amount" value="" placeholder="Enter Other Amount">
              </div>
          </div>
        </div>
        <div class="donate-black donate-type">
          <h3>Donation type*</h3>
          <label>
                      <input type="radio" name="donation_type" value="single" checked="checked" autocomplete="off" class="required">
                      One-Time
          </label>
          <label>
                      <input type="radio" name="donation_type" value="recurring" autocomplete="off" class="required">
                      Monthly
          </label>
        </div>
        <div class="donate-blue donate-payment">
          <h3>Payment Method</h3>
          <div>
            <label>
              <input type="radio" name="payment" value="paypal" checked="checked" autocomplete="off">UPI
            </label>
            <label>
              <input type="radio" name="payment" value="crypto" autocomplete="off">Card
            </label>
          </div>
          <div class="donate-submit">
            <button type="submit" autocomplete="off">Donate ₹5</button>
            <p><small>Please note that contributions are not tax-deductible.</small></p>
          </div>
        </div>
        <a href="donate.php" style="display: inline-block; background-color: #4CAF50; color: white; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; border-radius: 5px;margin-left:200px;">Back</a>

      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script>
        $(".denomination").click(function(event) {
  $(".denomination").removeClass("selected").prop('checked', false);
  $(".denomination-other input").removeClass("selected").val('');
  $(this).addClass("selected");
  $(this).children(":first").prop('checked', true);
  $("button").text('Donate $' + $(this).children(":first").val())
});

$(".denomination-other input").on('keypress', function (event) {
  // allow only int values
  // TODO: remove leading 0
  var regex = new RegExp("^[0-9]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
  
  $(".denomination").removeClass("selected").prop('checked', false);
  $(this).addClass("selected");
  $("button").text('Donate $' + $(this).val() + key )
});



      </script>
    
</body>
</html>