var $ = jQuery.noConflict();

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