$(document).ready(function() {
    //document.oncontextmenu = function() {return false;};

// Gets the video src from the data-src on each button
var $videoSrc;  
$('.video-btn').click(function() {
    var src = $(this).data( "src" );
    $("#video").attr('src', '../img/online-learning-default.png');
    $.ajax({
        url: "../backend/loaddata.php",
        type: 'post',
        dataType: "json",
        data: {
            page: src,
            mode: 'video_page'
        },
        success: function(data) {
            if(data.url =="" || eval(data.url_count < 13)){
                swal("Video not found!", "Video for this topic has not been uploaded! Try again later.", "error")
            }
            else{
                $videoSrc = data.url;
                $("#myModalLabel").html(data.topic);
                $("#myModal").modal('show');
                $("#video").attr('src',$videoSrc + "?autoplay=1&rel=0&modestbranding=1&showinfo=1&enablejsapi=1&version=3&playerapiid=ytplayer" ); 
            }
        }
    });
});
console.log($videoSrc);

$('.pdf-btn').click(function() {
    var src = $(this).data( "src" );
    $("#pdf_loader").attr('src', '../img/online-learning-default.png');
    $.ajax({
        url: "../backend/loaddata.php",
        type: 'post',
        dataType: "json",
        data: {
            page: src,
            mode: 'pdf_page'
        },
        success: function(data) {
            if(data.url ==""){
                swal("Video not found!", "Video for this topic has not been uploaded! Try again later.", "error")
            }
            else{
                $pdfSrc = data.url;
                $("#myModaltopic").html(data.topic);
                $("#modelId").modal('show');
                $("#pdf_loader").attr('src',$pdfSrc); 
            }
        }
    });
});
  
// when the modal is opened autoplay it  
$('#myModal').on('shown.bs.modal', function (e) {
    // set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
    
})
  


// stop playing the youtube video when I close the modal
$('#myModal').on('hide.bs.modal', function (e) {
    // a poor man's stop video
    $("#video").attr('src',$videoSrc); 
}) 
    

$('a.play-video').click(function(){
	$('.youtube-video')[0].contentWindow.postMessage('{"event":"command","func":"' + 'playVideo' + '","args":""}', '*');
});

$('a.stop-video').click(function(){
	$('.youtube-video')[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');
});

$('a.pause-video').click(function(){
	$('.youtube-video')[0].contentWindow.postMessage('{"event":"command","func":"' + 'pauseVideo' + '","args":""}', '*');
});
    


  
  
// document ready  
});

