    function isEmail(email){
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email); 
    }

    $("#submit-button").click(function(){
        var errorMessage = "";
        var fieldsMissing = "";

        if($("#email").val() == "") fieldsMissing += "Email<br>";
        if($("#phone").val() == "") fieldsMissing += "Telephone<br>";
        if($("#password").val() == "") fieldsMissing += "Password<br>";
        if($("#confirmpassword").val() == "") fieldsMissing += "Confirm Password<br>";

        if (!isEmail($("#email").val())) errorMessage += "Email address not valid!<br>";
        if (!$.isNumeric($("#phone").val()) ) errorMessage += "Telephone not valid!<br>";
        if ($("#password").val() != $("#confirmpassword").val()) errorMessage += "Passwords don't match! <br>";

        if(fieldsMissing != "") fieldsMissing = "Please fill the following fields: <br>" + fieldsMissing;

        if(fieldsMissing == "" && errorMessage == "") $("#success-message").css("display", "block");
        else $("#success-message").css("display", "none");
        
        $("#error-message").html(errorMessage + "<br>" + fieldsMissing);
        


    });
