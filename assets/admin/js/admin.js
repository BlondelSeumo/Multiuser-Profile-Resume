

jQuery(function($) {

	"use strict";


  var loading_html = '<div class="spinner"><div class="rect1" style="margin-right: 1px;"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
  var base_url = $('#base_url').val();

  $('[data-toggle="tooltip"]').tooltip(); 
	
  $('.datatable').dataTable();


    $(document).on('change', '.btn-file :file', function() {
      var input = $(this),
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
      input.trigger('fileselect', [label]);
    });


    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#img-upload').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }


    $("#imgInp").on('change', function() {
        readURL(this);
    });   



    $(".checkcolor").on('click', function() {
      var $box = $(this);
      if ($box.is(":checked")) {
        var group = "input:checkbox[name='" + $box.attr("name") + "']";
        $(group).prop("checked", false);
        $box.prop("checked", true);
      } else {
        $box.prop("checked", false);
      }
    });


    $(".check_all").on('click', function() {

        $('input:checkbox').not(this).prop('checked', this.checked);
        
        if ($(".check_all").is(":checked")) {
            $(".multiple_delete_btn").show()
        } else {
            $(".multiple_delete_btn").hide()
        }
    });



    $(".checkItem").on('click', function() {
        if ($(".checkItem").is(":checked")) {
            $(".multiple_delete_btn").show()
        } else {
            $(".multiple_delete_btn").hide()
        }
    });

    $(document).on('click', ".set_layout", function() {
        var designId = $(this).val();
        var url = base_url+'admin/profile/change_layout/'+designId;
        $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
           if(json.st == 1){
                
              swal({
                  title: "Success",
                  text: 'Layout changes successfully',
                  type: "success",
                  showConfirmButton: true
              }, function(){
                  window.location.reload();
              });

            }
        }, 'json' );
        return false;
    });
    

    $(function(){

        $(document).on('submit', "#cahage_pass_form", function() {

            $.post($('#cahage_pass_form').attr('action'), $('#cahage_pass_form').serialize(), function(json){

                if (json.st == 1) {
                    $('#cahage_pass_form')[0].reset();
                    swal({
                          title: "Congratulations!",
                          text: "Your Password has been changed Successfully",
                          type: "success",
                          showConfirmButton: true
                    });
                }else if (json.st == 2) {
                    $('#cahage_pass_form')[0].reset();
                    swal({
                      title: "Opps !",
                      text: "Your Confirm Password doesn't Match",
                      type: "error",
                      showConfirmButton: true
                    });
                }else {
                    $('#cahage_pass_form')[0].reset();
                    swal({
                      title: "Error!",
                      text: "Your Old Password doesn't Match",
                      type: "error",
                      showConfirmButton: true
                    });
                }
            },'json');
            return false;
        });

    });




    $(document).on('click', "#make_embaded", function() {

        var url = $("#video_url").val();
        var post_data = {
            'url': url,
            'csrf_test_name' : csrf_token
        };

        $.ajax({
            type: "POST",
            url: base_url + "admin/video/generate_embed_code",
            data: post_data,
            success: function (response) {
                $("#video_embed_code").html(response);
                if (response != "Invalid Url") {
                    $("#video_preview").attr('src', response);
                    $("#video_play_icon").hide();
                }
            }
        });


        $.ajax({
            type: "POST",
            url: base_url + "admin/video/get_video_thumbnails",
            data: post_data,
            success: function (response) {
                $("#video_thumbnails_url").val(response);
                $("#video_thumbnails_img").attr('src', response);
            }
        });

    });



    $(document).on('click', ".approve_img", function() {
        var imgId = $(this).attr('data-id');

        var url = base_url+'admin/photos/approve_img/0/'+imgId;
        $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
           if(json.st == 1){
                swal({
                  title: "Success",
                  text: "Image has been approved.",
                  type: "success",
                  showCancelButton: false
                }),
                $('#img_'+imgId).slideUp();
            }
        }, 'json' );
        return false;
    });


    $(document).on('click', ".add_featured", function() {
        var imgId = $(this).attr('data-id');

        var url = base_url+'admin/photos/approve_img/1/'+imgId;

        $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
           if(json.st == 1){
                swal({
                  title: "Success",
                  text: "Image has been approved and selected featured.",
                  type: "success",
                  showCancelButton: false
                }),
                $('#img_'+imgId).slideUp();
            }
        }, 'json' );
        return false;
    });


    $(document).on('click', ".reject_img", function() {
        var imgId = $(this).attr('data-id');

        var url = base_url+'admin/photos/reject_img/'+imgId;

        $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
           if(json.st == 1){
                swal({
                  title: "Success",
                  text: "Image has been rejected.",
                  type: "success",
                  showCancelButton: false
                }),
                $('#img_'+imgId).slideUp();
            }
        }, 'json' );
        return false;
    });


    $(document).on('change', ".sort", function() {
        $('.sort_form').submit();
    });

    
    $(document).on('click', ".add_btn", function() {
        $('.add_area').show();
        $('.list_area').hide();
        return false;
    });

    $(document).on('click', ".cancel_btn", function() {
        $('.add_area').hide();
        $('.list_area').show();
        return false;
    });


    $(document).on('click', ".scheduled_post", function() {
        $('.date_area').slideToggle();
        $('this').checked();
        return false;
    });


    $(document).on('change', "#category", function() {
        var catId = $(this).val();
        if(catId != ''){
            var url = base_url+'admin/post/load_subcategory/'+catId;
                $.post(url,{ data: 'value', 'csrf_test_name': csrf_token },function(data){
                    $('#sub_category').html(data);
                    $('#sub_category').prop('disabled', false);
                }
            );
        }  
    });

  


    $(document).on('click', ".delete_item", function() {

        var del_url = $(this).attr('href');
        var imgId = $(this).attr('data-id');


            swal({
              title: "Are you sure?",
              text: "You will not be able to recover this file",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes, delete it!",
              closeOnConfirm: false
            },
            function(){ 

                $.post(del_url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
                    if(json.st == 1){     
                        swal({
                          title: "Success",
                          text: "Deleted successfully",
                          type: "success",
                          showCancelButton: false
                        }),                
                        $("#row_"+imgId).slideUp();
                    }
                },'json');

            });

        return false;

    });
    


    $(document).on('click', ".change_pass", function() {
        $('.change_password_area').slideDown();
        $('.edit_account_area').hide();
        $("html, body").animate({ scrollTop: 200 }, "slow");
        return false;
    });

    $(document).on('click', ".cancel_pass", function() {
        $('.change_password_area').hide();
        $('.edit_account_area').slideDown();
        return false;
    });





});