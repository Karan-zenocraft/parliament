function myFunction() {
  var dots = document.getElementById("dots");
  var moreText = document.getElementById("more");
  var btnText = document.getElementById("myBtn");

  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "Read more"; 
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "Read less"; 
    moreText.style.display = "inline";
  }
}

function myFunction1() {
  var dots = document.getElementById("dots1");
  var moreText = document.getElementById("more1");
  var btnText = document.getElementById("myBtn1");

  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "Read more"; 
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "Read less"; 
    moreText.style.display = "inline";
  }
}
 function countChar(val) {
         $('#charNum').text(len+"/540");
        var len = val.value.length;
        if (len >= 540) {
        val.value = val.value.substring(0, 540);
          $('#charNum').text("540/540");
          $('#charNum').css('color', 'red');
        } else {
          $('#charNum').css('color', 'black');
          $('#charNum').text(len+"/540");
        }
      };
$(document).ready(function() {
                $(window).scroll(function() {
                    if ($(this).scrollTop() > 100) {
                        $('#scroll').fadeIn();
                    } else {
                        $('#scroll').fadeOut();
                    }
                });
                $('#scroll').click(function() {
                    $("html, body").animate({
                        scrollTop: 0
                    }, 600);
                    return false;
                });
            });

        
         var scrollLink = $('.scroll');
  // Smooth scrolling
  scrollLink.click(function(e) {
    e.preventDefault();
    $('body,html').animate({
      scrollTop: $(this.hash).offset().top
    }, 1000 );
  });

$(document).ready(function() {
            $('.Menu1 ul li').click(function() {
                $('li').removeClass("active1");
                $(this).addClass("active1");
            });
        });



    $('ul li a').click( function(){
    if ( $(this).hasClass('current') ) {
        $(this).removeClass('current');
    } else {
        $('li a.current').removeClass('current');
        $(this).addClass('current');    
    }
});

        $(document).ready(function() {
            $('.DimmerBox').click(function() {
                // $('.DimmerBox').removeClass("Dimmer");
                $(this).toggleClass("Dimmer");
               
                
            });
        });


$(document).ready(function(){
  $('#one').click(function() {
              $(".Menu1").addClass("Option1");
            });
    
    
    $("body").click(function() {
                $(".Menu1").removeClass("Option1");


            });


            $("#one").click(function() {
                event.stopPropagation();
            });

        });



$(document).ready(function(){
$(".OnhoverGroup").mouseenter(function() {
      $(".OnhoverMP").show();
}).mouseleave(function() {
      $(".OnhoverMP").hide();
});
});


$(document).ready(function(){
  $("#Load1 a").click(function(){
    $("#Load1 a").toggleClass("MadeLouderBG");
  });
    
    $("#Load2").click(function(){
    $("#Load2").toggleClass("LoadBG");
  });
});
$("#engagement").click(function(){
    $.ajax({
       url: "site/engagement",
       type: 'post',
       data: {
                 searchname: 123, 
             },
       success: function (data) {
          console.log(data);
          return false;
       }
  });
});

$("#CurrentCity").click(function(){
  var sort = $("#sort").val();
  if(sort == "asc"){
    $("#sort").val("desc");
  }else{
    $("#sort").val("asc");
  }
    $.ajax({
       url: "site/current-city",
       type: 'post',
       data: {
                 sort:$("#sort").val(), 
             },
       success: function (data) {
          $('#list_mp').replaceWith(data);
       }
  });
});

$(document).ready(function(){
  $('#questions-mp_id').on('select2:select', function (e) {
     var data = e.params.data;
    var mp_id = "mp_"+data.id;
    $("#"+mp_id).addClass("Dimmer");
});
  $('#questions-mp_id').on('select2:unselect', function (e) {
     var data = e.params.data;
    var mp_id = "mp_"+data.id;
    $("#"+mp_id).removeClass("Dimmer");
});
 });