function compatibilidadFormularios(form)
{
    // Setup form validation on the #register-form element
    $("#register-form").validate({
    
        // Specify the validation rules
		//usa el id para identificar campos (firstname)
        rules: {
            firstname: "required",
            lastname: "required",
            email: {
                required: true,
				regex: "/^(\d{3})TN(\d{4})$/",
                email: true
            },
            password: {
                required: true,
                minlength: 5
            },
            agree: "required"
        },
        
        // Specify the validation error messages
        messages: {
            firstname: "Please enter your first name",
            lastname: "Please enter your last name",
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
            },
            email: "Please enter a valid email address",
            agree: "Please accept our policy"
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });
}