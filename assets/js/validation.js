$("form[name='dr-login']").validate({
    rules: { 
    email: {
        required:true,
        email: true
      },
      password: {
        required: true
      }

    },
errorPlacement: function(error, element) {
         
                error.insertAfter(element.parent());
           
},

    submitHandler: function(form) {
      form.submit();
    }
  });