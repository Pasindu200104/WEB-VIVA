<!DOCTYPE html>
<html lang="en">
    <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>SPC</title>
    </head>
    
    <div id="card_container"></div>
    
    <body>
           <script src="https://cdn.directpay.lk/dev/v1/directpayCardPayment.js?v=1"></script>
           <script>
              DirectPayCardPayment.init({
                 container: "card_container", //<div id="card_container"></div>
                 merchantId: 'EC15338',
                 type: 'ADD_CARD',
                 currency: 'LKR',
                 refCode: '1566895327605', //Unique value for identify the card holder.
                 customerEmail: 'abc@mail.com',
                 customerMobile: '+94712584756',
                 cardNickname: 'My Card',
                 debug: true,
                 responseCallback: responseCallback,
                 errorCallback: errorCallback,
                 logo: 'https://www.roarafrica.com/wp-content/uploads/2017/11/sample-logo.png',
                 apiKey: '2bdf8ca5303622105a485edfed0d3999bdc7dbf5132a0d174dedeec3d2863441',
              });

              //response callback.
              function responseCallback(result) {
                 console.log("successCallback-Client", result);
                 alert(JSON.stringify(result));
              }

              //error callback
              function errorCallback(result) {
                 console.log("successCallback-Client", result);
                 alert(JSON.stringify(result));
              }
           </script>
    </body>
</html>
