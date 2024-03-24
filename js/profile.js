$(document).ready(function () {

    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

    //Validate email pattern
    function isValidEmail(email) {
        return emailPattern.test(email);
    }

    // Validate selector value
    function isValidSelector(id, value, message) {
        let selector = $(id).val();
        if (selector == value) {
            $(id).css('color', 'red');
            alert(message)
            $(id).click(function () {
                $(this).css('color', 'black');
            });
        } else {
            $("#country-selector").css('color', 'black');
        }
    }
    // From Submission handler

    $("#myform").submit(function (event) {
        event.preventDefault();


        // Get the entered email address
        let email = $("#emailInput").val();


        // Check if email is valid
        if (!isValidEmail(email)) {
            alert("Enter a valid email")
        }

        // Valid Country selector
        isValidSelector('#country-selector', 'SYC', 'Select a valid Country');
        //Valid Gender Selector
        isValidSelector('#gender', "", 'Select Gender');



    })


    $("#myform").validate({
        rules: {

            phone: {
                required: true,
                number: true,
                minlength: 10
            }

        }
    });
});