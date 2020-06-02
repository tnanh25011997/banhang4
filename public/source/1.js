//fix header
document.addEventListener("DOMContentLoaded",function(){
	var menu = document.querySelector('.menuduoi');
	var trangthaimenu = "duoi55";
	window.addEventListener('scroll',function(){
		
		if(window.pageYOffset > 53){
			if(trangthaimenu == "duoi55"){
				trangthaimenu = "tren55";
				menu.classList.add('dungyen');
			}
		}
		else if(window.pageYOffset < 55){
			if(trangthaimenu == "tren55"){
				trangthaimenu = "duoi55";
				menu.classList.remove('dungyen');
			}
		}
	})
})

//menu responsive
$(".xomenu").click(function(event) {
	$(".menuduoi").toggleClass("menuresponsive");
	$(".xomenu").toggleClass("xomenured");
});

//toggle
$('[data-toggle="tooltip"]').tooltip();

// click account responsive
$(".tentaikhoan").click(function(event) {
    $(".listtaikhoan").toggleClass("tentaikhoanclick");
});

function closebuy(){
	$('.add-to-cart-success').addClass('removebuy');
}
$(window).scroll(function() {    
    var scroll = $(window).scrollTop();
    if (scroll >= 100) {
        $('.add-to-cart-success').addClass('removebuy');
    }
});

//Owl carousel
jQuery(function($){ 
	$(".owl-carousel").owlCarousel(); 
});
$('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})

//AJAX gio hang
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function updateItem(idcart,id){
    num = $("#num_"+idcart).val();
    $.ajax({
       type:'POST',
       url:'update-giohang',
       data:{idcart:idcart, idsp:id, soluong:num},
       success:function(data){
            //$("#noidunggiohang").load("http://localhost/banhang/public/gio-hang #ndgh");
            location.reload()
             
        }
    });

}
