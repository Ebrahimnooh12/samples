$(document).ready(function(){ 
  //pass your public key from tap's dashboard
  var tap = Tapjsli('pk_test_EtHFV4BuPQokJT6jiROls87Y');

  var elements = tap.elements({});

  var style = {
  base: {
      color: '#535351',
      lineHeight: '20px',
      fontFamily: 'sans-serif',
      fontSmoothing: 'antialiased',
      fontSize: '16px',
      '::placeholder': {
      color: 'rgba(0, 0, 0, 0.26)',
      fontSize:'15px'
      }
  },
  invalid: {
      color: 'red'
  }
  };
  // input labels/placeholders
  var labels = {
      cardNumber:"Card Number",
      expirationDate:"MM/YY",
      cvv:"CVV",
      cardHolder:"Card Holder Name"
  };
  //payment options
  var paymentOptions = {
  currencyCode:["BHD"],
  labels : labels,
  TextDirection:'ltr'
  }
  //create element, pass style and payment options
  var card = elements.create('card', {style: style},paymentOptions);
  //mount element
  card.mount('#element-container');
  //card change event listener
  card.addEventListener('change', function(event) {
  if(event.loaded){
      console.log("UI loaded :"+event.loaded);
      console.log("current currency is :"+card.getCurrency());
      document.getElementById("loader").style.display = "none";
      document.getElementById("content").style.display = "block";
  }

  
  var displayError = document.getElementById('error-handler');
  if (event.error) {
      displayError.style.display='block';
      displayError.textContent = event.error.message;
  } else {
      displayError.style.display='none';  
      displayError.textContent = '';
  }
});

  $( "#clear-btn" ).click(function() {
        card.clearForm()
  });


  var form = document.getElementById('form-container');
  form.addEventListener('submit', function(event) {
  event.preventDefault();
  document.getElementById("loader").style.display = "block";

  tap.createToken(card).then(function(result) {
      console.log(result);
      if (result.error) {
      var errorElement = document.getElementById('error-handler');
      errorElement.textContent = result.error.message;
      } else {
      var errorElement = document.getElementById('success');
      errorElement.style.display = "block";
    //   var tokenElement = document.getElementById('token');
    //   tokenElement.textContent = result.id;
      tapTokenHandler(result,card.getCurrency());
      }
  });
  
  });

});
  
  function tapTokenHandler(token,currency) {
      var form = document.getElementById('form-container');
      var tokenHiddenInput = document.createElement('input');
      tokenHiddenInput.setAttribute('type', 'hidden');
      tokenHiddenInput.setAttribute('name', 'tapToken');
      tokenHiddenInput.setAttribute('value', token.id);

      var currencyHiddenInput = document.createElement('input');
      currencyHiddenInput.setAttribute('type', 'hidden');
      currencyHiddenInput.setAttribute('name', 'currency');
      currencyHiddenInput.setAttribute('value', currency);

      form.appendChild(tokenHiddenInput);
      form.appendChild(currencyHiddenInput);
  
      form.submit();
  }

