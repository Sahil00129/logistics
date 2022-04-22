jQuery(document).ready(function(){

	/*======== check box checked create/update user permission page  ========*/
    jQuery(document).on('click','#ckbCheckAll',function(){
        if(this.checked){
            jQuery('#dropdownMenuButton').prop('disabled', false);
            jQuery('.chkBoxClass').each(function(){
                this.checked = true;
            });
        }
        else{
            jQuery('.chkBoxClass').each(function(){
                this.checked = false;
            });
            jQuery('#dropdownMenuButton').prop('disabled', true);
        }
    });

    jQuery(document).on('click','.chkBoxClass',function(){
        if($('.chkBoxClass:checked').length == $('.chkBoxClass').length){
            $('#ckbCheckAll').prop('checked',true);
            jQuery('#dropdownMenuButton').prop('disabled', false);
        }else{
            var checklength = $('.chkBoxClass:checked').length;
            if(checklength < 1){
                jQuery('#dropdownMenuButton').prop('disabled', true);
            }else{
                 jQuery('#dropdownMenuButton').prop('disabled', false);
            }
            $('#ckbCheckAll').prop('checked',false);
        }
    });
 	/*===== End check box checked create/update user permission page =====*/

  	/*===== delete User =====*/
    jQuery(document).on('click', '.delete_user', function(){
        jQuery('#deleteuser').modal('show');
        var userid =  jQuery(this).attr('data-id');
        var url =  jQuery(this).attr('data-action');
        jQuery(document).off('click','.deleteuserconfirm').on('click', '.deleteuserconfirm', function(){
           
            jQuery.ajax({
                type      : 'post',
                url       : url,
                data      : {userid:userid},
                headers   : {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType : "JSON",
                success:function(data){
                    if(data){
                        jQuery("#usertable").load(" #usertable");
                        jQuery("#deleteuser").modal("hide");
                    }
                }
            });
        });
    });
 	/*===== End delete User =====*/

  	/*===== delete Branch =====*/
    jQuery(document).on('click', '.delete_branch', function(){
        jQuery('#deletebranch').modal('show');
        var branchid =  jQuery(this).attr('data-id');
        var url =  jQuery(this).attr('data-action');
        jQuery(document).off('click','.deletebranchconfirm').on('click', '.deletebranchconfirm', function(){
           
            jQuery.ajax({
                type      : 'post',
                url       : url,
                data      : {branchid:branchid},
                headers   : {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType : "JSON",
                success:function(response){
                    if(response.success){
                        jQuery("#branchtable").load(" #branchtable");
                        jQuery("#deletebranch").modal("hide");
                    }
                    else{
                        jQuery("#deletebranch").modal("hide");
                        jQuery('html,body').animate({ scrollTop: 0 }, 'slow');
                        jQuery('.branch_error').show();
                        setTimeout(function(){
                         jQuery('.branch_error').fadeOut();
                       },5000);
                    }
                }
            });
        });
    });
 	/*===== End delete Branch =====*/

    /*===== delete Consigner =====*/
    jQuery(document).on('click', '.delete_consigner', function(){
        jQuery('#deleteconsigner').modal('show');
        var consignerid =  jQuery(this).attr('data-id');
        var url =  jQuery(this).attr('data-action');
        jQuery(document).off('click','.deleteconsignerconfirm').on('click', '.deleteconsignerconfirm', function(){
           
            jQuery.ajax({
                type      : 'post',
                url       : url,
                data      : {consignerid:consignerid},
                headers   : {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType : "JSON",
                success:function(data){
                    if(data){
                        jQuery("#consignertable").load(" #consignertable");
                        jQuery("#deleteconsigner").modal("hide");
                    }
                }
            });
        });
    });
    /*===== End delete Consigner =====*/

    /*===== delete Consignee =====*/
    jQuery(document).on('click', '.delete_consignee', function(){
        jQuery('#deleteconsignee').modal('show');
        var consigneeid =  jQuery(this).attr('data-id');
        var url =  jQuery(this).attr('data-action');
        jQuery(document).off('click','.deleteconsigneeconfirm').on('click', '.deleteconsigneeconfirm', function(){
           
            jQuery.ajax({
                type      : 'post',
                url       : url,
                data      : {consigneeid:consigneeid},
                headers   : {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType : "JSON",
                success:function(data){
                    if(data){
                        jQuery("#consigneetable").load(" #consigneetable");
                        jQuery("#deleteconsignee").modal("hide");
                    }
                }
            });
        });
    });
    /*===== End delete Consignee =====*/

    /*===== delete Broker =====*/
    jQuery(document).on('click', '.delete_broker', function(){
        jQuery('#deletebroker').modal('show');
        var brokerid =  jQuery(this).attr('data-id');
        var url =  jQuery(this).attr('data-action');
        jQuery(document).off('click','.deletebrokerconfirm').on('click', '.deletebrokerconfirm', function(){
           
            jQuery.ajax({
                type      : 'post',
                url       : url,
                data      : {brokerid:brokerid},
                headers   : {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType : "JSON",
                success:function(data){
                    if(data){
                        jQuery("#brokertable").load(" #brokertable");
                        jQuery("#deletebroker").modal("hide");
                    }
                }
            });
        });
    });
    /*===== End delete Broker =====*/

    /*===== delete Driver =====*/
    jQuery(document).on('click', '.delete_driver', function(){
        jQuery('#deletedriver').modal('show');
        var driverid =  jQuery(this).attr('data-id');
        var url =  jQuery(this).attr('data-action');
        jQuery(document).off('click','.deletedriverconfirm').on('click', '.deletedriverconfirm', function(){
           
            jQuery.ajax({
                type      : 'post',
                url       : url,
                data      : {driverid:driverid},
                headers   : {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType : "JSON",
                success:function(data){
                    if(data){
                        jQuery("#drivertable").load(" #drivertable");
                        jQuery("#deletedriver").modal("hide");
                    }
                }
            });
        });
    });
    /*===== End delete Driver =====*/

    // branch image add more    
    $(".add_more_images").click(function(){
       
        var c = $('.images').length;
        c  = c + 1;
        var rows = '';
        if(x < max_fields){ //max input box allowed
            x++; //text box increment

            rows+='<div class="images mt-3 col-md-2"><div class="row">';
            rows+='<div class="col-md-2">';
            rows+='<input type="file" data-id="'+c+'" name="files[]" class="first"/>';
            rows+='<p style="display:none;color:red" class="gif-errormsg'+c+'">Invalid image format</p>';
            rows+='</div>';
            rows+='<a href="javascript:void(0)" class="btn-danger remove_field" style="margin: 5px 0 0 160px">';
            rows+='<i class="ml-2 fa fa-trash"></a>';
            rows+='</div></div>'; 
            
            $('.branch-image').append(rows);

        }
        else{
            $("#error-msg").css("display", "block");
            // $(".add_more_images").css("display", "none");
            $(".add_more_images").attr("disabled", true);
        }
        var html = $("#branch-upload").html();
        $(".after-add-more").after(html);
        $(".change").append("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");
    });

    $('input[type="file"]').change(function(event) {
        var _size = this.files[0].size;
        var exactSize = Math.round(_size/(1024*1024));
        //console.log('FILE SIZE = ',exactSize);
        if (exactSize >="5") {
           $("#size-error").show();
        }
        else {
           $("#size-error").hide();
        }
    });

    // Delete branch Image from updatebranch view //
    $(document).on('click', '.deletebranchimg', function () {
        let id = $(this).attr('data-id');
        $("#deletebranchimgpop").modal('show');
        jQuery('.deletebranchimgdata').attr('data-id',id);
    });

    ///// Delete branch Image Method /////
    $('body').on('click', '.deletebranchimgdata', function () {
        let id  = jQuery(this).attr('data-id');
        var url = jQuery(this).attr('data-action');

        jQuery.ajax({
            type     : "post",
            data     : {branchimgid:id},
            url      : url,
            dataType : "JSON",
            headers  : {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success : function (data) {
                if(data){
                    jQuery("#deletebranchimgpop").modal("hide");
                    location.reload();
                }
            }
        });
    });

    // Delete driverlicense Image from updatedriver view //
    $(document).on('click', '.deletelicenseimg', function () {
        let id = $(this).attr('data-id');
        let driverlicenseimg = $(this).attr('data-licenseimg');

        $("#deletedriverlicenseimgpop").modal('show');
        jQuery('.deletedriverlicenseimgdata').attr('data-id',id);
        jQuery('.deletedriverlicenseimgdata').attr('data-driverlicenseimg',driverlicenseimg);
    });

    ///// Delete driverlicense Image Method /////

    $('body').on('click', '.deletedriverlicenseimgdata', function () {
        let id = jQuery(this).attr('data-id');
        let driverlicenseimg = jQuery(this).attr('data-driverlicenseimg');
        var url = jQuery(this).attr('data-action');

        jQuery.ajax({
            type     : "post",
            data     : {licenseimgid:id,driverlicenseimg:driverlicenseimg},
            url      : url,
            dataType : "JSON",
            headers  : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success : function (data) {
                if(data){
                    jQuery(".license-load").load(".license-load");
                    $(".deletelicenseimg").hide();
                  
                    jQuery("#deletedriverlicenseimgpop").modal("hide");
                    location.reload();
                }
            }
        });
    });

    // Delete Broker pancard and cancelcheque Image from updatebroker view //
    $(document).on('click', '.deletebrokerimg', function () {
        let id = $(this).attr('data-id');
        let cancelchequeimg = $(this).attr('data-cancelchequeimg');
        let pancardimg = $(this).attr('data-pancardimg');

        $("#deletebrokerimgpop").modal('show');
        jQuery('.deletebrokerimgdata').attr('data-id',id);
        jQuery('.deletebrokerimgdata').attr('data-pancardimg',pancardimg);
        jQuery('.deletebrokerimgdata').attr('data-cancelchequeimg',cancelchequeimg);
    });

    ///// Delete Broker Image Method /////

    $('body').on('click', '.deletebrokerimgdata', function () {
        let id = jQuery(this).attr('data-id');
        let cancelchequeimg = jQuery(this).attr('data-cancelchequeimg');
        // let cancelchequeimg = jQuery(this).attr('data-cancelchequeimg');
        var url = jQuery(this).attr('data-action');

        jQuery.ajax({
            type     : "post",
            data     : {brokerimgid:id,cancelchequeimg:cancelchequeimg},
            url      : url,
            dataType : "JSON",
            headers  : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success : function (data) {
                if(data){
                    if(data.delpan_card == "delpan_card"){
                        jQuery(".pancard-load").load(".pancard-load");
                        $(".deletebrokerimg").hide();
                    }
                    else{
                        jQuery(".cancelcheque-load").load(".cancelcheque-load");
                        $(".deletebrokerimg").hide();
                    }
                    jQuery("#deletebrokerimgpop").modal("hide");
                    location.reload();
                }
            }
        });
    });

    //// get create pending payment in view detail page ////

    jQuery(document).on('click','.addpendingpayament',function(){
        var maplocationid = jQuery(this).attr('data-id');
        var purchaseprice = jQuery(this).attr('data-purchaseprice');
        var pendingprice = jQuery(this).attr('data-pendingprice');
        var pur_price = $('.purchase_price').val(purchaseprice);
        jQuery('.maplocid').val(maplocationid);

        var action = jQuery(this).attr('data-action');

        jQuery.ajax({
          type      : 'post',
          url       : action,
          // data      : {maplocationid:maplocationid},
          headers   : {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          dataType  : 'json',
          success:function(response){
            if(response.success){
                location.reload();
            }
          }
        });
      });

     
    // end create payment page get pending payment

    
    // jQuery('.releaseinputforinternal').donetyping(function(callback){
    //     var inputval = jQuery(this).val();
    //     var availcases = jQuery('.availcases').val();
    //     if(parseInt(inputval) > parseInt(availcases)){
    //         jQuery(this).val(availcases);
    //     }
    // });



});
/*====== End document ready function =====*/ 
