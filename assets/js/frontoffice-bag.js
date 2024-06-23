
function verify_ship_form(){
    let Adress_value = document.getElementById("Adress-input").value;
    let Postcode_value = document.getElementById("Postcode-input").value;
    let City_value = document.getElementById("City-input").value;
    if (Adress_value && Postcode_value && City_value) {
        console.log("Adress :" + Adress_value + "\nPostcode :" + Postcode_value + "\nCity :" + City_value);
        document.getElementById("Adress").innerText=Adress_value;
        document.getElementById("Postcode").innerText=Postcode_value;
        document.getElementById("City").innerText=City_value;

         setTimeout(function() {
            document.getElementById("ship").setAttribute("class","section");
            document.getElementById("pay").setAttribute("class","section enabled");
            document.getElementById("ship-form").setAttribute("class","disabled");
            document.getElementById("pay-form").setAttribute("class","");
            document.getElementById("ship-info").setAttribute("class","");
            document.getElementById("ship-span").innerText="";
            document.getElementById("ship-check").checked=true;
         },100);
    }
    else{
        document.getElementById("exception").innerHTML = "You should fill the Adress, Post code and City input";
        $('#ExceptionModal').modal('show');
    }
}

function edit_ship(){
    setTimeout(function() {
        document.getElementById("ship").setAttribute("class","section enabled");
        document.getElementById("pay").setAttribute("class","section");
        document.getElementById("ship-form").setAttribute("class","");
        document.getElementById("pay-form").setAttribute("class","disabled");
        document.getElementById("ship-info").setAttribute("class","disabled");
        document.getElementById("ship-span").innerText="1";
        document.getElementById("ship-check").checked=false;
    },100);
}

document.addEventListener('DOMContentLoaded', function() {
    var radioContainers = document.querySelectorAll('.radio');

    radioContainers.forEach(function(container) {
        var radio = container.querySelector('input[type="radio"]');

        radio.addEventListener('change', function() {
            radioContainers.forEach(function(c) {
                c.classList.remove('check');
            });

            if (radio.checked) {
                container.classList.add('check');
            }
        });
    });
});

