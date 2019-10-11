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
console.log(1222);
return false;
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
                $('.DimmerBox').removeClass("Dimmer");
                $(this).addClass("Dimmer");
               
                
            });
            
            
            
            $('.Icons i').click(function() {
                $('.Icons i').removeClass("ActiveIcon");
                $(this).addClass("ActiveIcon");
               
                
            });
            
            
           
        });






$(document).ready(function(){
  $('.FilterBar span:first-child').click(function() {
              $(".MainCenter .Nav2 ul").toggleClass("UlFilter");
                $(".FilterBar span:first-child i").toggleClass("Rotate");
            });
    
    
    $("body").click(function() {
                $(".MainCenter .Nav2 ul").removeClass("UlFilter");


            });


            $(".FilterBar span:first-child").click(function() {
                event.stopPropagation();
                
                
            });
    
    

        });

 

$(document).ready(function(){
$('.Nav1 .nav li').click(function() {
                $('.Nav1 .nav li').removeClass("BGList");
                $(this).addClass("BGList");
               
                
            });

});

$(document).ready(function(){
  $('.Icons .fa-bars').click(function() {
              $(".MainCenter .Nav1 ul").toggleClass("UlHome");
            });
    
    
    $("body").click(function() {
                $(".MainCenter .Nav1 ul").removeClass("UlHome");


            });


            $(".Icons .fa-bars").click(function() {
                event.stopPropagation();
            });
    
    
   

        });


$(document).ready(function(){
  $('.one').click(function() {
              $(".Menu1").addClass("Option1");
            });
    
    
    $("body").click(function() {
                $(".Menu1").removeClass("Option1");


            });


            $(".one").click(function() {
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


//$(document).ready(function() {
//            $('.Icons i').click(function() {
//                $('i').removeClass("ActiveIcon");
//                $(this).addClass("ActiveIcon");
//            });
//        });


