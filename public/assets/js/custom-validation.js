jQuery(document).ready(function(){

	/*======== check box checked  create/update user permission page  ========*/
    jQuery(document).on('click','#ckbCheckAll',function(){
        // var getsearchmodel = jQuery(this).attr('data-search');
        // if(getsearchmodel == 'category'){
        //     if(this.checked){
        //         jQuery('#search-category .checkbox').each(function(){
        //           this.checked = true;
        //         });
        //     }else{
        //         jQuery('#search-category .checkbox').each(function(){
        //           this.checked = false;
        //         });
        //     }
        // } 
        // else{
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
        // }
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

    // wine image add more

    let max_fields = 3;
    var x = 1;
    
    $(".add_more_images").click(function(){
       
        var c = $('.images').length;
        c  = c + 1;
        var rows = '';
        if(x < max_fields){ //max input box allowed
            x++; //text box increment

            rows+='<div class="images mt-3"><div class="row">';
            rows+='<div class="col-md-2"><span class="file bg-brown rounded btn-md">';
            rows+='<input type="file" data-id="'+c+'" name="files[]" class="first"/>';
            rows+='<i class="fa fa-plus"></i> Add file</span>';
            rows+='<p style="display:none;color:red" class="gif-errormsg'+c+'">Invalid image format</p>';
            rows+='</div>';
            // rows+='<div class="col-md-10 pl-0 imgsrc'+c+'">';
            // // rows+='<span class="file_info">No files selected</span>';
            // rows+='<div class="image_upload">';
            // rows+='<img src="#" class="firstshow'+c+' image-fluid" style="display: none;">';
            // rows+='</div><a href="javascript:void(0)" class="remove_field">';
            // rows+='<i class="ml-2 red-text fa fa-trash"></div></div></div>';

            // add new //
            rows+='<a href="javascript:void(0)" class="remove_field">';
            rows+='<i class="ml-2 red-text fa fa-trash">';
            rows+='</div></div>';  
            // end add new //
            
            $('.wine-image').append(rows);

        }
        else{
            $("#error-msg").css("display", "block");
            // $(".add_more_images").css("display", "none");
            $(".add_more_images").attr("disabled", true);
        }
        var html = $("#wine-upload").html();
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

    $(document).on("click",".remove_field", function(e){ //user click on remove text   
        // $(this).parent('div').remove(); 
        // $(this).parent().parent().parent().remove();
        $(this).parent().remove();
        x--;
        // $(".add_more_images").css("display", "block");
        $(".add_more_images").attr("disabled", false);
        $("#error-msg").css("display", "none");
    });



});
/*====== End document ready function =====*/ 
