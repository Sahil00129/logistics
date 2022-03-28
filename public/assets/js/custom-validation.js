jQuery(document).ready(function(){

	/*======== check box checked  create/update user permission page  ========*/
    jQuery(document).on('click','#ckbCheckAll',function(){
        var getsearchmodel = jQuery(this).attr('data-search');
        if(getsearchmodel == 'category'){
            if(this.checked){
                jQuery('#search-category .checkbox').each(function(){
                  this.checked = true;
                });
            }else{
                jQuery('#search-category .checkbox').each(function(){
                  this.checked = false;
                });
            }
        } 
        else{
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

  	/*===== delete user =====*/
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
 	/*===== End delete user =====*/

  	/*===== delete branch =====*/
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
                success:function(data){
                    if(data){
                        jQuery("#branchtable").load(" #branchtable");
                        jQuery("#deletebranch").modal("hide");
                    }
                }
            });
        });
    });
 	/*===== End delete branch =====*/

    /*===== delete consigner =====*/
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
    /*===== End delete consigner =====*/


});
/*====== End document ready function =====*/ 
