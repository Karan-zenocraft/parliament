function myFunction(id,element) {
  //console.log(id);
  var dots = document.getElementById("dots_"+id);
 // var moreText = document.getElementById("more_"+id);
  var ansText = document.getElementById("answer_"+id);
  var btnText = document.getElementById("question_"+id);
  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "Read more"; 
    moreText.style.display = "none";
    ansText.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "Read less"; 
    moreText.style.display = "inline";
    ansText.style.display = "inline";
  }
}
function reportQuestion(id) {

  var report_comment = $.trim($("#report"+id).val());
  if(report_comment==''){alert('report comment can not be blank'); return false;}
   $.ajax({
     url: "site/report-question",
     type: 'post',
     dataType: 'json',
     data: {
               report_comment: report_comment, 
               question_id:id,
           },
     success: function (data) {
      if(data == "success"){
        alert("question reported successfully.")
        $("#myModal"+id).css("display","none");
        location.reload();     
      }else if(data=="reported"){
        alert("You have already reported this question");
        location.reload();     
      }else{
        alert("something went wrong");
      }
     }
  });
}
function retract_question(id) {
 if (confirm("Press a button!")) {
    txt = "ok";
  } else {
    txt = "cancel";
  }
  if(txt == "ok"){
    $.ajax({
     url: "site/retract-question",
     type: 'post',
     dataType: 'json',
     data: { 
               question_id:id,
           },
     success: function (data) {

    if(data == "success"){
      $("#questions_answers"+id).remove();
      alert("Question is successfully retracted");
    }else{
      alert("You can not retract as question is answered.")
    }
      ///location.reload();
     }
  });
  }
}
function hide_question(id) {
 if (confirm("Are you sure you want to hide question.")) {
    txt = "yes";
  } else {
    txt = "No";
  }
  if(txt == "yes"){
    $.ajax({
     url: "site/hide-question",
     type: 'post',
     dataType: 'json',
     data: { 
               question_id:id,
           },
     success: function (data) {
    if(data == "success"){
      $("#questions_answers"+id).remove();
      alert("Question is successfully hide");
    }
      //location.reload();
     }
  });
  }
}
function myFunction1(id) {
  //var id = $(this).attr('id');
  var dots = document.getElementById("dots"+id);
  var moreText = document.getElementById("more"+id);
  var moreText2 = document.getElementById("more2"+id);
  var btnText = document.getElementById("myBtn1"+id);
  
  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "Read more"; 
    moreText.style.display = "none";
    moreText2.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "Read less"; 
    moreText.style.display = "inline";
      moreText2.style.display = "block";
  }
}

function sortBy()
{
  var sort = $("#sort").val();
  if(sort == "asc"){
    $("#sort").val("desc");
  }else{
    $("#sort").val("asc");
  }
  return $("#sort").val();
}
function sortByCitizen()
{
  var sort = $("#sort_citizen").val();
  if(sort == "asc"){
    $("#sort_citizen").val("desc");
  }else{
    $("#sort_citizen").val("asc");
  }
  return $("#sort_citizen").val();
}
function AjaxCallSort(dataValue)
{
    var sortdir = sortBy();
    var search = $('#searchMP').val();
      $("#page").val(1);
    $('#sortby').val(dataValue);
         //console.log(dataValue+"-"+search+"-"+sortdir);

    $.ajax({
     url: "site/current-city",
     type: 'post',
     dataType: 'json',
     data: {
               sortby: dataValue, 
               sortdir:sortdir,
               search : search,
               page: 1

           },
     success: function (data) {
       $('#list_mp').html(data);
     }
  });
}
function AjaxCallSortCitizen(dataValue)
{
    $("#citizensList").show();
    $("#citizen").show();
    $("#home").hide();
    var sortdir = sortByCitizen();
    var search = $('#search_citizen').val();
    $("#page_citizen").val(1);
    $('#sortby_citizen').val(dataValue);
         //console.log(dataValue+"-"+search+"-"+sortdir);

    $.ajax({
     url: "site/get-citizen-list",
     type: 'post',
     dataType: 'json',
     data: {
               sortby: dataValue, 
               sortdir:sortdir,
               search : search,
               page: 1

           },
     success: function (response) {
       $('#citizensList').html(response.data);
     }
  });
}
function QuestionAnswer()
{
  var nextpage = $("#pageQuestion").val();
  var filter = $("#filterQuestion").val();
  if((filter == "myQue") || (filter == "myLouder") || (filter == "mpNotAns")) {

      //$("#filterQuestion2").val("");
      $(".BGList a").removeClass("active show");
  }
    if((filter == "Homefeed") || (filter == "")){
      $(".hideHome").show();
  }else{
      $(".hideHome").hide();
  }
  if((filter == "Homefeed") || (filter == "Answered") || (filter == "Unanswered")) {
    $(".Public").show();
  }else{
    $(".Public").hide();
  }
  var filter2 = $("#filterQuestion2").val();
  var search = $("#filterSearch").val();
  var user_id = $('#user_id').val();
  $("#citizensList").hide();
  $("#pageQuestion").val(++nextpage);
      $.ajax({
     url: 'site/load-more-questions',
     type: 'post',
     dataType: 'json',
     data: {
            page:nextpage,
            filter:filter,
            filter2:filter2,
            search:search,
            user_id:user_id
           },
     success: function (response) {
       if(nextpage=='1'){
          $('#ajaxQuestion').html(response.data);
        }
        else{
          $('#ajaxQuestion').append(response.data);
        }
       if(response.count == 0)
       {
          $('#loadmoreData').hide();
       }else{
        $('#loadmoreData').show();
       }
     }
  });
}
function filterQuestion(flag)
{
  $("#citizensList").hide();
  $("#citizen").hide();
  $("#home").show();
  $("#filterQuestion").val(flag);
  $("#pageQuestion").val('0');
  QuestionAnswer();
}
function filterQuestion2(flag)
{
  $("#filterQuestion2").val(flag);
  $("#pageQuestion").val('0');
  QuestionAnswer();
}
function filterSearch(e)
{
   if (e.keyCode == 13) {
  $("#pageQuestion").val('0');
  QuestionAnswer()
}
}
function AjaxCallSearch(e)
{
   if (e.keyCode == 13) {
    var sortdir = $("#sort").val();
    var sortby = $("#sortby").val();
    var page = $("#page").val();
    var search = $('#searchMP').val();
     //console.log(search+"-"+sortby+"-"+sortdir);

    $.ajax({
     url: "site/current-city",
     type: 'post',
     dataType: 'json',
     data: {
               sortby: sortby, 
               sortdir:sortdir,
               search: search, 
               page: page
           },
     success: function (data) {
         $('#list_mp').html(data);
     }
  });
  }
}
function AjaxCallSearchCitizen(e)
{
   if (e.keyCode == 13) {
    var sortdir = $("#sort_citizen").val();
    var sortby = $("#sortby_citizen").val();
    var page = $("#page_citizen").val();
    var search = $('#search_citizen').val();
/*console.log(search+"-"+sortby+"-"+sortdir);
return false;*/
    $.ajax({
     url: "site/get-citizen-list",
     type: 'post',
     dataType: 'json',
     data: {
               sortby: sortby, 
               sortdir:sortdir,
               search: search, 
               page: page
           },
     success: function (response) {
      $('#citizensList').html(response.data);
     }
  });
  }
}
function getPage(flag)
{
  if(flag=='next'){
     var page = $("#page").val();
     $("#page").val(++page);
     $(".carousel-control-next-icon").attr("page",page);
  }
  else
  {
    var page = $("#page").val();
     $("#page").val(--page);
     $(".carousel-control-prev-icon").attr("page",page);
  }
  $("#page").val(page);
  var sortdir = $("#sort").val();
    var sortby = $("#sortby").val();
    var page = $("#page").val();
    var search = $('#searchMP').val();
     //console.log(search+"-"+sortby+"-"+sortdir);

    $.ajax({
     url: "site/current-city",
     type: 'post',
     dataType: 'json',
     data: {
               sortby: sortby, 
               sortdir:sortdir,
               search: search, 
               page: page
           },
     success: function (data) {
         $('#list_mp').html(data);
     }
  });
}
function getPageCitizen(flag)
{
  $('#citizensList').show();
     var page = $("#page_citizen").val();
  if(flag=='next'){
     $("#page_citizen").val(++page);
     /*$(".carousel-control-next-icon").attr("page",page);*/
  }
  else
  {
     $("#page_citizen").val(--page);
     /*$(".carousel-control-prev-icon").attr("page",page);*/
  }
  $("#page_citizen").val(page);
  var sortdir = $("#sort_citizen").val();
    var sortby = $("#sortby_citizen").val();
    var page = $("#page_citizen").val();
    var search = $('#search_citizen').val();

    $.ajax({
     url: "site/get-citizen-list",
     type: 'post',
     dataType: 'json',
     data: {
               sortby: sortby, 
               sortdir:sortdir,
               search: search, 
               page: page
           },
     success: function (response) {
         $('#citizensList').html(response.data);
     }
  });
}
function answer_toggle(id){
     // $(".AskFollowUpBox").removeClass("GiveAnswerBox"); 
    $("#AnswerQuestionBox"+id).toggleClass("GiveAnswerBox");
}

// HASHTAG
$(function(){
  var hashtag = window.location.hash.substr(1);
  var hash = window.location.hash;
  if(hash=='#citizen')
  {
    AjaxCallSortCitizen();
  }
  else if(hash=='#Homefeed' || hash=='#Unanswered' || hash=='#Answered')
  {
    filterQuestion(hashtag);
  }
  else
  {
    QuestionAnswer();
  }
  hash && $('ul.nav a[href="' + hash + '"]').tab('show');

  $('.nav-tabs a').click(function (e) {
    $(this).tab('show');
    var scrollmem = $('body').scrollTop() || $('html').scrollTop();
    window.location.hash = this.hash;
    $('html,body').scrollTop(scrollmem);
  });
});
function submitAnswer(question_id)
{
  var answer = $.trim($(".model_answer"+question_id).val());
  if(answer==''){alert('Answer can not be blank'); return false;}
   $.ajax({
     url: "site/answer-question",
     type: 'post',
     dataType: 'json',
     data: {
               answer: answer, 
               question_id:question_id,
           },
            beforeSend: function() {
        // setting a timeout
        $('#overlay').fadeIn();
    },
     success: function (data) {
         $("#AnswerQuestionBox"+question_id).removeClass('GiveAnswerBox');
         $('#answersList'+question_id).prepend(data.data);
          $('#answered_by'+question_id).html(data.data2);
          $('#QuestionAnswerBox'+question_id).css('border-color','#085820');
         $('#more2'+question_id).css('display:inline');
         $('.model_answer'+question_id).val("");
         var title = data.user_name + " has answered on your question ";
           var userid = data.ask_user_id;
           sendNotification(title,userid);
     },
      complete: function() {
        $('#overlay').fadeOut();
    },
  }); 
}
function submitQuestion(e)
{
 e.preventDefault();
  var mpIds = $("#questions-mp_id").val();
  var flag = 1;
   if(mpIds.length == 0){
    $('.mp_error').text("Please select atleast one MP");
    var flag = 0;
   // $('.field-questions-mp_id').addClass('has-error');
  }else if(mpIds.length > 5){
     $('.mp_error').text("");
    $('.mp_error').text("You can select maximum 5 mps");
    var flag = 0;
  }else{
     $('.mp_error').text("");
    var flag = 1;
  }
  var questionArea =  $('#questions-question').val();
  if(questionArea  == ''){
    $('.question_error').text("Question can not be blank");
    var flag = 0;
   // $('.field-questions-question').addClass('has-error');
  }else{
    $('.question_error').text("");
    var flag = 1;
  }
  if(flag == 1){
    $('.question_error').text("");
    $('.mp_error').text("");

     $.ajax({
       url: "site/save-question",
       type: 'post',
       dataType: 'json',
       data: {
                 question: questionArea, 
                 mp_id:mpIds,
             },
               beforeSend: function() {
        // setting a timeout
        $('#overlay').fadeIn();
    },
       success: function (data) {
        if(data == "error"){
          $('.question_error').text("You can not ask question as question limit reaches of this week");
          var flag = 0;
          return false;
        }
        if(data.user_agent_name != ""){
          var title = data.user_agent_name+" has asked you a question";
          mpIds.forEach(function(mp_id){
            sendNotification(title,mp_id);
          });
         location.reload();
        }
          },   complete: function() {
        $('#overlay').fadeOut();
    },
    });

  }
}
function submitComment(question_id)
{
  var comment_count = $('#comments'+question_id).text();
  var comment = $.trim($("#comment_text"+question_id).val());
  if(comment==''){alert('comment can not be blank'); return false;}
   $.ajax({
     url: "site/save-comment",
     type: 'post',
     dataType: 'json',
     data: {
               comment: comment, 
               question_id:question_id,
           },
            beforeSend: function() {
        $('#overlay').fadeIn();
    },

     success: function (data) {
         $('#commentArray'+question_id).prepend(data.data);
         $("#AnswerQuestionBox"+question_id).removeClass("GiveAnswerBox");
         $('.AddComment').val('');
         $('#comments'+question_id).text(++comment_count);
         $('#comment_count_left'+question_id).text(comment_count);
           var title = data.user_name + " has commented on your question ";
           var userid = data.ask_user_id;
            if(data.comment_user_id != userid ){
          sendNotification(title,userid);
        }
     },
      complete: function() {
        $('#overlay').fadeOut();
    },
  });
}
function show_comments(id){
      $(".AnswerQuestionBox").removeClass("GiveAnswerBox");
      $(".AskFollowUpBox").removeClass("GiveAnswerBox"); 
    $("#CommentBox"+id).toggleClass("GiveAnswerBox");
}

function show_mp_list(id){
      $("#OnhoverMP"+id).show();
}
function hide_mp_list(id){
 
      $("#OnhoverMP"+id).hide();

}
function show_mp_list_left(){
    alert(133);
      $("#OnhoverMPleft").show();
}
function hide_mp_list_left(){
 
      $("#OnhoverMPleft").hide();

}
function editProfile(user_id)
{
  var education = $.trim($('.education_profile').val());
  var work = $.trim($('.work_profile').val());
  if((education != "") && (work != "")){
   $.ajax({
     url: "site/edit-profile",
     type: 'post',
     dataType: 'json',
     data: {
               education: education, 
               work:work,
               user_id:user_id
           },
     success: function (data) {
      if(data.msg == "success"){
         location.reload();
      }else{
         alert("There is some problem to updatating the profile")
         location.reload();
      }
     }
  });
 }else{
  return false;
 }
}
/*function facebook_share(title, desc, url, image){
FB.ui(
{
method: 'feed',
name: 'Fitsumbirhan Zeroem',
href:url,
link: 'ask.zenocraft.com',
picture: 'http://ask.zenocraft.com/themes/parliament_theme/image/Inner-Logo.png',
caption: 'Ask',
description: "Why is 1+3=4?",
message: "test question"
});
}*/
function facebook_share(question_id){
      $.ajax({
     url: "site/check-if-shared",
     type: 'post',
     dataType: 'json',
     data: {
               question_id: question_id, 
           },
     success: function (data) {
      if(data.msg == "success"){
          postToFeed(question_id);
     }else{
        alert("You have already shared this question.");
      }
     }
  });  
}

  window.fbAsyncInit = function(){
FB.init({
    appId: '465073670768272', status: true, cookie: true, xfbml: true }); 
};
(function(d, debug){var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
    if(d.getElementById(id)) {return;}
    js = d.createElement('script'); js.id = id; 
    js.async = true;js.src = "//connect.facebook.net/en_US/all" + (debug ? "/debug" : "") + ".js";
    ref.parentNode.insertBefore(js, ref);}(document,false));

function postToFeed(question_id){
var obj = {
            method: 'feed',
            link: 'ask.zenocraft.com/site/view-question?id='+question_id, 
            picture: 'http://ask.zenocraft.com/themes/parliament_theme/image/Logo1.png',
            name: 'question',
            description: 'test'
          };
function callback(response){

  if(response == null){
    console.log('was not shared');
  }else{
       $.ajax({
     url: "site/facebook-share",
     type: 'post',
     dataType: 'json',
     data: {
               question_id: question_id, 
           },
     success: function (data) {
      if(data.msg == "success"){
         location.reload();
      }else{
        alert("There might be a problem to while sharing on facebook.");
      }
     }
  });   
  }
 
     
}
FB.ui(obj, callback);
}


/*function get_citizen_list(){
    $("#citizensList").show();

   $.ajax({
     url: "site/get-citizen-list",
     type: 'post',
     dataType: 'json',
     data: {
               page: 1, 
              // question_id:question_id,
           },
     success: function (response) {
      $('#citizensList').html(response.data);
     }
  });
}*/
function sendNotification(title,userid){
      pubnub = new PubNub({
            publishKey: 'pub-c-e371713b-ce3a-41c9-89e1-ac0d397c8e9a',
            subscribeKey: 'sub-c-9a5383e4-f424-11e9-bdee-36080f78eb20',
            secretKey: 'sub-c-9a5383e4-f424-11e9-bdee-36080f78eb20',
          })

    function publishSampleMessage() {
        var publishConfig = {
            channel : "ask",
            message: {
                title: title,
                description: "hello world!",
                userid:userid,
                flag:true,
                site:'ask.zenocraft.com'
            }
        }
        pubnub.publish(publishConfig, function(status, response) {
            console.log(status, response);
        })
    }

    pubnub.addListener({
        status: function(statusEvent) {
            if (statusEvent.category === "PNConnectedCategory") {
                publishSampleMessage();
            }
        },
        message: function(msg) {
            console.log(msg.message.title);
            console.log(msg.message.description);
        },
        presence: function(presenceEvent) {
            // handle presence
        }
    })
    console.log("Subscribing..");
    pubnub.subscribe({
        channels: ['rutusha']
    });
}
function getNotification(){
   pubnub = new PubNub({
            publishKey: 'pub-c-e371713b-ce3a-41c9-89e1-ac0d397c8e9a',
            subscribeKey: 'sub-c-9a5383e4-f424-11e9-bdee-36080f78eb20',
            secretKey: 'sub-c-9a5383e4-f424-11e9-bdee-36080f78eb20',
    });
var login_user_id = $('#login_user_id').val();


 pubnub.addListener({
                message: function(message) {
                   var usersN=message.message.userid;
        // var title =message.message.title;
         //if(usersN.includes(login_user_id))
                    if(usersN == login_user_id){
                         var count = $('.badge-secondary').text();
                         count++;
                         $('.badge-secondary').text(count);
                         $(".dynamic_notification").prepend('<li><a href="#">'+message.message.title+'</li>');
                    }
                        if (!("Notification" in window)) {
                            console.log("This browser does not support desktop notification");
                        }
                        else if (Notification.permission === "granted") {
                            alert(message.message.title);
                            setTimeout(notification.close.bind(notification), 4000);
                            //model_popup("info","New Crisis Added",message.message.title);
                        }
                        else if (Notification.permission !== 'denied') {
                            Notification.requestPermission(function (permission) {
                                if (permission === "granted") {
                                   // console.log(message.message.title);
                                    alert(message.message.title);
                                }

                            });
                        }
                    }
                    // }
                });
            pubnub.subscribe({
                    channels: ['ask'],
                    // withPresence: true
                });
}
function clear_notification(user_id){
     $.ajax({
     url: "site/clear-notifications",
     type: 'post',
     dataType: 'json',
     data: {
               user_id:user_id
           },
     success: function (data) {
      if(data.msg == "success"){
         location.reload();
      }else{
         alert("There is some problem to clear notification.")
         location.reload();
      }
     }
  });
}
$(document).ready(function() {
                  pubnub = new PubNub({
            publishKey: 'pub-c-e371713b-ce3a-41c9-89e1-ac0d397c8e9a',
            subscribeKey: 'sub-c-9a5383e4-f424-11e9-bdee-36080f78eb20',
            secretKey: 'sub-c-9a5383e4-f424-11e9-bdee-36080f78eb20',
    });
                getNotification();
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
        //  $('.DimmerBox').on('click', '.deletelanguage', function(){
      /*  $(document).on('click', '.DimmerBox', function () {
           // $('.DimmerBox').click(function() {
                //$('.DimmerBox').removeClass("Dimmer");
                $(this).toggleClass("Dimmer"); 
            });*/    
            $('.Icons i').click(function() {
                $('.Icons i').removeClass("ActiveIcon");
                $(this).addClass("ActiveIcon");
               
                
            });
            
            
             $('.Icons  .fa-bell').click(function() {
                $('.Icons .fa-bell').addClass("NotificationBadgeCircle");
                
               
                
            });
            
            
            
          
        });


























//$(".MainCenter .Nav1 ul").removeClassClass("UlHome");


$(document).ready(function(){
  $('.FilterBar span:first-child').click(function() {
               $(".Icons i").removeClass("ActiveArrow");
                $(".MainCenter .Nav1 ul").removeClass("UlHome");
                $(".HeaderBottomCenter .Nav3").removeClass("UlNotification");
                $(".HeaderBottomCenter .Nav4").removeClass("UlSetting");
      $("header .HeaderBottomCenter .Search").removeClass("UlSearch"); /*Searchmobilemenu*/
                $(".MainCenter .Nav2 ul").toggleClass("UlFilter");
                $(".MainCenter .Nav6 ul").toggleClass("UlFilterCitizen");
                $(".FilterBar span:first-child i").toggleClass("Rotate");
                
            });
    
    
    $("body").click(function() {
                 $(".MainCenter .Nav6 ul").removeClass("UlFilterCitizen");
                $(".MainCenter .Nav2 ul").removeClass("UlFilter");
                 $(".FilterBar span:first-child i").removeClass("Rotate");

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
$('.Nav2 .nav li').click(function() {
                $('.Nav2 .nav li').removeClass("FilterActive");
                $(this).addClass("FilterActive");
               
                
            });

});


$(document).ready(function(){
    
    $('.Nav1 .nav li').click(function() {

$('.Icons .fa-rss-square').addClass("ActiveIcon");

 });
    
    });

$(document).ready(function(){
    
    $('.Nav1 .nav li:first-child').click(function() {
              
                $('.tab-content #home').addClass("Flex");
                
               
                
            });
    
$('.Nav1 .nav li:last-child, .Nav1 .nav li:nth-child(2), .Nav1 .nav li:nth-child(3)').click(function() {
              
                $('.tab-content #home').removeClass("Flex");
               
                
            });

});




//new js


$(document).ready(function(){
  $('.Icons .fa-cog').click(function() {
              $(".HeaderBottomCenter .Nav4").toggleClass("UlSetting");
                $(".HeaderBottomCenter .Nav3").removeClass("UlNotification");
       $(".MainCenter .Nav6 ul").removeClass("UlFilterCitizen");
      $("header .HeaderBottomCenter .Search").removeClass("UlSearch"); /*Searchmobilemenu*/
                $(".MainCenter .Nav2 ul").removeClass("UlFilter");
                $(".MainCenter .Nav1 ul").removeClass("UlHome");
            });
    
    
    $("body").click(function() {
                $(".HeaderBottomCenter .Nav4").removeClass("UlSetting");


            });


            $(".Icons .fa-cog").click(function() {
                event.stopPropagation();
            });
    
//     $(".HeaderBottomCenter .Nav3 li span:last-child").click(function() {
//                event.stopPropagation();
//            });
    
   

        });


$(document).ready(function(){
$('.Nav4 li').click(function() {
                $('.Nav4 li').removeClass("BGList");
                $(this).addClass("BGList");
               
                
            });

});





jQuery(document).ready(function($) {
  var alterClass = function() {
    var ww = document.body.clientWidth;
    if (ww < 992) {
      $('.Nav5').removeClass('Nav2');
    } else if (ww >= 992) {
     $('.Nav5').addClass('Nav2');
    };
  };
  $(window).resize(function(){
    alterClass();
  });
  //Fire it when the page first loads:
  alterClass();
});



$(document).ready(function(){
$('.Nav5 .nav li').click(function() {
                $('.Nav5 .nav li').removeClass("FilterActive");
                $(this).addClass("FilterActive");
               
                
            });

});


$(document).ready(function(){
    $('.BlockCaption .Follow').click(function() {
        var $span = $(this).find("span:first-child");
        var $this = $(this);
    
    if($this.hasClass('Followed')){
      $this.removeClass("Followed");
       $this.addClass("Following");
        $span.text('Following');
         
   } else {
      $this.removeClass("Following");
       $this.addClass("Followed");
       
       $span.text('Follow');
   }
    
                           
                
});        

});




//end new js




$(document).ready(function(){
  $('.Icons .fa-bell').click(function() {
              $(".HeaderBottomCenter .Nav3").toggleClass("UlNotification");
                $(".HeaderBottomCenter .Nav4").removeClass("UlSetting");
       $(".MainCenter .Nav6 ul").removeClass("UlFilterCitizen");
      $("header .HeaderBottomCenter .Search").removeClass("UlSearch"); /*Searchmobilemenu add also for above commented notification*/
                $(".MainCenter .Nav2 ul").removeClass("UlFilter");
                $(".MainCenter .Nav1 ul").removeClass("UlHome");
            });
    
    
    $("body").click(function() {
                $(".HeaderBottomCenter .Nav3").removeClass("UlNotification");
            });


            $(".Icons .fa-bell").click(function() {
                event.stopPropagation();
            });
    
     $(".HeaderBottomCenter .Nav3 li span:last-child").click(function() {
                event.stopPropagation();
            });
    
   

        });



$(document).ready(function(){
  $('.Icons .fa-bars').click(function() {
              $(".MainCenter .Nav1 ul").toggleClass("UlHome");
                $(".HeaderBottomCenter .Nav4").removeClass("UlSetting");
                $(".MainCenter .Nav2 ul").removeClass("UlFilter");
      $("header .HeaderBottomCenter .Search").removeClass("UlSearch"); /*Searchmobilemenu add also for above commented notification*/
       $(".MainCenter .Nav6 ul").removeClass("UlFilterCitizen");
            $(".HeaderBottomCenter .Nav3").removeClass("UlNotification");
            });
    
    
    $("body").click(function() {
                $(".MainCenter .Nav1 ul").removeClass("UlHome");


            });


            $(".Icons .fa-bars").click(function() {
                event.stopPropagation();
            });
    
    
   

        });


$(document).ready(function(){
  //$('.one').click(function() {
$(document).on('click', '.one', function () {
    var id = $(this).attr('id');
    $(".menu_report").removeClass("Option1");
              $("#menu"+id).toggleClass("Option1");
              $(this).toggleClass("Option2");
            });
    
    $("body").click(function() {
                $(".menu_report").removeClass("Option1");
            });
            $(".one").click(function() {
                event.stopPropagation();
            });

        });





$(document).ready(function(){
  //$(".Loud").click(function(){
    $(document).on('click', '.Loud', function () {
    $(this).attr('disabled', true);
    var id = $(this).attr('id');
    if(id == "Load2"){
      var question_id = $(this).attr('data-question');
       if($("#Load2").hasClass('LoadBG')){
        var event = "unlike";
      }else{
        var event = "like";
      }
    $.ajax({
     url: "site/make-louder",
     type: 'post',
     dataType: 'json',
     data: {
            question_id:question_id,
            event:event
           },
     success: function (data) {
      //var response = JSON.stringify(data)
      if(data.event == "unlike"){
        $("#Load2").removeClass("LoadBG");
        $("#Load2_count").text(data.louderCount);
        $("#Load"+question_id+" a").removeClass("MadeLouderBG")
        $('#numbers'+question_id).text(data.louderCount);
      }else{
        $("#Load2").addClass("LoadBG");
        $("#Load2_count").text(data.louderCount);
         $("#Load"+question_id+" a").addClass("MadeLouderBG")
        $('#numbers'+question_id).text(data.louderCount);
      }

     }
  });
    }else{
     var question_id = $(this).attr('data-myval');
      if($("#"+id+" a").hasClass('MadeLouderBG')){
        var event = "unlike";
      }else{
        var event = "like";
      }
     $.ajax({
     url: "site/make-louder",
     type: 'post',
     dataType: 'json',
     data: {
            question_id:question_id,
            event:event
           },
     success: function (data) {
      //var response = JSON.stringify(data);
      var load_question_id = $('#Load2').attr('data-question');
      if(data.event == "unlike"){
        $("#"+id+" a").removeClass("MadeLouderBG");
        $('#numbers'+question_id).text(data.louderCount);
        if(question_id == load_question_id){
          $("#Load2").removeClass("LoadBG");
        $("#Load2_count").text(data.louderCount);
        }
      }else{
        $("#"+id+" a").addClass("MadeLouderBG");
        $('#numbers'+question_id).text(data.louderCount);
        if(question_id == load_question_id){
          $("#Load2").addClass("LoadBG");
        $("#Load2_count").text(data.louderCount);
        }
        var title = data.louder_by+" made louder on your question ";
        var userid = data.ask_user_id;
        if(data.louder_user_id != userid ){
          sendNotification(title,userid);
        }
      }
    $('#'+id).attr('disabled', false);

     }
  });
    }

  });
    
   /* $("#Load2").click(function(){
    $("#Load2").toggleClass("LoadBG");
  });*/
});


//$(document).ready(function() {
//            $('.Icons i').click(function() {
//                $('i').removeClass("ActiveIcon");
//                $(this).addClass("ActiveIcon");
//            });
//        });




//   give answer




// $(document).ready(function(){
//   $(".AskFollowUp").click(function(){
//       $(".AnswerQuestionBox").removeClass("GiveAnswerBox");  
//     $(".AskFollowUpBox").toggleClass("GiveAnswerBox");
//   });
    
    
// });




$(document).ready(function() {
$('.Icons .fa-bell').click(function() {
                $(".Icons .fa-bars").removeClass("ActiveArrow");
                $(".Icons .fa-cog").removeClass("ActiveArrow");
     $(".Icons .fa-search").removeClass("ActiveArrow"); /*Searchmobilemenu*/
                $(this).toggleClass("ActiveArrow");
               
                
            });
    
        $("body").click(function() {
                $(".Icons .fa-bell").removeClass("ActiveArrow");


            });
    
    
    $('.Icons .fa-bars').click(function() {
                 $(".Icons .fa-bell").removeClass("ActiveArrow");
                $(".Icons .fa-cog").removeClass("ActiveArrow");
        $(".Icons .fa-search").removeClass("ActiveArrow"); /*Searchmobilemenu*/
                $(this).toggleClass("ActiveArrow");
               
                
            });
    
        $("body").click(function() {
                
                $(".Icons .fa-bars").removeClass("ActiveArrow");


            });


    
    $('.Icons .fa-cog').click(function() {
                $(".Icons .fa-bars").removeClass("ActiveArrow");
                 $(".Icons .fa-bell").removeClass("ActiveArrow");
        $(".Icons .fa-search").removeClass("ActiveArrow"); /*Searchmobilemenu*/
                $(this).toggleClass("ActiveArrow");
               
                
            });
    
        $("body").click(function() {
                
                $(".Icons .fa-cog").removeClass("ActiveArrow");


            });
            

    /*Searchmobilemenu add in between script*/

    
    
     $('.Icons .fa-search').click(function() {
                $(".Icons .fa-bars").removeClass("ActiveArrow");
                 $(".Icons .fa-bell").removeClass("ActiveArrow");
                $(".Icons .fa-cog").removeClass("ActiveArrow");
                $(this).toggleClass("ActiveArrow");
               
                
            });
    
        $("body").click(function() {
                
                $(".Icons .fa-search").removeClass("ActiveArrow");


            });
    
    
    /*Searchmobilemenu end*/
    
    
    
    });



/*Searchmobilemenu new*/



$(document).ready(function(){
  $('.Icons .fa-search').click(function() {
              $("header .HeaderBottomCenter .Search").toggleClass("UlSearch");
                $(".HeaderBottomCenter .Nav4").removeClass("UlSetting");
      $(".Main .MainCenter .Nav1 ul").removeClass("UlHome");
                $(".MainCenter .Nav2 ul").removeClass("UlFilter");
       $(".MainCenter .Nav6 ul").removeClass("UlFilterCitizen");
            $(".HeaderBottomCenter .Nav3").removeClass("UlNotification");
            });
    
    
    $("body").click(function() {
                $("header .HeaderBottomCenter .Search").removeClass("UlSearch");


            });


            $(".Icons .fa-search").click(function() {
                event.stopPropagation();
            });
    
    $(".UlSearch, .SearchInput").click(function() {
                event.stopPropagation();
            });
    
    
   

        });

/*Searchmobilemenu end*/


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
       function countCharanswer(val) {
        var id =  $(val).attr('id');
         $('#charNum'+id).text(len+"/540");
        var len = val.value.length;
        if (len >= 540) {
        val.value = val.value.substring(0, 540);
          $('#charNum'+id).text("540/540");
          $('#charNum'+id).css('color', 'red');
        } else {
          $('#charNum'+id).css('color', 'black');
          $('#charNum'+id).text(len+"/540");
        }
      };
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
 
  //$('#questions-mp_id').on('select2:select', function (e) {
$(document).on('select2:select', '#questions-mp_id', function (e) {

     var data = e.params.data;
    var mp_id = "mp_"+data.id;
    $("#"+mp_id).addClass("Dimmer");
});
$(document).on('select2:unselect', '#questions-mp_id', function (e) {
     var data = e.params.data;
    var mp_id = "mp_"+data.id;
    $("#"+mp_id).removeClass("Dimmer");
});
$(document).on('click', '.DimmerBox', function () {
  var id = $(this).attr('id');
  $('#'+id).toggleClass("Dimmer");
  if($('#'+id).hasClass("Dimmer") == true){
  var mp = id.replace('mp_','');
  //$('#questions-mp_id').val(mp); // Select the option with a value of '1'
  var selectedValues = new Array();
  var id = $("#questions-mp_id").val();
  if(id == ""){
    $('#questions-mp_id').val([mp]);
    $('#questions-mp_id').trigger('change');
  }else{
    var val = id.push(mp);
    $('#questions-mp_id').val(id);
    $('#questions-mp_id').trigger('change');
  }}else{
  var mp = id.replace('mp_','');
  var id = $("#questions-mp_id").val();
  if(id != ""){
    var val= id.pop(mp);
    $('#questions-mp_id').val(id);
    $('#questions-mp_id').trigger('change');
  }
  }
});

 });


$(document).ready(function(){
//$(".btn1").click(function(){
/*$(document).on('click', '.btn1', function () {
var id = $(this).attr('data-val');
$('#more'+id).toggleClass('show');
$('#more2'+id).toggleClass('show');
if($("#more"+id).hasClass('show')){
  $("#moreless"+id).text("Read Less");
}else{
  $("#moreless"+id).text("Read More");
}

 });*/

$(".btnleft").click(function(){
$('#moreleft').toggleClass('show');
if($("#moreleft").hasClass('show')){
  $(".btnleft").text("Read Less");
}else{
  $(".btnleft").text("Read More");
}

 });

});





$(document).ready(function(){
  $(".Social .Comments").click(function(){
    alert($(this).val());
      
      $(".AnswerQuestionBox").removeClass("GiveAnswerBox");
      $(".AskFollowUpBox").removeClass("GiveAnswerBox"); 
    $(".CommentBox").toggleClass("GiveAnswerBox");
  });
    
    
});















/*$(document).ready(function(){
  getNotification();*/

/* pubnub = new PubNub({
            publishKey: 'pub-c-e371713b-ce3a-41c9-89e1-ac0d397c8e9a',
            subscribeKey: 'sub-c-9a5383e4-f424-11e9-bdee-36080f78eb20',
            secretKey: 'sub-c-9a5383e4-f424-11e9-bdee-36080f78eb20',
    });
var login_user_id = $('#login_user_id').val();


 pubnub.addListener({
                message: function(message) {
                    if(message.message.userid == login_user_id){
                         var count = $('.badge-secondary').text();
                         $('.badge-secondary').text(count++);
                         $(".dynamic_notification").append('<li><a href="#">'+message.message.title+'</li>');
                    }
                        if (!("Notification" in window)) {
                            console.log("This browser does not support desktop notification");
                        }
                        else if (Notification.permission === "granted") {
                            alert(message.message.title);
                            setTimeout(notification.close.bind(notification), 4000);
                            //model_popup("info","New Crisis Added",message.message.title);
                        }
                        else if (Notification.permission !== 'denied') {
                            Notification.requestPermission(function (permission) {
                                if (permission === "granted") {
                                   // console.log(message.message.title);
                                    alert(message.message.title);
                                }

                            });
                        }
                    }
                    // }
                });
            pubnub.subscribe({
                    channels: ['ask'],
                    // withPresence: true
                });*/

           // });