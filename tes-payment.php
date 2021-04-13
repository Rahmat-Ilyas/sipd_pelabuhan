<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="admin/images/anchor.png" type="image/ico" />

  <title>SIPDP Pelabuhan Pamatata</title>

  <!-- Bootstrap -->
  <link href="admin/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="admin/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
  <div class="container">
    <div class="text-center">
      <button class="btn btn-primary btn-lg mt-5" id="pay-button">Bayar Sekarang</button>
    </div>
  </div>

  <!-- <script id="midtrans-script" type="text/javascript" src="https://api.midtrans.com/v2/assets/js/midtrans-new-3ds.min.js" data-environment="sandbox" data-client-key="SB-Mid-client-tst84O1Wc088OdX0"></script> -->
  <!-- <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-tst84O1Wc088OdX0"></script> -->
  <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-tst84O1Wc088OdX0"></script>

  <script src="admin/vendors/jquery/dist/jquery.min.js"></script>
  <script src="admin/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    $(document).ready(function() {
      // var payButton = document.getElementById('pay-button');
      // // For example trigger on button clicked, or any time you need
      // payButton.addEventListener('click', function () {
      //   snap.pay('SNAP_TRANSACTION_TOKEN'); // Replace it with your transaction token
      // });

      $('#pay-button').click(function(e) {
        e.preventDefault();

        $.ajax({
          url     : 'users/controller.php',
          method  : "POST",
          data    : { 
            midtrans_config: true
          },
          success : function(data) {
            snap.pay(data);
          }
        });
      });
      // card data from customer input, for examplevar 
      // cardData = {
      //   "card_number": 4811111111111114,
      //   "card_exp_month": 02,
      //   "card_exp_year": 2025,
      //   "card_cvv": 123,
      // }; 
      // callback functionsvar 
      // options = {  
      //   onSuccess: function(response){
      //     // Success to get card token_id, implement as you wish here    
      //     console.log('Success to get card token_id, response:', response);    
      //     var token_id = response.token_id;     
      //     console.log('This is the card token_id:', token_id);    
      //     // Implement sending the token_id to backend to proceed to next step  
      //   },
      //   onFailure: function(response){
      //     // Fail to get card token_id, implement as you wish here
      //     console.log('Fail to get card token_id, response:', response);
      //     // you may want to implement displaying failure message to customer.
      //     // Also record the error message to your log, so you can review
      //     // what causing failure on this transaction.
      //   }
      // }; 
      // trigger `getCardToken` functionMidtransNew3ds.
      // MidtransNew3ds.getCardToken(cardData, options);
    });
  </script>

</body>
</html>