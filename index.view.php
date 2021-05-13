
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- we used tailwind css for the purpose of design -->

  <script src="https://code.jquery.com/jquery-3.5.1.slim.js" integrity="sha256-DrT5NfxfbHvMHux31Lkhxg42LY6of8TaYyK50jnxRnM=" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <title>Nasswallet Payment gateway</title>
</head>

<body>
<center>

<button onclick="makePayment()" name="makepayment" class="bg-blue-500 rounded-lg px-4 
       py-2 font-semibold text-white 
       flex items-center outline-none 
       hover:bg-blue-600 focus:outline-none">
       
       <svg class="w-5 h-5 mr-2" id="credit_card_icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path>
                  <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path>
                </svg>
                Make Payment
    
              </button>
           
             </center>
             
             
              <script>
  
    function makePayment() {
      $("#credit_card_icon").addClass("animate-spin");
      $.ajax({
        type: "POST",
        url: 'index.php',
        async: true,
        data: {
          action: 'pay'
        },
        success: function(response) {

          window.location.assign(response);
           
          $("#credit_card_icon").removeClass("animate-spin");
         },
        error: function (error) {
        console.error(error);
        $("#credit_card_icon").removeClass("animate-spin");
       }
      });
    };

    
  </script>
              

</body>


</html>
