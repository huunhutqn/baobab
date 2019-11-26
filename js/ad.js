// $('.submit-edit').click(function(event) {
//     $this = $(this);
//     jQuery.ajax({
//       url: 'update_room/',
//       type: 'POST',
//       dataType: 'json',
//       data: {
//         roomid: $(this).parent().parent().find('#room_id').attr('value'),
//         roomname: $(this).parent().parent().find('.room-name').attr('value'),
//         roomprice: $(this).find('#room_id').attr('value'),
//         roomshortdesc: $(this).parent().parent().find('.room-short-desc').val(),
//         roomlongdesc: $(this).parent().parent().find('.room-long-desc').val(),
//         roomgallery: $(this).parent().parent().find('.update-multiple-images').attr('name'),
//         roompeople: $(this).parent().parent().parent().parent().find('.room-name').attr('value'),
//         features: $(this).find('#room_id').attr('value')
//         },
//       complete: function(xhr, textStatus) {
//         //called when complete
//         //console.log($this.find('#room_id').attr('value'));
//         $('[data-toggle="tooltip"]').tooltip("hide");
//         $this.parents(".room_detail").css("opacity", "0");
//         setTimeout(function(){
//             $this.parents(".room_detail").remove();
//         }, 2000);
        
//       },
//       success: function(data, textStatus, xhr) {
//         //called when successful
//         // console.log(data);
//       },
//       error: function(xhr, textStatus, errorThrown) {
//         //called when there is an error
//         // console.log('error');
//       }
//     });
            
// });    
        /* Act on the event */
        // console.log($(this).find('#room_id').attr('value'));
        // alert("The paragraph was clicked.");
        // console.log('lol');
        $('.delete_room').click(function(event) {
            $this = $(this);
            jQuery.ajax({
              url: 'remove_room/',
              type: 'POST',
              dataType: 'json',
              data: {id: $(this).find('#room_id').attr('value')},
              complete: function(xhr, textStatus) {
                //called when complete
                //console.log($this.find('#room_id').attr('value'));
                $('[data-toggle="tooltip"]').tooltip("hide");
                $this.parents(".room_detail").css("opacity", "0");
                setTimeout(function(){
                    $this.parents(".room_detail").remove();
                }, 2000);
                
              },
              success: function(data, textStatus, xhr) {
                //called when successful
                // console.log(data);
              },
              error: function(xhr, textStatus, errorThrown) {
                //called when there is an error
                // console.log('error');
              }
            });
            
        });
function validateMyForm(){
    $pw = $('#password').val();
    $rpw = $('#rpassword').val();

    if(($pw == '') && ($rpw == ''))
    {
        $('#password').focus();
        return false;
    }
    else {
        if ($rpw != $pw) {
            alert('Vui lòng xác nhận đúng mật khẩu mới.');
            $('#rpassword').focus();
            return false;
        } else return true;
    }
}
// start table
    $(function() {

      $("table").tablesorter({
        theme : "bootstrap",

        widthFixed: true,

        // widget code contained in the jquery.tablesorter.widgets.js file
        // use the zebra stripe widget if you plan on hiding any rows (filter widget)
        // the uitheme widget is NOT REQUIRED!
        widgets : [ "filter", "columns", "zebra" ],

        widgetOptions : {
          // using the default zebra striping class name, so it actually isn't included in the theme variable above
          // this is ONLY needed for bootstrap theming if you are using the filter widget, because rows are hidden
          zebra : ["even", "odd"],

          // class names added to columns when sorted
          columns: [ "primary", "secondary", "tertiary" ],

          // reset filters button
          filter_reset : ".reset",

          // extra css class name (string or array) added to the filter element (input or select)
          filter_cssFilter: [
            'form-control',
            'form-control',
            // 'form-control custom-select', // select needs custom class names :(
            'form-control',
            'form-control',
            'form-control',
            'form-control',
            'form-control',
            'form-control',
            'form-control'
          ]

        }
      })
      .tablesorterPager({

        // target the pager markup - see the HTML block below
        container: $(".ts-pager"),

        // target the pager page select dropdown - choose a page
        cssGoto  : ".pagenum",

        // remove rows from the table to speed up the sort of large tables.
        // setting this to false, only hides the non-visible rows; needed if you plan to add/remove rows with the pager enabled.
        removeRows: false,

        // output string - default is '{page}/{totalPages}';
        // possible variables: {page}, {totalPages}, {filteredPages}, {startRow}, {endRow}, {filteredRows} and {totalRows}
        output: '{startRow} - {endRow} / {filteredRows} ({totalRows})'

      });


    });
    // end table
    $('.cancel-ecl').click(function(event) {
        resetEcl();
        $('#editCPModal').modal('hide');
    });
    $('.submit-ecl').click(function(event) {
        $('#alertPModal').modal({backdrop: 'static',keyboard: false});
        $client_id = $(this).parent().find('input[name="client_id"]').val();
        $fullname = $(this).parent().find('input[name="fullname"]').val();
        $email = $(this).parent().find('input[name="email"]').val();
        $address = $(this).parent().find('input[name="address"]').val();
        $phone = $(this).parent().find('input[name="phone"]').val();
        $status = $(this).parent().find('select[name="status"]').children("option:selected").val();
        jQuery.ajax({
            url: 'client_modify',
            type: 'POST',
            dataType: 'json',
            data: {
                client_id: $client_id,
                fullname: $fullname,
                email: $email,
                phone: $phone,
                address: $address,
                status: $status
            },
            complete: function(xhr, textStatus) {
              //called when complete
            },
            success: function(data, textStatus, xhr) {
              //called when successful
              if(data == 'ok'){
                setTimeout(function(){
                    resetEcl();
                    $('#alertPModal').find('.text-pro').addClass('d-none');
                    $('#alertPModal').find('.text-success').text('Đã cập nhật thông tin thành công');

                    setTimeout(function(){
                        $('#alertPModal').modal('hide');
                        $('#alertPModal').find('.text-pro').removeClass('d-none');
                        $('#alertPModal').find('.text-success').text('');
                        location.reload();
                    }, 700)
                }, 1500)
              }
            },
            error: function(xhr, textStatus, errorThrown) {
              //called when there is an error
            }
          });
    });
    //edit table
    function resetEcl() {
        $('#editCPModal').find('.text-success').text('');
        $('#editCPModal').find('input[name="client_id"]').val('');
        $('#editCPModal').find('input[name="fullname"]').val('');
        $('#editCPModal').find('input[name="email"]').val('');
        $('#editCPModal').find('input[name="phone"]').val('');
        $('#editCPModal').find('input[name="address"]').val('');
        $('#editCPModal').find('select[name="status"]').val('');
        $('#editCPModal').find('option[value="1"]').attr('selected', false);
        $('#editCPModal').find('option[value="2"]').attr('selected', false);
        $('#editCPModal').find('option[value="3"]').attr('selected', false);
    }
    $('table').delegate('button.edit', 'click' ,function() {
        $('#alertPModal').modal({backdrop: 'static',keyboard: false});
        resetEcl();
        $client_id = $(this).parent().parent().find('.client_id').text();
        $fullname = $(this).parent().parent().find('.fullname').text();
        $email = $(this).parent().parent().find('.email').text();
        $phone = $(this).parent().parent().find('.phone').text();
        $address = $(this).parent().parent().find('.address').text();
        $status = $(this).parent().parent().find('.status').text();
        $('#editCPModal').find('input[name="client_id"]').val($client_id);
        $('#editCPModal').find('input[name="fullname"]').val($fullname);
        $('#editCPModal').find('input[name="email"]').val($email);
        $('#editCPModal').find('input[name="phone"]').val($phone);
        $('#editCPModal').find('input[name="address"]').val($address);
        switch($status) {
          case 'Được thuê':
            $status = '1'
            break;
          case 'Tạm khóa':
            $status = '2'
            break;
          case 'Xác nhận thuê':
            $status = '3'
            break;
        }
        $('#editCPModal').find('option[value="'+ $status +'"]').attr('selected', true);
        // $('#editCPModal').find('select[name="status"]').val($status);
        setTimeout(function(){
            $('#alertPModal').modal('hide');
            setTimeout(function(){
                $('#editCPModal').modal({backdrop: 'static',keyboard: false});
            }, 300);
        }, 500);
    });

    // Delete a row client
            // *************
            $('table').delegate('button.remove', 'click' ,function() {
              var t = $('table');
              // disabling the pager will restore all table rows
              // t.trigger('disablePager');
              // remove chosen row
              $(this).closest('tr').remove();
              // restore pager
              // t.trigger('enablePager');
              $('#alertPModal').find('.text-pro').removeClass('d-none');
              $('#alertPModal').modal({backdrop: 'static',keyboard: false});
              $id = $(this).parent().parent().find('.client_id').text();

              jQuery.ajax({
                url: 'delcl',
                type: 'POST',
                dataType: 'json',
                data: {client_id: $id},
                complete: function(xhr, textStatus) {
                  //called when complete
                },
                success: function(data, textStatus, xhr) {
                  //called when successful
                  if(data == 'ok'){
                    setTimeout(function(){
                        $('#alertPModal').find('.text-pro').addClass('d-none');
                        $('#alertPModal').find('.text-success').text('Đã xóa thành công');
                        setTimeout(function(){
                            $('#alertPModal').modal('hide');
                            $('#alertPModal').find('.text-pro').removeClass('d-none');
                            $('#alertPModal').find('.text-success').text('');
                        }, 700)
                    }, 1500)
                  }
                },
                error: function(xhr, textStatus, errorThrown) {
                  //called when there is an error
                }
              });
              

              t.trigger('update');
              return false;
            });

            // Delete a row order
            // *************
            $('table').delegate('button.remove-o', 'click' ,function() {
              var tt = $('table');
              // disabling the pager will restore all table rows
              // t.trigger('disablePager');
              // remove chosen row
              $(this).closest('tr').remove();
              // restore pager
              // t.trigger('enablePager');
              $('#alertPModal').find('.text-pro').removeClass('d-none');
              $('#alertPModal').modal({backdrop: 'static',keyboard: false});
              $order_id = $(this).parent().parent().find('.order_id').text();
              $room_id = $(this).parent().parent().find('.room_id').attr('data-id');
              $status = $(this).parent().parent().find('.status').attr('data-id');
              $total = $(this).parent().parent().find('.checkin').text();
              $checkin = $(this).parent().parent().find('.checkin').text();
              $checkout = $(this).parent().parent().find('.checkout').text();
              $client_id = $(this).parent().parent().find('.client_id').attr('data-id');
              $client_email = $(this).parent().parent().find('.client_id').text();
              $people = $(this).parent().parent().find('.people').text();

              if(($status == '4'))
              {
                jQuery.ajax({
                    url: 'delo',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        order_id: $order_id,
                    },
                    complete: function(xhr, textStatus) {
                      //called when complete
                    },
                    success: function(data, textStatus, xhr) {
                      //called when successful
                      if(data == 'ok'){
                        setTimeout(function(){
                            $('#alertPModal').find('.text-pro').addClass('d-none');
                            $('#alertPModal').find('.text-success').text('Đã xóa thành công');
                            setTimeout(function(){
                                $('#alertPModal').modal('hide');
                                $('#alertPModal').find('.text-pro').removeClass('d-none');
                                $('#alertPModal').find('.text-success').text('');
                            }, 700)
                        }, 1500)
                      }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                      //called when there is an error
                    }
                  });
              } else if(($status == '1') || ($status == '2') || ($status == '3') || ($status == '5'))
              {
                $('#editOPModal').find('input[name="client_id"]').val('');
                $('#editOPModal').find('input[name="email"]').val('');
                $('#editOPModal').find('input[name="client_id"]').val($client_id);
                $('#editOPModal').find('input[name="email"]').val($client_email);

                setTimeout(function(){
                    $('#alertPModal').modal('hide');
                    setTimeout(function(){
                        $('#editOPModal').modal({backdrop: 'static',keyboard: false});
                    }, 300);
                }, 700);

                $('.cancel-eo').click(function(event) {
                    $('#editOPModal').find('input[name="client_id"]').val('');
                    $('#editOPModal').find('input[name="email"]').val('');
                    $('#editOPModal').modal('hide');
                });

                $('.submit-eo').click(function(event) {
                    $('#alertPModal').modal({backdrop: 'static',keyboard: false});
                    $status_client = $('#editOPModal').find('select[name="status"]').children("option:selected").val();
                    jQuery.ajax({
                      url: 'deloUp',
                      type: 'POST',
                      dataType: 'json',
                      data: {
                        order_id: $order_id,
                        client_id: $client_id,
                        status_client: $status_client,
                        checkin: $checkin,
                        checkout: $checkout,
                        room_id: $room_id
                    },
                      complete: function(xhr, textStatus) {
                        //called when complete
                      },
                      success: function(data, textStatus, xhr) {
                        if(data == 'ok'){
                            $('#editOPModal').modal('hide');
                            $('#editOPModal').find('input[name="client_id"]').val('');
                            $('#editOPModal').find('input[name="email"]').val('');
                            setTimeout(function(){
                                $('#alertPModal').find('.text-pro').addClass('d-none');
                                $('#alertPModal').find('.text-success').text('Đã xóa thành công');
                                setTimeout(function(){
                                    $('#alertPModal').modal('hide');
                                    $('#alertPModal').find('.text-pro').removeClass('d-none');
                                    $('#alertPModal').find('.text-success').text('');
                                }, 700)
                            }, 1500)
                          }
                      },
                      error: function(xhr, textStatus, errorThrown) {
                        //called when there is an error
                      }
                    });
                    
                });
              }
              tt.trigger('update');
              return false;
            });


 // upload images
 $(document).ready(function() {


    var upload_one = new FileUploadWithPreview('upload-one',{
                showDeleteButtonOnImages: true,
                text: {
                        chooseFile: 'Chọn ảnh đại diện',
                        browse: 'Lựa chọn',
                },
            });
    var upload_multiple = new FileUploadWithPreview('upload-multiple',{
        text: {
                chooseFile: 'Chọn bộ sưu tập',
                browse: 'Lựa chọn',
                selectedCount: 'file đã chọn.',
        },
    });

    // gallery room
    // tạo biến động và giá trị động để lấy chính xác số hình của mỗi gallery
    if( $galleryNo > 0 ) 
    {
        for( $i = 1; $i <= $galleryNo; $i++ )
        {
            try 
            {
                eval("var $gallery_room" + $i + " = $('.g" + $i + " a').simpleLightbox()");
            }
            catch (err) 
            {
                console.log('lỗi nhỏ trong quá trình tạo biến động của lightbox khiến cho lightbox khó hiểu về selector của biến động. mọi chuyện vẫn ổn ^^');
            }
            // var $('gallery_room'+$i) = $i;
            // console.log($i);
            //var $gallery_room = $('.g'+$i+' a').simpleLightbox();
            
        }
    }
 });
 
$('.modify_room').click(function(event) {
    /* Act on the event */
    $this = $(this);

    $this.parent().parent().parent().parent().find('.edit-info').removeClass('d-none');
    $this.parent().parent().parent().parent().find('.current-info').addClass('d-none');

    $name_upload_one = $this.parent().parent().parent().parent().find('.custom-file-container').attr('data-upload-id');
    $name_upload_image = $this.parent().parent().parent().parent().find('.custom-file-container').attr('data-av');
    if(!$name_upload_image)
    var upload_one_current = new FileUploadWithPreview( $name_upload_one,{
        showDeleteButtonOnImages: true,
        text: {
                chooseFile: 'Chọn ảnh đại diện',
                browse: 'Lựa chọn',
        },
    }); else var upload_one_current = new FileUploadWithPreview( $name_upload_one,{
        showDeleteButtonOnImages: true,
        text: {
                chooseFile: 'Chọn ảnh đại diện',
                browse: 'Lựa chọn',
        },
        presetFiles: 
            ['../uploads/images/room/'+$name_upload_image]
        ,
    });

    // $this.parent().parent().find('.edit-info').removeClass('d-none');
    // $this.parent().parent().find('.current-info').addClass('d-none');

    $name_upload_multiple = $this.parent().parent().find('.custom-file-container').attr('data-upload-id');
    $name_upload_multiple_images = $this.parent().parent().find('.custom-file-container').attr('data-gallery');
    $need_gallery = $.parseJSON($name_upload_multiple_images);
    var upload_multiple_current = new FileUploadWithPreview( $name_upload_multiple,{
    text: {
            chooseFile: 'Chọn bộ sưu tập',
            browse: 'Lựa chọn',
            selectedCount: 'file đã chọn.',
    },
    presetFiles: 
        $need_gallery
    ,
    });
    
    // try 
    //     {
    //         eval("var a" + $name_upload_multiple + " = new FileUploadWithPreview('" + $name_upload_multiple + "',{text: {chooseFile: 'Chọn bộ sưu tập',browse: 'Lựa chọn',selectedCount: 'file đã chọn.',},});");
    //     }
    //     catch (err) 
    //     {
    //         console.log('lỗi nhỏ trong quá trình tạo biến động của uploadMultiple khiến cho uploadMultiple khó hiểu về selector của biến động. mọi chuyện vẫn ổn ^^');
    //     }
    //console.log($name_upload_multiple);
});

// $('#cPw').submit(function(event) {
//     $pw = $('#password').val();
//     $rpw = $('#rpassword').val();

//     if(($pw == '') && ($rpw == ''))
//     {
//         $('#password').focus();
//     }
//     else {
//         if ($rpw != $pw) {
//             alert('Vui lòng xác nhận đúng mật khẩu mới.');
//             $('#rpassword').focus();
//         }
//     }
// });
$('.cancel-edit').click(function(event) {
    /* Act on the event */
    $this = $(this);
    $this.parent().parent().find('.edit-info').addClass('d-none');
    $this.parent().parent().find('.current-info').removeClass('d-none');
    $this.parent().parent().parent().parent().find('.edit-info').addClass('d-none');
    $this.parent().parent().parent().parent().find('.current-info').removeClass('d-none');
    // var upload_multiple_current = "";
    // var upload_one_current = "";
});
function IsEmail(email) {
  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if(!regex.test(email)) {
    return false;
  }else{
    return true;
  }
}
$('.forget').click(function(event) {
    $this = $(this);
    $email = $(this).parent().find('input[name="email"]').val();
    if(IsEmail($email)) 
    {
        $('#alertPModal').modal({backdrop: 'static',keyboard: false});
        jQuery.ajax({
          url: 'admin/forget',
          type: 'POST',
          dataType: 'json',
          data: {email: $email},
          complete: function(xhr, textStatus) {
            //called when complete
          },
          success: function(data, textStatus, xhr) {
            if(data == '1')
            {
                $('#alertPModal').find('.oldA').addClass('d-none');
                $('#alertPModal').find('.text-success').text('Thông tin cập nhật mật khẩu đã được gửi đến email. Vui lòng cập nhật email hoặc kiểm tra trong mục Spam sau 5 phút.');
                setTimeout(function(){
                    location.reload();
                }, 10000)
            } else 
            {
                $('#alertPModal').find('.oldA').addClass('d-none');
                $('#alertPModal').find('.text-danger').text('Thông tin email không chính xác!');
                setTimeout(function(){
                    $this.parent().find('.wE').text('Vui lòng nhập đúng email!');
                    $this.parent().find('#email').focus();
                    $('#alertPModal').modal('hide');
                    $('#alertPModal').find('.oldA').removeClass('d-none');
                    $('#alertPModal').find('.text-danger').text('');
                }, 1500)
            }
          },
          error: function(xhr, textStatus, errorThrown) {
            //called when there is an error
          }
        });
    } else 
    {
        $(this).parent().find('.wE').text('Vui lòng nhập đúng email!');
        $(this).parent().find('#email').focus();
    }
    
});
// $(document).ready(function() {
// });
// alert('abl');  


// var $gallery_room = $('.gallery-room a').simpleLightbox();

