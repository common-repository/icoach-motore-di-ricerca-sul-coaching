// J. Whitmore Ver. 1.0.2
// iCoach - Prometeo Coaching
// Developer: Luca Carchesio & Serghei Cucereavii

var $ = jQuery.noConflict();

$(".someSpinnerImage").show();
    $.getJSON('https://www.scuoladicoaching.net/Search/data.json', function(json) {
       $.each(json, function() {
          // Retrieving data from json...

       });
       $(".someSpinnerImage").hide();  
    });
$('.search').keyup(function() {
  var srchInput = $('.search').val();
  srchInput = srchInput.replace(/ /g, '|');
  if (srchInput[srchInput.length - 1] == '|') {
    srchInput = srchInput.replace(/\|/, '');
  }
  var regex = new RegExp('(?=[^\\s])' + srchInput, 'gi');
  var sorted = '';
  var results = [],
  sortedResultNames = [];
  $.getJSON('https://www.scuoladicoaching.net/Search/data.json', function(data) {
    $.each(data, function(key, val) { // index, obj
      if (val.name.search(regex) != -1) {
        results.push(val);
        sortedResultNames.push(val.name);
      } else {
        $.each(val.keywords, function(i, keyword) {
          if (keyword.search(regex) != -1) {
            results.push(val);
            sortedResultNames.push(val.name);
            return false;
          }
        });
      }
    });
    sortedResultNames = sortedResultNames.sort();
    $.each(sortedResultNames, function(i, nameVal) {
      $.each(results, function(key, val) {
        if (val.name == nameVal) {
		  sorted += '<li>' + val.image + '';
		  sorted += '<a href="' + val.web + '" class="tooltip2" target="_blank" rel="noopener"><img src="../wp-content/plugins/icoach-motore-di-ricerca-sul-coaching/assets/images/web.svg" class="mic" style="width:24px;float:left;margin-right:10px;margin-top:1px;"><span class="tooltiptext2">Link di Approfondimento</span></a>';
		  sorted += '<a href="#popup2" class="tooltip2"> <img src="../wp-content/plugins/icoach-motore-di-ricerca-sul-coaching/assets/images/video.svg" class="mic" style="width:24px;float:left;margin-right:10px;margin-top:1px;"><span class="tooltiptext2">Guarda il Video</span></a>';	
		  sorted += '<a href="' + val.acquista + '" class="tooltip2" target="_blank" rel="noopener" id="ifisempty" style="float:left;"><img src="../wp-content/plugins/icoach-motore-di-ricerca-sul-coaching/assets/images/amazon.svg" class="mic" style="width:24px;float:left;margin-right:10px;margin-top:1px;"><span class="tooltiptext2">Acquistalo su Amazon</span></a>';
		  sorted += '<a href="' + val.down + '" class="tooltip2" target="_blank" rel="noopener" id="ifisempty"><img src="../wp-content/plugins/icoach-motore-di-ricerca-sul-coaching/assets/images/down.svg" class="mic" style="width:24px;float:left;margin-right:10px;margin-top:1px;"><span class="tooltiptext2">Scarica 15 pagine</span></a>';		  
          sorted += '<h2 style="color: #c0cc19;padding-top: 3px;outline:none;"><a href="' + val.web + '" target="_blank" rel="noopener">' + val.name + '</a></h2>';			
          sorted += '<p style="color:#676767;">' + val.description + '</p>';
		  sorted += '<p class="social-share"><b>Condividi su:</b> <br><a href="https://www.facebook.com/sharer/sharer.php?u=https://chrome.google.com/webstore/detail/icoach-il-motore-di-ricer/ambabnanecfabkagdlajogfckdkojicm?hl=it" target="_blank" rel="noopener"><i class="fa fa-facebook-official" style="color:#fff;font-size:20px;;"></i></a> <a href="http://twitter.com/share?related=PrometeoCoach&via=@PrometeoCoach&lang=[it]&text=Scarica%20iCoach%20Il%20Motore%20di%20Ricerca%20sul%20Coaching%20su&url=https://goo.gl/wWr3dA" target="_blank" rel="noopener"><i class="fa fa-twitter" style="color:#fff;font-size:20px;;"></i></a> <a href="https://plus.google.com/share?url=https://chrome.google.com/webstore/detail/icoach-il-motore-di-ricer/ambabnanecfabkagdlajogfckdkojicm?hl=it" target="_blank" rel="noopener"><i class="fa fa-google" style="color:#fff;font-size:20px;;"></i></a> <a href="http://www.pinterest.com/pin/create/button/?url=https://chrome.google.com/webstore/detail/icoach-il-motore-di-ricer/ambabnanecfabkagdlajogfckdkojicm?hl=it&media=../wp-content/plugins/icoach-motore-di-ricerca-sul-coaching/assets/images/sostituire.png" target="_blank" rel="noopener"><i class="fa fa-pinterest" style="color:#fff;font-size:20px;;"></i></a> <span class="sep">|</span><a href="https://www.facebook.com/dialog/send?link=https://chrome.google.com/webstore/detail/icoach-il-motore-di-ricer/ambabnanecfabkagdlajogfckdkojicm?hl=it/&next=https://chrome.google.com/webstore/detail/icoach-il-motore-di-ricer/ambabnanecfabkagdlajogfckdkojicm?hl=it/&app_id=399938263434202" target="_blank" rel="noopener"><i class="fa fa-comments" style="color:#fff;font-size:20px;;"></i></a> <a href="https://api.whatsapp.com/send?text=https://chrome.google.com/webstore/detail/icoach-il-motore-di-ricer/ambabnanecfabkagdlajogfckdkojicm?hl=it" target="_blank" rel="noopener"><i class="fa fa-whatsapp" style="color:#fff;font-size:20px;;"></i></a><div id="popup2" class="overlay"><div class="popup"><a class="close" href="#">×</a><div class="content"><iframe src="' + val.video + '" width="100%" height="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen id="ifisempty"></iframe></div></div></div></p></li><li class="adv"><img src=\'../wp-content/plugins/icoach-motore-di-ricerca-sul-coaching/assets/images/logo_footer.svg\' style=\'width:26px;float:left;margin-right:10px;\'><a href="#popup1" class="tooltip2"><img src="../wp-content/plugins/icoach-motore-di-ricerca-sul-coaching/assets/images/video.svg" class="mic" style="width:25px;float:left;margin-right:10px;"><span class="tooltiptext2">Guarda il Video</span></a><h2><a href="https://www.prometeocoaching.it/scuola-di-coaching/" target="_blank" rel="noopener">Scuola e Corsi di Coaching</a></h2><p>Desideri avviare la tua attività nel settore del Life, del Business e dello Sport Coaching? Vuoi migliorare come persona e imparare a generare risultati straordinari per te stesso e per gli altri?</p><p class="social-share" style="font-size:12px;"><a href="https://api.whatsapp.com/send?phone=393929741137&text=iCoach%20Wp%20Plugin%20Ciao,%20vorrei%20maggiori%20informazioni%20in%20merito%20alla%20Scuola%20di%20Coaching." style="" id="tutor-style" target="_blank" rel="noopener"><span class="pulse"></span><img src="../wp-content/plugins/icoach-motore-di-ricerca-sul-coaching/assets/images/tutor.gif" class="tutor-result"> <span class="tutor-span">Entra in Contatto con <br>il <b>Tutor Federica Palumbo</b></span></a></p><div id="popup1" class="overlay"><div class="popup"><a class="close" href="#">×</a><div class="content"><iframe src="https://player.vimeo.com/video/162340976?color=c0cc19&title=0&byline=0&portrait=0" width="100%" height="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div></div></div></li>';
        }
      });
    });
    $('.results').html(sorted);
	
$("a#ifisempty").each(function (i) {
    var aHref = $(this).attr('href');
    if (aHref == 'undefined' || !aHref) { 
        $(this).hide();
    };
});
	
  });
});

$('#link').click(function(){
    $("html, body").animate({ scrollTop: 0 }, 600);
    return false;
 });
 
  jQuery(document).ready(function ($) {
    $(window).load(function () {
        setTimeout(function(){
            $('#preloader').fadeOut('slow', function () {
            });
        },2400);

    });  
});

    // Finds all iframes from youtubes and gives them a unique class
    jQuery('iframe[src*="https://www.youtube.com/embed/"]').addClass("youtube-iframe");

    jQuery(".fancybox-close").click(function() {
      // changes the iframe src to prevent playback or stop the video playback in our case
      $('.youtube-iframe').each(function(index) {
        $(this).attr('src', $(this).attr('src'));
        return false;
      });
      
//click function
    });


