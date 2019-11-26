// $(window).on('scroll', function() {    
// 	   var scroll = $(window).scrollTop();
// 	   if (scroll < 265) {
// 		$("header").removeClass("sticky-header");
// 		console.log('hmm..');
// 	   }else{
// 		$("header").addClass("sticky-header");
// 	   }
// });
//
window.onscroll = function() {myFunction()};

var header = document.getElementById("header");
var sticky = header.offsetTop;

function myFunction() {
	var scroll = $(window).scrollTop();
	if (scroll > 0) {
	header.classList.add("sticky-header");
	header.classList.remove("none-sticky");
	} else {
	header.classList.remove("sticky-header");
	header.classList.add("none-sticky");
	}
}

$('.check-in').bootstrapDP({
    language: "vi",
	locale: "vi",
    format: "dd/mm/yyyy",
    endDate: '+15d',
    startDate: '+0d',
    todayHighlight: true,
});
$('.check-out').bootstrapDP({
	language: "vi",
	locale: "vi",
    format: "dd/mm/yyyy",
    endDate: '+22d',
    startDate: '+1d',
    todayHighlight: true
});

$('.checkin').bootstrapDP({
    language: "vi",
	locale: "vi",
    format: "dd/mm/yyyy",
    endDate: '+15d',
    startDate: '+0d',
    todayHighlight: true,
});
$('.checkout').bootstrapDP({
	language: "vi",
	locale: "vi",
    format: "dd/mm/yyyy",
    endDate: '+22d',
    startDate: '+1d',
	// datesDisabled: '+2d',
    todayHighlight: true
	});
$('.checkin').click(function(event) {
	/* Act on the event */
	// $(this).parent().parent().parent().find('.checkout').bootstrapDP("destroy");

	// $('.checkout').bootstrapDP({
 //    format: "dd/mm/yyyy",
 //    endDate: '+7d',
 //    startDate: '05/06/2019',
	// // datesDisabled: '+2d',
 //    language: "vi",
 //    todayHighlight: true
	// });
});

$('.booking-button').click(function(event) {
			/* Act on the event */
			var ad = $('#alertDModal');
			var t = $('#alertDModal').find('p.content-alert');
			var ciD = $(this).parent().parent().find('.check-in').bootstrapDP('getDate');
			var coD = $(this).parent().parent().find('.check-out').bootstrapDP('getDate');
			t.text('');
			if (!$(this).parent().parent().find('.check-in').val() || !$(this).parent().parent().find('.check-out').val()) 
			{
				t.text('Vui lòng chọn ngày Đến và Trả phòng!');
				ad.modal();
				setTimeout(function() {
					ad.modal('hide');
				}, 3000);
			} else if (coD <= ciD) 
				{
					t.text('Ngày trả phải phòng phải sau ngày Check-in ít nhất 01 ngày!');
					coD.bootstrapDP('clearDates');
					ad.modal();
					setTimeout(function() {
						ad.modal('hide');
					}, 3000);
				}
			 else {
				resultRoom();
			}
});
function resultRoom(){
	$('#alertWModal').modal({
    // backdrop: 'static',
    // keyboard: false
	});
	$('#alertWModal').find('button').text('');
	$('#alertWModal').find('button').append('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Đang tìm phòng...');
	var me = $('.booking-form');
	var check_in = me.find('input[name="check-in"]').val();
	var check_out = me.find('input[name="check-out"]').val();
	var people = me.find('select.people-select').val();
	console.log(check_in);
	console.log(check_out);
	console.log(people);
	jQuery.ajax({
	  url: 'booking/checkAvailability',
	  type: 'POST',
	  dataType: 'json',
	  data: {
	  	checkin: check_in,
	  	checkout: check_out,
	  	people: people,
	  },
	  complete: function(xhr, textStatus) {
	    //called when complete
	  },
	  success: function(data, textStatus, xhr) {
	    //called when successful
	    setTimeout(function() {
			if(data == "")
		    {
		    	$('#alertWModal').find('button').text('Rất tiếc! Không tìm thấy phòng trống. Vui lòng chọn lại thời gian lưu trú hoặc xem chi tiết từng phòng để biết ngày ở phù hợp!');
		    	setTimeout(function() {
					$('#alertWModal').modal('hide');
			    	$('.check-in').focus();
				}, 7000);

		    } else
		    {
		    	var len = data.length;

		    	$('#checkAvModal').find('.roomsAv').text('');
		    	$('#checkAvModal').find('.numAv').text('');
		    	$('#checkAvModal').find('.numPe').text('');
		    	$('#checkAvModal').find('.dateChi').text('');
		    	$('#checkAvModal').find('.dateCho').text('');

		    	$('#alertWModal').find('button').text('Tìm thấy ' + len + ' phòng trống. Đang xử lí kết quả...');
		    	$('#checkAvModal').find('.numAv').text(len);
		    	$('#checkAvModal').find('.numPe').text(people + ' người');
		    	$('#checkAvModal').find('.dateChi').text(check_in);
		    	$('#checkAvModal').find('.dateCho').text(check_out);
		    	var rAv = $('#checkAvModal').find('.roomsAv');

		    	for (var i = 0; i <= len; i++) {
		    		$.each($rooms_datajson, function(index, val) {
		    			if(val['room_id'] == data[i])
		    			{
		    				$features = val.features;
						 	$featuresR = "";
						 	$.each($features, function(kf, vf) {
						 		 switch (vf) {
						 		 	case 'dhoa':
						 		 		$featuresR = $featuresR + '<li data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Máy điều hòa"><i class="icofont-snow-temp ml-2"></i></li>';
						 		 	break;
						 		 	case 'tvi':
						 		 		$featuresR = $featuresR + '<li data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Ti vi"><i class=" icofont-imac ml-2"></i></li>';
						 		 	break;
						 		 	case 'mgiat':
						 		 		$featuresR = $featuresR + '<li data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Máy giặt"><i class="icofont-washing-machine  ml-2"></i></li>';
						 		 	break;
						 		 	case 'nvsinh':
						 		 		$featuresR = $featuresR + '<li data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Nhà vệ sinh riêng"><i class="icofont-bathtub  ml-2"></i></li>';
						 		 	break;
						 		 	case 'wfi':
						 		 		$featuresR = $featuresR + '<li data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Wifi miễn phí"><i class="icofont-wifi  ml-2"></i></li>';
						 		 	break;
						 		 	case 'asang':
						 		 		$featuresR = $featuresR + '<li data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Bao gồm bữa ăn sáng"><i class="icofont-culinary  ml-2"></i></li>';
						 		 	break;
						 		 }
						 	});

		    				rAv.append('<div class="row px-1 mr-1" style="position: relative;"> <div class="col-md-4"> <figure class="figure room-pic"> <a href="#"><img src="uploads/images/room/'+ val['thumbnail_image'] +'" class="figure-img img-fluid" alt="..."></a> </figure> </div> <div class="col-md-8"> <h6 class="d-block">'+ val['name'] +'</h6> <p style="font-size: 90%;">'+ val['short_desc'] +'</p> <ul style="list-style: none;display: flex; margin-bottom: 1rem;" class="room-desc">'+ $featuresR +'</ul> </div><button class="btn btn-info btn-to-detail" id-room="'+ val['room_id'] +'" check-in="'+ check_in +'" check-out="'+ check_out +'" people="'+ people +'" style="border: 0; position: absolute;right: 20px;bottom: 20px;	border-radius: 0;padding: 5px 15px;	">Chi tiết</button> </div> ');
		    				if(i % 2 == 0)
		    				{
		    					rAv.append('<hr>');
		    				}
		    			}
			    	});
		    	}
		    	
		    	setTimeout(function() {
					$('#checkAvModal').modal();
					$('#alertWModal').modal('hide');
				}, 5000);
		    	// console.log('có phòng trống: ');
		    	// console.log(len);
		    	// console.log(data);
		    }
		}, 3000);
	    
	    // $('#alertWModal').modal('hide');
	  },
	  error: function(xhr, textStatus, errorThrown) {
	    //called when there is an error
	   $('#alertWModal').find('button').text('Có lỗi xảy ra. Vui lòng thử lại.');
	   setTimeout(function() {
			location.reload();
		}, 3000);
	  }
	});
	
}
$(document).on('click', '.btn-to-detail',  (function(event) {
	var id = $(this).attr('id-room');
	var check_in = $(this).attr('check-in');
	var check_out = $(this).attr('check-out');
	var people = $(this).attr('people');
	$('#checkAvModal').modal('hide');
	$('#alertPModal').modal();
	setTimeout(function() {
		$('.list-room').find('.btn-room-detail[id-room="'+id+'"]').trigger('click');
		setTimeout(function(){
			$(document).find('.booking-date').find('input[name="checkin"]').bootstrapDP('setDate', check_in);
			$(document).find('.booking-date').find('input[name="checkout"]').bootstrapDP('setDate', check_out);
			$(document).find('.booking-person').find('select[name="people"]').val(people);
			setTimeout(function() {
				// var lightbox = $('#lightSlider a').simpleLightbox(options)
				$('.btn-booknow').trigger('click');
				setTimeout(function(){
					$('#alertPModal').modal('hide');
				}, 300);
			}, 400);
		}, 500);
	}, 300);
	
	

}));
$(document).on('click', '.close-modal-booking',  (function(event) {
	$('#bookingModal').modal('hide');
	setTimeout(function() {
		$(document).find("#bookingModal").remove();
	}, 500);
}));
$(".check-in").change(function(){
	var ad = $('#alertDModal');
	var t = $('#alertDModal').find('p.content-alert');
	var ciDD = $(this).bootstrapDP('getDate');
	var currentCc = $(this).parent().parent().parent().find('.check-out').bootstrapDP('getDate');
	var currentOo = $(this).bootstrapDP('getDate');
	if(!currentCc)
	{
		if (currentOo) {
			var currentOoo = currentOo;

			$(this).parent().parent().parent().find('.check-out').bootstrapDP('destroy');
			$curr = $(this).val();
			
            currentOo.setDate(currentOo.getDate() + 1);
            var currentOoc = moment(currentOo).format("DD/MM/YYYY");
            currentOoo.setDate(currentOoo.getDate() + 6);
            var dayy = currentOoo - (new Date(moment().startOf('day')));
            dayy = dayy / 86400000;
            dayy = '+' + dayy + 'd';
            $(this).parent().parent().parent().find('.check-out').bootstrapDP({
				language: "vi",
				locale: "vi",
			    format: "dd/mm/yyyy",
			    startDate: currentOoc,
			    endDate: dayy,
			    todayHighlight: true
			});
			var coDD = $(this).parent().parent().parent().find('.check-out').bootstrapDP('getDate');
			if(coDD)
			{
				if (ciDD >= coDD) 
				{
					t.text('Ngày đến chưa hợp lệ. Vui lòng chọn lại!');
					ad.modal();
					setTimeout(function() {
						ad.modal('hide');
					}, 3000);
					$(this).bootstrapDP('clearDates');
				}
			} else {
				$(this).parent().parent().parent().find('.check-out').bootstrapDP('clearDates');
			}
    	}
	} else {
			var currentOoo = currentOo;

			$(this).parent().parent().parent().find('.check-out').bootstrapDP('destroy');
			$curr = $(this).val();
			
            currentOo.setDate(currentOo.getDate() + 1);
            var currentOoc = moment(currentOo).format("DD/MM/YYYY");
            currentOoo.setDate(currentOoo.getDate() + 6);
            var dayy = currentOoo - (new Date(moment().startOf('day')));
            dayy = dayy / 86400000;
            dayy = '+' + dayy + 'd';
            $(this).parent().parent().parent().find('.check-out').bootstrapDP({
				language: "vi",
				locale: "vi",
			    format: "dd/mm/yyyy",
			    startDate: currentOoc,
			    endDate: dayy,
			    todayHighlight: true
			});
			var coDD = $(this).parent().parent().parent().find('.check-out').bootstrapDP('getDate');
			if(coDD)
			{
				if (ciDD >= coDD) 
				{

					t.text('Ngày đến chưa hợp lệ. Vui lòng chọn lại!');
					ad.modal();
					setTimeout(function() {
						ad.modal('hide');
					}, 3000);
					$(this).bootstrapDP('clearDates');
					$(this).bootstrapDP('clearDates');
				}
			} else {
				$(this).parent().parent().parent().find('.check-out').bootstrapDP('clearDates');
			}
    	}
});
function IsEmail(email) {
  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if(!regex.test(email)) {
    return false;
  }else{
    return true;
  }
}

$('.btn-room-detail').click(function(event) {
	/* Act on the event */

	$('#lightSlider').lightSlider({
	    gallery: true,
	    item: 1,
	    slideMargin: 0,
        enableDrag: false,
	});
	// var lightbox = $('#lightSlider').find('.lslide').find('a').simpleLightbox();
	$id = $(this).attr('id-room');
	$.each($rooms_datajson, function(k, v) {
		 /* iterate through array or object */
		 if($id == v.room_id)
		 {
		 	$name = v.name;
		 	$price = v.price;
		 	$short_desc = v.short_desc;
		 	$long_desc = v.long_desc;
		 	$people = v.people;
		 	$peopleR = "";
		 	if($people)
		 	{
		 		for($ie = 1; $ie <= $people; $ie++)
		 		{
		 			$sl = "";
		 			if($ie == $people) $sl = 'selected';
		 			$peopleR = $peopleR + '<option value="'+ $ie +'"'+ $sl +'>'+ $ie +'</option>';
		 		}
		 	}

		 	$square = v.square;
		 	$thumbnail_image = v.thumbnail_image;
		 	$features = v.features;
		 	$featuresR = "";
		 	$.each($features, function(kf, vf) {
		 		 switch (vf) {
		 		 	case 'dhoa':
		 		 		$featuresR = $featuresR + '<div class="offset-md-1"><i class="mr-1 icofont-snow-temp"></i>Máy điều hòa</div>';
		 		 	break;
		 		 	case 'tvi':
		 		 		$featuresR = $featuresR + '<div class="offset-md-1"><i class="mr-1 icofont-imac"></i>Ti vi</div>';
		 		 	break;
		 		 	case 'mgiat':
		 		 		$featuresR = $featuresR + '<div class="offset-md-1"><i class="mr-1 icofont-washing-machine"></i>Máy giặt</div>';
		 		 	break;
		 		 	case 'nvsinh':
		 		 		$featuresR = $featuresR + '<div class="offset-md-1"><i class="mr-1 icofont-bathtub"></i>Nhà vệ sinh riêng</div>';
		 		 	break;
		 		 	case 'wfi':
		 		 		$featuresR = $featuresR + '<div class="offset-md-1"><i class="mr-1 icofont-wifi"></i>Wifi miễn phí</div>';
		 		 	break;
		 		 	case 'asang':
		 		 		$featuresR = $featuresR + '<div class="offset-md-1"><i class="mr-1 icofont-culinary"></i>Bữa sáng miễn phí</div>';
		 		 	break;
		 		 }
		 	});
		 	
		 	$gallery_image = v.gallery_image;
		 	$sliderG = "";
		 	$.each($gallery_image, function(kk, vv){
		 		$sliderG = $sliderG + '<li data-thumb="./uploads/images/room/' + vv +'"><a href="./uploads/images/room/'+ vv +'"><img src="./uploads/images/room/'+ vv +'" /></a></li>';
		 	});
		 	$date_booked = v.date_booked;
		 	$date_booked_in = $date_booked;
			$date_booked_out = []; 
			$.each($date_booked_in, function(kd, vd) {
				 /* iterate through array or object */
				 // console.log(kd);
				 // console.log(vd);
				 var f = moment().format("DD/MM/YYYY");
					f = vd; // OR $("#datepicker").val();
				var ff = new Date(moment(f, "DD/MM/YYYY").add(1, 'd'));
					ff = moment(ff, "DD/MM/YYYY").format("DD/MM/YYYY");
					$date_booked_out[kd] = ff;
				// // var milliseconds = moment(new Date(f)).format("DD/MM/YYYY");
				// // var ff = new Date(milliseconds)
				// console.log(vd);
				 // console.log(ff);
				 // return vd;
				 
				 // return kd;
				 
			}); 
			// console.log($date_booked);
			console.log($date_booked_in);
			console.log($date_booked_out);
		 	// console.log($features);
		 	// console.log($price.toLocaleString("en"));
		 }
		 // console.log(v.room_id);
	});
	// $date_booked = ["10/06/2019", "14/06/2019", "21/06/2019"];
	
	// console.log(date_booked);
	// console.log(date_booked_in);
	// console.log(date_booked_out);
	console.log('sau khi có hết tất cả các biến, tới lượt gọi modal lên :))))');
	if($(this).parent().find('#bookingModal')[0])
	{
		$(this).parent().find('#bookingModal').modal();
		console.log('có rồi');
	} else 
	{

		console.log('chưa có, tao đang tạo nó ra, đợi tí');
		var modal_booking = '<!-- Modal --><div class="modal fade" id="bookingModal" role="dialog"><div class="modal-dialog modal-dialog-centered col-md-10"> <!-- Modal content--> <div class="modal-content"> <div class="modal-header"> <h6 class="modal-title">'+ $name +'</h6> <button type="button" class="close-modal-booking close" data-dismiss="modal">&times;</button> </div> <div class="modal-body"> <div class="col-md-12 d-block"> <div class=""> <button type="button" class="btn-booknow btn position-absolute" style="right: 0; z-index: 9999;">Đặt ngay</button> <form class="col-md-12 d-none bkf-modal mb-2"> <!-- check info --> <div class="col-md-12 info-client d-none" style="position: absolute;left: 0;z-index: 99999;"> <div class="py-3 px-3 mx-auto shadow-lg rounded bg-white" style="width: 500px;"> <button type="button" class="close close-info">×</button> <h5 style="color: #220093;border: none;">Thông tin liên hệ</h5><hr> <small id="infoHelp" class="form-text text-muted text-danger d-block">Vui lòng cung cấp đầy đủ các thông tin bên dưới để chúng tôi liên hệ bạn.</small> <div class="form-group py-2 form-valid-email-only"> <label for="exampleInputEmail1">Địa chỉ email</label> <input type="email" class="form-control" required="" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="example@email.com"> <small id="emailHelp" class="form-text text-muted">Chúng tôi sẽ gửi xác nhận đơn đặt phòng qua email của bạn.</small> </div> <div class="final-info d-none"><small class="text-danger w-ed d-none">Vui lòng nhập đúng thông tin!</small> <div class="form-group"> <label for="exampleInputEmail1">Tên đầy đủ</label> <strong class="d-block" name="fullname"></strong><input type="text" class="form-control d-none" name="fullname" required="" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Họ và tên"> </div> <div class="form-group"> <label for="exampleInputEmail1" class="require-sdt">Số điện thoại</label> <strong class="d-block" name="sdt"></strong><input type="text" class="form-control d-none" required="" name="sdt" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="0938383..."> <small class="text-danger wrong-sdt d-block"></small><small id="emailHelp" class="form-text text-muted">Chúng tôi cũng có thể liên lạc qua số điện thoại để xác nhận thông tin.</small> </div> <div class="form-group"> <label for="exampleInputEmail1">Địa chỉ</label> <strong class="d-block" name="address"></strong><input type="text" class="form-control d-none" name="address" required="" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Số .., đường ..., huyện ..., tỉnh ..."> </div> </div> <button type="button" class="btn next-info" style="">Tiếp tục</button> <button type="button" class="btn confirm-sdt d-none" style="">Xác nhận</button> <button type="button" class="btn ok-info d-none" style="">Hoàn tất</button><input type="hidden" name="lol" disabled value="0"> </div> </div> <!-- end check info --> <!-- <button type="button" class="close position-absolute" style="color: #fff;right: 5px;top: 5px;padding: 3px 9px;">×</button> --> <div class="form-group col-md-3 pl-0"> <label class="text-white">Ngày đến</label> <div class="booking-date"> <span><i class="icofont-calendar"></i></span> <input type="text" name="checkin" class="checkin" data-provide="datepicker" required readonly value="" placeholder="--/--/--"> <span><i class="icofont-thin-down"></i></span> </div> </div> <div class="form-group col-md-3 pl-0"> <label class="text-white">Ngày đi</label> <div class="booking-date"> <span><i class="icofont-calendar"></i></span> <input type="text" name="checkout" class="checkout" data-provide="datepicker" required readonly value="" placeholder="--/--/--"> <span><i class="icofont-thin-down"></i></span> </div> </div> <div class="form-group col-md-3 pl-0"> <label class="text-white">Số người</label> <div class="booking-person"> <span><i class="icofont-users-alt-6"></i></span> <!-- <input type="text" name="" readonly value="01" placeholder=""> --> <select class="custom-select" name="people" id="inputGroupSelect01"> '+ $peopleR +'</select> <span><i class="icofont-thin-down"></i></span> </div> </div> <div class="form-group col-md-3 pl-0"> <label>&nbsp;</label> <input type="hidden" name="room_id" value="'+ $id +'"> <button type="button" class="booking-ok btn d-block">Đặt Phòng</button> </div> <div class="col-md-11 booking-time">(Nhận phòng: 02:00 PM / Trả phòng: 12:00 PM)<div class="float-right" style="font-size: 16px; font-weight: 600; padding-right: 5px;">TỔNG: <input type="text" readonly class="booking-money" name="total" value="0" style="background: none; border: none; color: #fff; width: 80px; text-align: right;"><sup>VNĐ</sup></div></div> </form> </div> </div> <div class="col"> <h6>Thông tin phòng</h6> <div class="row"> <div class="col-md-12"> <label class="font-weight-bold" style="font-size: 18px">Giá phòng:</label><span> <input type="text" readonly class="room-money" name="room-money" value="'+ $price +'" style="background: none; border: none; width: 70px; text-align: right;"> <sup>đ</sup>/đêm</span> </div> <div class="col-md-4"> <label class="font-weight-bold">Số lượng người:</label><span> '+ $people +' </span> </div> <div class="col-md-4"> <label class="font-weight-bold">Diện tích:</label><span> '+ $square +' m<sup>2</sup></span> </div> <div class="col-md-8"> <label class="font-weight-bold d-block">Giới thiệu:</label> <span>'+ $long_desc +'</span> </div> <div class="col-md-4"> <label class="font-weight-bold d-block">Tiện ích đi kèm:</label>'+ $featuresR +'</div> </div> </div> <hr> <div class="col-md-12 modal-slider "> <!-- slider --> <h6 class="">Thư viện ảnh</h6> <ul id="lightSlider">'+ $sliderG +'</ul> <!-- end slider --> </div> </div> <div class="modal-footer"> <button type="button" class="btn btn-default close-modal-booking" data-dismiss="modal">Đóng</button> </div> </div> </div> </div> <!-- end modal -->';
		$(this).parent().append(modal_booking);
		$(this).parent().find('#bookingModal').modal({backdrop: 'static',keyboard: false});
		$(this).parent().find('#lightSlider').lightSlider({
	    gallery: true,
	    item: 1,
	    slideMargin: 0,
        enableDrag: false, 
		});

		$('.checkin').bootstrapDP('destroy');
		$('.checkin').bootstrapDP({
	    language: "vi",
		locale: "vi",
	    format: "dd/mm/yyyy",
	    endDate: '+15d',
	    datesDisabled: $date_booked_in,
	    startDate: '+0d',
	    todayHighlight: true,
		});
		$('.checkout').bootstrapDP('destroy');
		$('.checkout').bootstrapDP({
			language: "vi",
			locale: "vi",
		    format: "dd/mm/yyyy",
		    endDate: '+22d',
		    datesDisabled: $date_booked_out,
		    startDate: '+1d',
			// datesDisabled: '+2d',
		    todayHighlight: true
		});
		console.log('aha, tạo xong rồi nha, đ đi học nữa đâu :(');
		$('.btn-booknow').click(function(event) {
		/* Act on the event */
			console.log('click trúng tao rồi, ok');
			$(this).parent().find('.bkf-modal').removeClass('d-none');
			$(this).parent().find('.bkf-modal').addClass('d-md-inline-flex');
			$(this).addClass('d-none');
		});
		$('.checkout').click(function(event) {
			/* Act on the event */

			var currentC = $(this).parent().parent().parent().find('.checkin').bootstrapDP('getDate');
			var currentO = $(this).bootstrapDP('getDate');
			if(!currentO)
			{
				if (currentC) {
		            currentC.setDate(currentC.getDate() + 1);
		            $(this).bootstrapDP('setDate', currentC);
		    	}
			}
		    var a = $(this).parent().parent().parent().find('.checkin').bootstrapDP('getDate');
			var b = $(this).bootstrapDP('getDate');
			var c = b - a;
			// console.log('đây là c ' + c);
			var d = c / 86400000;
			// console.log('c này sẽ bằng' + d + ' ngày');
			// var currentChoose = $(this).parent().parent().parent().find('.checkin').bootstrapDP('getDate');
			// // console.log(currentChoose);
			// currentChoose.setDate(currentChoose.getDate() + 1);
			// console.log(currentChoose);
			// var curr_date = currentChoose.getDate();
			// var curr_month = currentChoose.getMonth() + 1; //Months are zero based
			// var curr_year = currentChoose.getFullYear();
			// var next_current_choose = curr_date + "/" + curr_month + "/" + curr_year;

			// var currentChooseSv = currentChoose;
			// // console.log(currentChooseSv);
			// currentChooseSv.setDate(currentChooseSv.getDate() + 7);
			// console.log(currentChooseSv);
			// var curr_dateSv = currentChooseSv.getDate();
			// var curr_monthSv = currentChooseSv.getMonth() + 1; //Months are zero based
			// var curr_yearSv = currentChooseSv.getFullYear();
			// var next_current_chooseSv = curr_dateSv + "/" + curr_monthSv + "/" + curr_yearSv;

			// console.log(next_current_choose);
			// console.log(next_current_chooseSv);

			// $(this).bootstrapDP({
		 //    format: "dd/mm/yyyy",
		 //    endDate: "'"+next_current_chooseSv+"'",
		 //    startDate: "'"+next_current_choose+"'",
			// // datesDisabled: '+2d',
		 //    language: "en",
		 //    todayHighlight: true
			// });
		});
		$(".checkin").change(function(){
			var ciDD = $(this).bootstrapDP('getDate');
			var currentCc = $(this).parent().parent().parent().find('.checkout').bootstrapDP('getDate');
			var currentOo = $(this).bootstrapDP('getDate');
			if(!currentCc)
			{
				if (currentOo) {
					var currentOoo = currentOo;

					$(this).parent().parent().parent().find('.checkout').bootstrapDP('destroy');
					$curr = $(this).val();
					// console.log(curr);
					
					// có 1 vấn đề chưa được giải quyết chỗ này: cần reset lại phần endDate cho logic, tính sau đi, mệt
					// $(this).parent().parent().parent().find('.checkout').bootstrapDP('setStartDate', $(this).val());
					// $(this).parent().parent().parent().find('.checkout').bootstrapDP('setEndDate', '+22');
					// $(this).parent().parent().parent().find('.checkout').bootstrapDP('setEndDate', '+7d');
					
		            currentOo.setDate(currentOo.getDate() + 1);
		            var currentOoc = moment(currentOo).format("DD/MM/YYYY");
		            currentOoo.setDate(currentOoo.getDate() + 6);
		            var dayy = currentOoo - (new Date(moment().startOf('day')));
		            dayy = dayy / 86400000;
		            dayy = '+' + dayy + 'd';
		            $(this).parent().parent().parent().find('.checkout').bootstrapDP({
						language: "vi",
						locale: "vi",
					    format: "dd/mm/yyyy",
					    datesDisabled: $date_booked_out,
					    startDate: currentOoc,
					    endDate: dayy,

						// datesDisabled: '+2d',
					    todayHighlight: true
					});
		            // var ccc = moment(currentOoo).add(dayy, 'days').toDate();
		            // var cccc = moment(ccc).format("DD/MM/YYYY");
		            // $(this).parent().parent().parent().find('.checkout').bootstrapDP('setStartDate', currentOo);
		            console.log('đây là ngày bắt đầu: ' + currentOo);
		            
		            // $(this).parent().parent().parent().find('.checkout').bootstrapDP('setEndDate', currentOoo);
		            // $(this).parent().parent().parent().find('.checkout').bootstrapDP('setDate', currentOo);
		            console.log('đây là ngày trước khi ngày được chọn cộng thêm 8: ' + currentOoo);

		            console.log('đây là ngày sau khi ngày được chọn cộng thêm 8: ' + currentOoo);
		            console.log('đây là ngày hôm nay: ' + (new Date(moment().startOf('day'))));
					// currentOoo.setDate(currentOoo.getDate() + 6);
		            // var dayy = currentOoo - (new Date(moment().startOf('day')));
		            // dayy = dayy / 86400000;
		            // dayy = '+' + dayy + 'd';
		            // var ccc = moment(currentOoo).add(dayy, 'days').toDate();
		            // var cccc = moment(ccc).format("DD/MM/YYYY");
		            // console.log('đây là ngày giới hạn đặt phòng: ' + cccc);
		            // $(this).parent().parent().parent().find('.checkout').bootstrapDP('setEndDate', cccc);
					var coDD = $(this).parent().parent().parent().find('.checkout').bootstrapDP('getDate');

					console.log('cidd ' + ciDD);
					console.log('codd' + coDD);
					if(coDD)
					{
						if (ciDD >= coDD) 
						{
							console.log('ok');
							alert('Ngày đến chưa hợp lệ. Vui lòng chọn lại.');
							$(this).bootstrapDP('clearDates');
							$(this).parent().parent().parent().find('input.booking-money').val('0');
						} else {
							var aa = $(this).bootstrapDP('getDate');
							// console.log('đây là ngày checkin' + aa);
							// $aa_tmp = moment(aa, "DD/MM/YYYY").format("DD/MM/YYYY");
							// console.log(aa);
							// console.log(ll.bootstrapDP('getDate'));
							var bb = $(this).parent().parent().parent().find('.checkout').bootstrapDP('getDate');
							// console.log('đây là ngày checkout' + bb);
							// console.log('còn đây là mảng ngày đã được đặt: ' + $date_booked_in);
							var cc = bb - aa;
							var dd = cc / 86400000;
							var ee = $(this).parent().parent().parent().parent().parent().parent().find('input.room-money').val();
							// console.log(ee);
							var ff = dd * ee;
							$(this).parent().parent().parent().find('input.booking-money').val(ff);
						}
					} else {
						$(this).parent().parent().parent().find('input.booking-money').val('0');
						$(this).parent().parent().parent().find('.checkout').bootstrapDP('clearDates');
					}

		    	}
			} else {
					var currentOoo = currentOo;

					$(this).parent().parent().parent().find('.checkout').bootstrapDP('destroy');
					$curr = $(this).val();
					// console.log(curr);
					
					// có 1 vấn đề chưa được giải quyết chỗ này: cần reset lại phần endDate cho logic, tính sau đi, mệt
					// $(this).parent().parent().parent().find('.checkout').bootstrapDP('setStartDate', $(this).val());
					// $(this).parent().parent().parent().find('.checkout').bootstrapDP('setEndDate', '+22');
					// $(this).parent().parent().parent().find('.checkout').bootstrapDP('setEndDate', '+7d');
					
		            currentOo.setDate(currentOo.getDate() + 1);
		            var currentOoc = moment(currentOo).format("DD/MM/YYYY");
		            currentOoo.setDate(currentOoo.getDate() + 6);
		            var dayy = currentOoo - (new Date(moment().startOf('day')));
		            dayy = dayy / 86400000;
		            dayy = '+' + dayy + 'd';
		            $(this).parent().parent().parent().find('.checkout').bootstrapDP({
						language: "vi",
						locale: "vi",
					    format: "dd/mm/yyyy",
					    datesDisabled: $date_booked_out,
					    startDate: currentOoc,
					    endDate: dayy,

						// datesDisabled: '+2d',
					    todayHighlight: true
					});
		            // var ccc = moment(currentOoo).add(dayy, 'days').toDate();
		            // var cccc = moment(ccc).format("DD/MM/YYYY");
		            // $(this).parent().parent().parent().find('.checkout').bootstrapDP('setStartDate', currentOo);
		            console.log('đây là ngày bắt đầu: ' + currentOo);
		            
		            // $(this).parent().parent().parent().find('.checkout').bootstrapDP('setEndDate', currentOoo);
		            // $(this).parent().parent().parent().find('.checkout').bootstrapDP('setDate', currentOo);
		            console.log('đây là ngày trước khi ngày được chọn cộng thêm 8: ' + currentOoo);

		            console.log('đây là ngày sau khi ngày được chọn cộng thêm 8: ' + currentOoo);
		            console.log('đây là ngày hôm nay: ' + (new Date(moment().startOf('day'))));
					// currentOoo.setDate(currentOoo.getDate() + 6);
		            // var dayy = currentOoo - (new Date(moment().startOf('day')));
		            // dayy = dayy / 86400000;
		            // dayy = '+' + dayy + 'd';
		            // var ccc = moment(currentOoo).add(dayy, 'days').toDate();
		            // var cccc = moment(ccc).format("DD/MM/YYYY");
		            // console.log('đây là ngày giới hạn đặt phòng: ' + cccc);
		            // $(this).parent().parent().parent().find('.checkout').bootstrapDP('setEndDate', cccc);
					var coDD = $(this).parent().parent().parent().find('.checkout').bootstrapDP('getDate');

					console.log('cidd ' + ciDD);
					console.log('codd' + coDD);
					if(coDD)
					{
						if (ciDD >= coDD) 
						{
							console.log('ok');
							alert('Ngày đến chưa hợp lệ. Vui lòng chọn lại.');
							$(this).bootstrapDP('clearDates');
							$(this).parent().parent().parent().find('input.booking-money').val('0');
						} else {
							var aa = $(this).bootstrapDP('getDate');
							// console.log('đây là ngày checkin' + aa);
							// $aa_tmp = moment(aa, "DD/MM/YYYY").format("DD/MM/YYYY");
							// console.log(aa);
							// console.log(ll.bootstrapDP('getDate'));
							var bb = $(this).parent().parent().parent().find('.checkout').bootstrapDP('getDate');
							// console.log('đây là ngày checkout' + bb);
							// console.log('còn đây là mảng ngày đã được đặt: ' + $date_booked_in);
							var cc = bb - aa;
							var dd = cc / 86400000;
							var ee = $(this).parent().parent().parent().parent().parent().parent().find('input.room-money').val();
							// console.log(ee);
							var ff = dd * ee;
							$(this).parent().parent().parent().find('input.booking-money').val(ff);
						}
					} else {
						$(this).parent().parent().parent().find('input.booking-money').val('0');
						$(this).parent().parent().parent().find('.checkout').bootstrapDP('clearDates');
					}

		    	}
		 //    var a = $(this).parent().parent().parent().find('.checkin').bootstrapDP('getDate');
			// var b = $(this).bootstrapDP('getDate');
			// var c = b - a;
			// // console.log('đây là c ' + c);
			// var d = c / 86400000;
			
		});
		$(".checkout").change(function(){
			// calc money
			// var ll = "20/6/2019";
			// var datesDisabled = ["10/06/2019", "14/06/2019", "21/06/2019"];
			// if(datesDisabled.indexOf('14/06/2019') == -1){
			// 	console.log('không có ngày 14 trong danh sách');
			// } else console.log('có ngày 14 trong danh sách');
			// console.log('đây là mảng ngày đã book ' + datesDisabled);
			var aa = $(this).parent().parent().parent().find('.checkin').bootstrapDP('getDate');
			console.log('đây là ngày checkin' + aa);
			// $aa_tmp = moment(aa, "DD/MM/YYYY").format("DD/MM/YYYY");
			// console.log(aa);
			// console.log(ll.bootstrapDP('getDate'));
			var bb = $(this).bootstrapDP('getDate');

			var cc = bb - aa;
			// console.log('đây là c ' + c);
			var dd = cc / 86400000;
			console.log('bạn đang muốn ở đây ' + dd + ' ngày đấy');
			if(dd >= 8) 
			{
				alert('Xin lỗi, bạn chỉ được phép lưu trú tối đa 7 ngày thôi, vui lòng chọn lại thời gian cho phù hợp');
				$(this).bootstrapDP('clearDates');
				$(this).parent().parent().parent().find('input.booking-money').val('0');

			} else {
				console.log('đây là ngày checkout' + bb);
				console.log('còn đây là mảng ngày đã được đặt: ' + $date_booked_in);

				// $bb_tmp = moment(bb, "DD/MM/YYYY").format("DD/MM/YYYY");


				// var fromDate = $('.checkin').data('datepicker').dates[0];
			    
				var count = 0;
				var currentMoment = moment(aa, "DD/MM/YYYY");
				var endMoment = moment(bb, "DD/MM/YYYY");
				if($date_booked_in)
				{
					while (currentMoment.isBefore(endMoment, 'day')) {
				  // console.log(`Loop at ${currentMoment.format('DD/MM/YYYY')}`);
				  
				  if (($date_booked_in.indexOf(currentMoment.format('DD/MM/YYYY')) == -1)) {
				      	console.log('ngày ' + currentMoment + ' không có trong danh sách');
					} else {
						console.log('ngày ' + currentMoment + ' có trong danh sách');
						count++;
					}
					currentMoment.add(1, 'days');
				}
				}
				

				console.log('tổng số ngày đã booked đếm được: ' + count);
				if(count > 0 )
				{
					alert('Vui lòng chọn chuỗi ngày lưu trú không trùng với lịch phòng đã được đặt.');
					$(this).bootstrapDP('clearDates');
					$(this).parent().parent().parent().parent().parent().parent().find('input.booking-money').val('0');
				} else {
					var cc = bb - aa;
					var dd = cc / 86400000;
					var ee = $(this).parent().parent().parent().parent().parent().parent().find('input.room-money').val();
					// console.log(ee);
					var ff = dd * ee;
					$(this).parent().parent().parent().find('input.booking-money').val(ff);
				}
			}
			
			 //    while (aa <= bb) {
			 //    	ii++;
			 //      // var dayOfWeek = curDate.getDay();
			 //      var cur = new Date(moment(aa, "DD/MM/YYYY").add(ii, 'd'));
			 //      console.log('đếm ngược số ngày còn phải đếm' + ii);
			 //     //  if (($datesDisabled.indexOf(moment(aa, "DD/MM/YYYY").format("DD/MM/YYYY")) == -1)) {
			 //     //  	console.log(formatDate(curDate));
			 //     //    count++;
			 //     // }
			 // };
			   //   console.log($total);
			   //   var get_no_of_days = getWorkingDatesCount(aa, bb);
		    // var final_count = parseInt(get_no_of_days) + 1; //adding +1 to the total number of days to count the present date as well.
		    // $total = final_count;

			

		});

		$('.close-info').off().click(function(e) {
							$(this).parent().find('.next-info').removeClass('d-none');
							$(this).parent().find('.ok-info').addClass('d-none');
							$(this).parent().find('.final-info').addClass('d-none');
							$(this).parent().find('input[name="email"]').val('');
							$(this).parent().parent().addClass('d-none');
							$('body').find('.alert-valid-email').remove();
		});
		
		$('.booking-ok').click(function(event) {
			/* Act on the event */
			if (!$(this).parent().parent().find('.checkin').val() || !$(this).parent().parent().find('.checkout').val()) 
			{
				alert('Vui lòng chọn ngày Đến và Trả phòng!');
			} else {
				var ciD = $(this).parent().parent().find('.checkin').bootstrapDP('getDate');
				var coD = $(this).parent().parent().find('.checkout').bootstrapDP('getDate');

				if (coD <= ciD) 
				{
					alert('Ngày trả phải phòng phải sau ngày Check-in ít nhất 01 ngày!');
					 $(this).parent().parent().find('.checkout').bootstrapDP('clearDates');
					 $(this).parent().parent().find('input.booking-money').val('0');
				} else {
					var mo = $(this).parent().parent().find('input.booking-money').val();
					if(mo > 0)
					{
						console.log('thỏa mãn book phòng này');

						$this = $(this);
						$this.parent().parent().find('.info-client').removeClass('d-none');

						$('body').find('.alert-valid-email').remove();
						
						var isAjaxing = false;
						$('.next-info').click(function(event) {
							event.preventDefault();
							if(isAjaxing) return;
						    isAjaxing = true;
							$this = $(this);
							$email = $(this).parent().find('input[name="email"]').val();
							if(!$email)
							{
								$(this).parent().find('input[name="email"]').focus();
							} else {
								if(IsEmail($email) == false)
								{
									alert('Email của bạn không hợp lệ, vui lòng thử lại');
									$(this).parent().find('input[name="email"]').focus();
								} else {
									//nếu email hợp lệ
									// check trong server có bị block không nhé
									
									jQuery.ajax({
						              url: 'booking/check_email/',
						              type: 'POST',
						              dataType: 'json',
						              data: {
						              	email: $email,
						              },
						              complete: function(xhr, textStatus) {
						                //called when complete
						                //console.log($this.find('#room_id').attr('value'));
						                // $('[data-toggle="tooltip"]').tooltip("hide");
						                // $this.parents(".room_detail").css("opacity", "0");
						                // setTimeout(function(){
						                //     $this.parents(".room_detail").remove();
						                // }, 2000);
						                $this.data('requestRunning', false);
						                isAjaxing = false;
						              },
						              success: function(data, textStatus, xhr) {
						                //called when successful
						                //$this.remove();
						                if(!data)
						                {
						                	// console.log(data);
						                	console.log('Opps!!');
						                } else
						                	isAjaxing = false;
						                	valid_email(data);
						                	$this.data('requestRunning', false);
						                // console.log(data);
						              },
						              error: function(xhr, textStatus, errorThrown) {
						                //called when there is an error
						                // console.log('error');
						              }
						            });

									function valid_email($valid) {
										var valid = $valid;
										switch (valid) {
											case '0':
												//khách mới
													$this.parent().find('.final-info').removeClass('d-none');
													$this.parent().find('.ok-info').removeClass('d-none');
													$this.parent().find('input[name="email"]').attr("disabled", true);
													$this.parent().find('input[name="fullname"]').removeClass('d-none');
													$this.parent().find('input[name="sdt"]').removeClass('d-none');
													//khách mới sẽ thêm 2 cái sau vào
													$this.parent().find('input[name="sdt"]').addClass('n');
													$this.parent().find('input[name="lol"]').val('1');

													$this.parent().find('input[name="address"]').removeClass('d-none');
													$this.addClass('d-none');
												break;
											case '1':{
												//khách cũ
												//lấy thông tin trước của hắn ra nói xàm chút
													jQuery.ajax({
													  url: 'booking/info_client',
													  type: 'POST',
													  dataType: 'json',
													  data: {email: $email},
													  complete: function(xhr, textStatus) {
													    //called when complete
													  },
													  success: function(data, textStatus, xhr) {
													    //called when successful
													    $i4c = data;
													    $.each($i4c, function(index, val) {
													    	 $clid = val.client_id;
													    	 $clfullname = val.fullname;
													    	 $claddress = val.address;
													    	 $clphone = val.phone;
													    });
													    // console.log($i4c);
													    if($i4c){
													    	$this.parent().find('.final-info').removeClass('d-none');
															$this.parent().find('.form-valid-email-only').append('<input type="hidden" name="clid" value="'+ $clid +'"><div class="mb-0 mt-2 alert alert-info alert-valid-email" role="alert"><small class="text-muted d-block text-center" style="font-style: italic">Cảm ơn bạn đã quay lại với Homestay chúng tôi!</small><div class="q-ed">Bạn có muốn thay đổi thông tin liên hệ của mình?<span class="d-block text-center">(<span class="y-ed">Có</span> / <span class="n-ed">Không</span>)</span></div></div>')
															$this.parent().find('strong[name="fullname"]').text($clfullname);
															$this.parent().find('strong[name="sdt"]').text($clphone);
															$this.parent().find('strong[name="address"]').text($claddress);

															// $this.parent().find('input[name="fullname"]').val($clfullname);
															// $this.parent().find('input[name="sdt"]').val($clphone);
															// $this.parent().find('input[name="address"]').val($claddress);
															$this.parent().find('input[name="email"]').attr("disabled", true);
															$this.addClass('d-none');


															$('.n-ed').click(function(event) {
																$(this).parents('.q-ed').addClass('d-none');
																$(this).parents('.q-ed').remove();
																$('.final-info').find('strong[name="sdt"]').remove();
																$('.final-info').find('input[name="sdt"]').removeClass('d-none');
																$('.info-client').find('.ok-info').removeClass('d-none');
																$('.final-info').find('.require-sdt').append(' <span class="text-danger" style="font-size: 80%;">**Vui lòng xác nhận lại số điện thoại của mình</span>');
																$('.final-info').find('input[name="sdt"]').attr('placeholder', $clphone);
																$('.final-info').find('input[name="sdt"]').focus();
															});

															$('.y-ed').click(function(event) {
																$(this).parents('.q-ed').addClass('d-none');
																$(this).parents('.q-ed').remove();
																$('.final-info').find('strong[name="sdt"]').remove();
																$('.final-info').find('input[name="sdt"]').removeClass('d-none');
																$('.info-client').find('.confirm-sdt').removeClass('d-none');
																$('.final-info').find('.require-sdt').append(' <span class="text-danger" style="font-size: 80%;">**Vui lòng xác nhận lại số điện thoại của mình</span>');
																$('.final-info').find('input[name="sdt"]').attr('placeholder', $clphone);
																$('.final-info').find('input[name="sdt"]').focus();
															});
													    }

													    
													  },
													  error: function(xhr, textStatus, errorThrown) {
													    //called when there is an error
													  }
													});
													
													
												}
												break;
											case '2':
												// sida cấp sida
													$this.parent().append('<div class="alert alert-valid-email alert-danger d-block" role="alert"> Email của bạn tạm thời bị khóa trên hệ thống. Xin vui lòng liên hệ với chung tôi. <strong>Hệ thống tự động tải lại sau 10s!</strong></div>');
													$this.addClass('d-none');
													setTimeout(function() {
														location.reload();
													}, 10000);
												break;
											case '3':
												// bị sida nhẹ
													$this.parent().append('<div class="alert alert-valid-email alert-danger d-block" role="alert"> Email có một lịch đặt phòng cần xác nhận. Vui lòng hoàn tất xác nhận. <strong>Hệ thống tự động tải lại sau 10s!</strong></div>');
													$this.addClass('d-none');
													setTimeout(function() {
														location.reload();
													}, 10000);
												break;	
										}
										// console.log($valid);
									}
									
									
								}
							}
						});

						// jQuery.ajax({
			   //            url: 'booking/',
			   //            type: 'POST',
			   //            dataType: 'json',
			   //            data: {
			   //            	room_id: $this.parent().find('input').attr('value'),
			   //            },
			   //            complete: function(xhr, textStatus) {
			   //              //called when complete
			   //              //console.log($this.find('#room_id').attr('value'));
			   //              $('[data-toggle="tooltip"]').tooltip("hide");
			   //              $this.parents(".room_detail").css("opacity", "0");
			   //              setTimeout(function(){
			   //                  $this.parents(".room_detail").remove();
			   //              }, 2000);
			                
			   //            },
			   //            success: function(data, textStatus, xhr) {
			   //              //called when successful
			   //              // console.log(data);
			   //            },
			   //            error: function(xhr, textStatus, errorThrown) {
			   //              //called when there is an error
			   //              // console.log('error');
			   //            }
			   //          });
					} else console.log('máy đếm tiền cho booking này bị gì rồi.');
					
				}
			}
		});
		$('.confirm-sdt').click(function(event) {
			event.preventDefault();
			$('#alertPModal').modal({backdrop: 'static',keyboard: false});
			var me = $(this);

			$client_id = me.parent().find('input[name="clid"]').val();
			$phone = me.parent().find('input[name="sdt"]').val();
			if($phone.length < $clphone.length || $phone.length > $clphone.length)
			{	
				setTimeout(function(){
		    		$('#alertPModal').modal('hide');
		    	}, 300);
				me.parent().find('.wrong-sdt').text('Vui lòng xác nhận lại đúng số điện thoại của mình!!');
				me.parent().find('input[name="sdt"]').focus();
			} else {
				jQuery.ajax({
				  url: 'booking/checkPhone',
				  type: 'POST',
				  dataType: 'json',
				  data: {
				  	client_id: $client_id,
				  	phone: $phone
				  },
				  complete: function(xhr, textStatus) {
				    //called when complete
				  },
				  success: function(data, textStatus, xhr) {
				    if(data == 'wrong')
				    {
						setTimeout(function(){
				    		$('#alertPModal').modal('hide');
				    	}, 300);
				    	me.parent().find('.wrong-sdt').text('Vui lòng xác nhận lại đúng số điện thoại của mình!!');
						me.parent().find('input[name="sdt"').focus();
				    } else if(data == 'match')
				    {
				    	me.parent().find('input[name="fullname"]').val('');
				    	me.parent().find('input[name="fullname"]').removeClass('d-none');
				    	me.parent().find('strong[name="fullname"]').addClass('d-none');
				    	me.parent().find('strong[name="fullname"]').removeClass('d-block');
				    	me.parent().find('input[name="address"]').val('');
				    	me.parent().find('input[name="address"]').removeClass('d-none');
				    	me.parent().find('strong[name="address"]').addClass('d-none');
				    	me.parent().find('strong[name="address"]').removeClass('d-block');
				    	me.parent().find('.require-sdt').find('span').addClass('d-none');
				    	me.parent().find('input[name="lol"]').val('1');
				    	me.parent().find('.wrong-sdt').remove();
				    	me.parent().find('input[name="fullname"]').focus();
				    	me.parent().find('.ok-info').removeClass('d-none');
				    	me.addClass('d-none');
				    	setTimeout(function(){
				    		$('#alertPModal').modal('hide');
				    	}, 300);
				    }
					},
					error: function(xhr, textStatus, errorThrown) {
		    		    //called when there is an error
		    		}
		    	});
			}
		});
		$('.ok-info').click(function(event) {

			event.preventDefault();

			var me = $(this);

			$client_id = me.parent().find('input[name="clid"]').val();
			$phone = me.parent().find('input[name="sdt"]').val();

			$email = me.parent().find('input[name="email"]').val();
			$fullname = me.parent().find('input[name="fullname"]').val();
			$address = me.parent().find('input[name="address"]').val();
			$lol = me.parent().find('input[name="lol"]').val();
			if(($lol == '0') && ($phone != '') && (me.parent().find('input[name="sdt"]').hasClass('n') == false))
			{ // đặt phòng và giữ y thông tin cũ
				if($phone.length < $clphone.length || $phone.length > $clphone.length)
				{
					me.parent().find('.wrong-sdt').text('Vui lòng xác nhận lại đúng số điện thoại của mình!!');
					me.parent().find('input[name="sdt"]').focus();
				} else {
					jQuery.ajax({
					  url: 'booking/checkPhone',
					  type: 'POST',
					  dataType: 'json',
					  data: {
					  	client_id: $client_id,
					  	phone: $phone
					  },
					  complete: function(xhr, textStatus) {
					    //called when complete
					  },
					  success: function(data, textStatus, xhr) {
					    if(data == 'wrong')
					    {
					    	me.parent().find('.wrong-sdt').text('Vui lòng xác nhận lại đúng số điện thoại của mình!!');
							me.parent().find('input[name="sdt"]').focus();
					    } else if(data == 'match')
					    {
					    	me.attr("disabled", true);
					    	$('#alertPModal').modal({backdrop: 'static',keyboard: false});
					    	$room_id = me.parents('.room-desc').find('button.btn-room-detail').attr('id-room');
							$room_name = me.parents('#bookingModal').find('.modal-title').text();
							// console.log('id của phòng đang book là ' + $room_id);
							$total = me.parent().parent().parent().find('input[name="total"]').val();
							$checkin = me.parent().parent().parent().find('input[name="checkin"]').val();
							$checkout = me.parent().parent().parent().find('input[name="checkout"]').val();
							$people = me.parent().parent().parent().find('select[name="people"]').val();

							jQuery.ajax({
							  url: 'booking/send_booking',
							  type: 'POST',
							  dataType: 'json',
							  data: {
							  	client_id: $client_id,
							  	room_id: $room_id,
							  	total: $total,
							  	checkin: $checkin,
							  	checkout: $checkout,
							  	people: $people
							  },
							  complete: function(xhr, textStatus) {
							    //called when complete
								
							  },
							  success: function(data, textStatus, xhr) {
							    //called when successful
							    setTimeout(function() {
									if(data)
								    {	
								    	if(data == "booked")
								    	{
								    		$(document).find('#bookingModal').modal('hide');
								    		setTimeout(function() {
												$(document).find('#bookingModal').remove();
												
												$('#bookedModal').modal();
												setTimeout(function(){
													$('#alertPModal').modal('hide');
													setTimeout(function() {
														location.reload();
													}, 10000);
												}, 300)
									    		
											}, 400);
								    		
								    	} else if(data == "book-success")
								    	{
								    		jQuery.ajax({
								    		  url: 'booking/info_client',
								    		  type: 'POST',
								    		  dataType: 'json',
								    		  data: {client_id: $client_id},
								    		  success: function(data, textStatus, xhr) {
								    		   		$bs = $("#booksuccessModal");
										    		$(document).find('#bookingModal').modal('hide');
										    		
										    		$i4c = data;
												    $.each($i4c, function(index, val) {
												    	 $clfullname = val.fullname;
												    });
										    		$bs.find('input[name="rcname"]').val($clfullname);
										    		$bs.find('input[name="rname"]').val($room_name);
										    		$bs.find('input[name="rcheckin"]').val($checkin);
										    		$bs.find('input[name="rcheckout"]').val($checkout);
										    		$bs.find('input[name="rpeople"]').val($people);
										    		$bs.find('input[name="rtotal"]').val($total);
										    		setTimeout(function() {
														$(document).find('#bookingModal').remove();
														setTimeout(function() {
											    			$bs.modal({backdrop: 'static',keyboard: false});
											    			setTimeout(function(){
																$('#alertPModal').modal('hide');
																setTimeout(function() {
																	location.reload();
																}, 30000);
															}, 300)
														}, 500);
													}, 300);
										    		
										   //  		setTimeout(function() {
													// 	location.reload();
													// }, 30000);
								    		  },
								    		  error: function(xhr, textStatus, errorThrown) {
								    		    //called when there is an error
								    		  }
								    		});
								    	}

								    }
								}, 300);
							    
							  },
							  error: function(xhr, textStatus, errorThrown) {
							    //called when there is an error
							  }
							});
					    	setTimeout(function(){
			                    $('#alertPModal').modal('hide');
			                }, 2000);
					    }
					  },
					  error: function(xhr, textStatus, errorThrown) {
					    //called when there is an error
					  }
					});
					
				}
			} if($lol == '1')
			{ //đặt và cập nhật thông tin cũ hoặc là khách mới
				// alert('lol đang bằng 1');
				if(($fullname == '') && ($address == '') && ($phone == ''))
				{
					if($fullname == '')
					{
						me.parent().find('input[name="fullname"]').focus();
					} else if ($address == '')
					{
						me.parent().find('input[name="address"]').focus();
					} else if ($phone == '')
					{
						me.parent().find('input[name="sdt"]').focus();
					}
				} else {
					$phoneT = $phone.replace(' ','');
					$fullnameT = $fullname.replace(' ','');
					$addressT = $address.replace(' ','');
					if(($fullnameT.length >= 2) && ($addressT.length >= 4) && ($phoneT.length >= 7))
					{
						// alert('tao đang ở đây');
						me.attr("disabled", true);
				    	$('#alertPModal').modal({backdrop: 'static',keyboard: false});
				    	$room_id = me.parents('.room-desc').find('button.btn-room-detail').attr('id-room');
						$room_name = me.parents('#bookingModal').find('.modal-title').text();
						// console.log('id của phòng đang book là ' + $room_id);
						$total = me.parent().parent().parent().find('input[name="total"]').val();
						$checkin = me.parent().parent().parent().find('input[name="checkin"]').val();
						$checkout = me.parent().parent().parent().find('input[name="checkout"]').val();
						$people = me.parent().parent().parent().find('select[name="people"]').val();

						// khúc này cần lập luận xem thằng này là khách cũ update thông tin hay thằng khách mới
						// tạo một string, chứa các giá trị trong
						// mà thôi, đây là lỗ hỗng để khách cũ change email trong khi email ko đc change :)) nhưng deadline tới rrồi, ko sửa, để sau
						// nhớ là cần bắt lol = 1 và class input sdt có thêm class n
						
						jQuery.ajax({
						  url: "booking/send_booking",
						  type: "POST",
						  dataType: "json",
						  data: {
						  	client_id: $client_id,
						  	email: $email,
						  	fullname: $fullname,
						  	phone: $phone,
						  	address: $address,
						  	room_id: $room_id,
						  	total: $total,
						  	checkin: $checkin,
						  	checkout: $checkout,
						  	people: $people
						  },
						  complete: function(xhr, textStatus) {
						    //called when complete
							
						  },
						  success: function(data, textStatus, xhr) {
						    //called when successful
						    setTimeout(function() {
								if(data)
							    {	
							    	if(data == "booked")
							    	{
							    		$(document).find('#bookingModal').modal('hide');
							    		setTimeout(function() {
											$(document).find('#bookingModal').remove();
											
											$('#bookedModal').modal();
											setTimeout(function(){
												$('#alertPModal').modal('hide');
												setTimeout(function() {
													location.reload();
												}, 10000);
											}, 300)
								    		
										}, 400);
							    		
							    	} else if(data == "book-success")
							    	{
							    		jQuery.ajax({
							    		  url: 'booking/info_client',
							    		  type: 'POST',
							    		  dataType: 'json',
							    		  data: {emailToName: $email},
							    		  success: function(data, textStatus, xhr) {
							    		  		console.log('đến đây rồi');
							    		   		$bs = $("#booksuccessModal");
									    		$(document).find('#bookingModal').modal('hide');
									    		
									    		$i4c = data;
											    $.each($i4c, function(index, val) {
											    	 $clfullname = val.fullname;
											    });
									    		$bs.find('input[name="rcname"]').val($clfullname);
									    		$bs.find('input[name="rname"]').val($room_name);
									    		$bs.find('input[name="rcheckin"]').val($checkin);
									    		$bs.find('input[name="rcheckout"]').val($checkout);
									    		$bs.find('input[name="rpeople"]').val($people);
									    		$bs.find('input[name="rtotal"]').val($total);
									    		setTimeout(function() {
													$(document).find('#bookingModal').remove();
													setTimeout(function() {
										    			$bs.modal({backdrop: 'static',keyboard: false});
										    			setTimeout(function(){
															$('#alertPModal').modal('hide');
															setTimeout(function() {
																location.reload();
															}, 30000);
														}, 300)
													}, 500);
												}, 300);
									    		
									   //  		setTimeout(function() {
												// 	location.reload();
												// }, 30000);
							    		  },
							    		  error: function(xhr, textStatus, errorThrown) {
							    		    //called when there is an error
							    		  }
							    		});
							    	}

							    }
							}, 300);
						    
						  },
						  error: function(xhr, textStatus, errorThrown) {
						    //called when there is an error
						  }
						});
				    	setTimeout(function(){
		                    $('#alertPModal').modal('hide');
		                }, 2000);
					} else {
						me.parent().find('.w-ed').removeClass('d-none');
						me.parent().find('.w-ed').addClass('d-block');
						me.parent().find('input[name="fullname"]').focus();
					}
				}
			}
			

			// $email = me.parent().find('input[name="email"').val();
			// $fullname = me.parent().find('input[name="fullname"').val();
			
			// $address = me.parent().find('input[name="address"').val();
			// $room_id = me.parents('.room-desc').find('button.btn-room-detail').attr('id-room');
			// $room_name = me.parents('#bookingModal').find('.modal-title').text();
			// // console.log('id của phòng đang book là ' + $room_id);
			// $total = me.parent().parent().parent().find('input[name="total"').val();
			// $checkin = me.parent().parent().parent().find('input[name="checkin"').val();
			// $checkout = me.parent().parent().parent().find('input[name="checkout"').val();
			// $people = me.parent().parent().parent().find('select[name="people"').val();

			// me.attr("disabled", true);

			
		});
	}
	// $('#bookingModal').modal();
	
	
	

	
	// console.log($id);
});
$('.btn-refresh').click(function(event) {
	location.reload();
});
$('.icon-menu').click(function(event) {
	if($(this).hasClass('icofont-navigation-menu'))
	{
		$(this).removeClass('icofont-navigation-menu');
		$(this).addClass('icofont-close-line');
	} else if($(this).hasClass('icofont-close-line'))
	{
		$(this).removeClass('icofont-close-line');
		$(this).addClass('icofont-navigation-menu');
	}
	if($('.menu-mobile').hasClass('d-none'))
	{
		$('.menu-mobile').removeClass('d-none');
	} else $('.menu-mobile').addClass('d-none');
});
// function myFunction() {
//   if (window.pageYOffset > sticky) {
//     header.classList.add("sticky-header");
//   } else {
//     header.classList.remove("sticky-header");
//   }
// }
