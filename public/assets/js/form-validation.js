jQuery(document).ready(function(){

    /*========== valid email check ========*/
    jQuery.validator.addMethod("regex", function(value, element, param) {
        return this.optional(element) || /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i.test(value);
    }, "Please enter a valid email address.");

    /*========== create user in users ========*/
    // $(document).on('submit','.general_form',function(e){
    //     e.preventDefault();
    //     $("input[type=submit]").attr("disabled", "disabled");
    //     $("button[type=submit]").attr("disabled", "disabled");
    //     let form = $(this)[0];
    //     formSubmitRedirect(form);
    // });

    $(document).on('click focus','.is-invalid',function(){
        $(this).removeClass('is-invalid');
        let name = $(this).attr('name');
        $('#'+name+'-error').hide();
    });

  /*===== create role =====*/
    jQuery('#createrole').validate({
        rules:
        {
            name: {
              required: true,
            },
        },
        messages:
        {
            name: {
              required: "Enter role"
            },
        },
        submitHandler : function(form)
        {
            formSubmitRedirect(form);
        }
    });
  /*===== End create role =====*/

  jQuery('#add_role').click(function(){
    jQuery('#role_savebtn').text('Add');
    $("#createrole").trigger("reset");
  });

  /*=== get role on edit click in role listing page ===*/
    jQuery(document).on('click','.editrole',function(){
        var id = jQuery(this).attr('data-id');
        jQuery('.roleid').val(id);
        var action = jQuery(this).attr('data-action');
        jQuery.ajax({
            type      : 'post',
            url       : action,
            data      : {id:id},
            headers   : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType  : 'json',
            success:function(response){
                if(response.success){
                    var res = response.data;
                    jQuery('#name').val(res.name);
                    jQuery('#role_savebtn').text('Update');
                }
            }
        });
    });

/*===== Create user =====*/
    $('#createuser').validate({ 
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true,
                regex: "",
            },
            password : {
              minlength : 5
            },            
        },
        messages: {
            name: {
                required: "Enter Name",
            },
            email: {
                required: "Enter Email",
                email: "Enter correct email address",
            },
        },
        submitHandler : function(form)
        {
            formSubmitRedirect(form);
        }
    });


/*===== update user =====*/
$('#updateuser').validate({ 
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true,
                regex: "",
            },
            password : {
              minlength : 5
            },            
        },
        messages: {
            name: {
                required: "Enter Name",
            },
            email: {
                required: "Enter Email",
                email: "Enter correct email address",
            },
        },
        submitHandler : function(form)
        {
            formSubmitRedirect(form);
        }
    });

/*===== create branch =====*/
    $('#createbranch').validate({ 
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true,
                regex: "",
            },
            address_line1 : {
              required: true,
            },            
        },
        messages: {
            name: {
                required: "Enter Name",
            },
            email: {
                required: "Enter Email",
                email: "Enter correct email address",
            },
            address_line1: {
                required: "Enter address1",
            },
        },
        submitHandler : function(form)
        {
            formSubmitRedirect(form);
        }
    });

    /*===== update branch =====*/
    $('#updatebranch').validate({ 
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true,
                regex: "",
            },
            address_line1 : {
              required: true,
            },            
        },
        messages: {
            name: {
                required: "Enter Name",
            },
            email: {
                required: "Enter Email",
                email: "Enter correct email address",
            },
            address_line1: {
                required: "Enter address1",
            },
        },
        submitHandler : function(form)
        {
            formSubmitRedirect(form);
        }
    });

    /*===== create consigner =====*/
    $('#createconsigner').validate({ 
        rules: {
            nick_name: {
                required: true
            },
            email: {
                required: true,
                email: true,
                regex: "",
            },
            address_line1 : {
                // required: true,
            },            
        },
        messages: {
            nick_name: {
                required: "Enter Name",
            },
            email: {
                required: "Enter Email",
                email: "Enter correct email address",
            },
            address_line1: {
                required: "Enter address1",
            },
        },
        submitHandler : function(form)
        {
            formSubmitRedirect(form);
        }
    });

    /*===== update consigner =====*/
    $('#updateconsigner').validate({ 
        rules: {
            nick_name: {
                required: true
            },
            email: {
                required: true,
                email: true,
                regex: "",
            },
            address_line1 : {
                // required: true,
            },            
        },
        messages: {
            nick_name: {
                required: "Enter Name",
            },
            email: {
                required: "Enter Email",
                email: "Enter correct email address",
            },
            address_line1: {
                required: "Enter address1",
            },
        },
        submitHandler : function(form)
        {
            formSubmitRedirect(form);
        }
    });

    /*===== create consignee =====*/
    $('#createconsignee').validate({ 
        rules: {
            nick_name: {
                required: true
            },
            email: {
                required: true,
                email: true,
                regex: "",
            },
            address_line1 : {
                // required: true,
            },            
        },
        messages: {
            nick_name: {
                required: "Enter Name",
            },
            email: {
                required: "Enter Email",
                email: "Enter correct email address",
            },
            address_line1: {
                required: "Enter address1",
            },
        },
        submitHandler : function(form)
        {
            formSubmitRedirect(form);
        }
    });

    /*===== update consignee =====*/
    $('#updateconsignee').validate({ 
        rules: {
            nick_name: {
                required: true
            },
            email: {
                required: true,
                email: true,
                regex: "",
            },
            address_line1 : {
                // required: true,
            },            
        },
        messages: {
            nick_name: {
                required: "Enter Name",
            },
            email: {
                required: "Enter Email",
                email: "Enter correct email address",
            },
            address_line1: {
                required: "Enter address1",
            },
        },
        submitHandler : function(form)
        {
            formSubmitRedirect(form);
        }
    });



});
/*======= End document ready fuction =======*/

/*======= form submit fuction =======*/

function formSubmit(form)
{
    jQuery.ajax({
        url         : form.action,
        type        : form.method,
        data        : new FormData(form),
        contentType : false,
        cache       : false,
        headers     : {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        processData : false,
        dataType    : "json",
        beforeSend  : function () {
            $(".load-main").show();
        },
        complete: function () {
            $(".load-main").hide();
        },
        success: function (response) {
            if(response.success){
                if(response.page == 'role'){
                    if(response.rolepage == 'rolepage'){
                        setTimeout(() => {window.location.href = response.redirect_url},1000);
                    }else{
                        // var allcountries = response.alldata;
                        // jQuery("#countrymodal").modal("hide");
                        // $(".country option").remove();
                        // $.each(allcountries, function(key, value) {
                        //     $('.country')
                        //     .append($("<option></option>")
                        //     .attr("value",value)
                        //     .text(key));
                        // });
                        // $('#proposal_regions').empty().append('<option value="">Please choose region</option> ');
                        // let country_id = $("#winery_country").val();
                        // getRegions(country_id);

                        // jQuery("#name-error").hide();
                        // jQuery("#country_id-error").hide();
                        // jQuery('.country').val(response.data.id);
                        // jQuery("#createcountry").trigger("reset");
                    }
                }
            }

            if(response.formErrors)
            {
                var i = 0;
                $.each(response.errors, function(index,value)
                {
                    if (i == 0) {
                        $("input[name='"+index+"']").focus();
                    }
                    $("input[name='"+index+"']").parents('.form-group').addClass('has-error');
                    $("input[name='"+index+"']").after('<label id="'+index+'-error" class="error" for="'+index+'">'+value+'</label>');
                    $("select[name='"+index+"']").parents('.form-group').addClass('has-error');
                    $("select[name='"+index+"']").after('<label id="'+index+'-error" class="has-error" for="'+index+'">'+value+'</label>');
                      i++;
                });
            }
        },
        error:function(response){
            console.error(response);
        }
    });
}
/*======= End form submit fuction =======*/


/*======= submit redirect fuction =======*/
function formSubmitRedirect(form)
{
    jQuery.ajax({
          url         : form.action,
          type        : form.method,
          data        : new FormData(form),
          contentType : false,
          cache       : false,
          headers     : {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          processData : false,
          dataType    : "json",
          beforeSend  : function () {
            // $(".load-main").show();
          },
          complete: function (response) {
            $("input[type=submit]").attr("enabled", "enabled");
        	$("button[type=submit]").attr("enabled", "enabled");
          },
          success: function (response)
          {
          	$.toast().reset('all');
      		var delayTime = 3000;
	        if(response.success){
	            $.toast({
		          heading             : 'Success',
		          text                : response.success_message,
		          loader              : true,
		          loaderBg            : '#fff',
		          showHideTransition  : 'fade',
		          icon                : 'success',
		          hideAfter           : delayTime,
		          position            : 'top-right'
		    	});
	        }
	        if(response.resetform)
            {
                $('#'+form.id).trigger('reset');
            }else if(response.page == 'user-update'){
                setTimeout(() => {window.location.href = response.redirect_url},500);
            }else if(response.page == 'role'){
                setTimeout(() => {window.location.href = response.redirect_url},1000);
            }else if(response.page == 'branch-update'){
                setTimeout(() => {window.location.href = response.redirect_url},500);
            }else if(response.page == 'consigner-update'){
                setTimeout(() => {window.location.href = response.redirect_url},500);
            }else if(response.page == 'consignee-update'){
                setTimeout(() => {window.location.href = response.redirect_url},500);
            }

            if(response.formErrors)
            {

	        }
		    var i = 0;
            $.each(response.errors, function( index, value )
            {
                if (i == 0) {
                    $("input[name='"+index+"']").focus();
                }
                var str=value.toString();
                if (str.indexOf('edit') != -1) {
                    // will not be triggered because str has _..
                    value=str.toString().replace('edit', '');
                }


                // $("input[name='"+index+"']").parents('.form-group').addClass('has-error');
                $("input[name='"+index+"']").after('<label id="'+index+'-error" class="has-error" for="'+index+'">'+value+'</label>');

                // $("textarea[name='"+index+"']").parents('.form-group').addClass('has-error');
                $("textarea[name='"+index+"']").after('<label id="'+index+'-error" class="has-error" for="'+index+'">'+value+'</label>');

                // $("select[name='"+index+"']").parents('.form-group').addClass('has-error');
                $("select[name='"+index+"']").after('<label id="'+index+'-error" class="has-error" for="'+index+'">'+value+'</label>');
                $("input[name='"+index+"']").addClass('is-invalid');
                $("select[name='"+index+"']").addClass('is-invalid');
                $("textarea[name='"+index+"']").addClass('is-invalid');
                i++;

            });
          $("input[type=submit]").removeAttr("disabled");
          $("button[type=submit]").removeAttr("disabled");
		    },
		    error:function(response){
		        $.toast({
		          heading             : 'Error',
		          text                : "Server Error",
		          loader              : true,
		          loaderBg            : '#fff',
		          showHideTransition  : 'fade',
		          icon                : 'error',
		          hideAfter           : 4000,
		          position            : 'top-right'
		        });
		    }
	    	
    });
}
/*======= End submit redirect fuction =======*/