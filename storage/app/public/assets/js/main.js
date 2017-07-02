jQuery(document).ready(function($) {

    $('#btn-download').click(function(){
        if (!$(this).hasClass('showing')){
            $('#btn-download').addClass('showing');
            $('#download-container').removeClass('hidden');

        }else{
            $('#btn-download').removeClass('showing');
            $('#download-container').addClass('hidden');
        }
    });

    $('.player__quality').on('click', '.quality__list', function(){
      if(!$(this).hasClass('quality__list--active')){
        var btn = $(this),
        streamID = btn.data('stream');

        var iframeURL = document.getElementById('play-frame').src;
        var frameID = iframeURL.substring(iframeURL.lastIndexOf('/')+1, iframeURL.lastIndexOf('&thumb'));

        var changedFrame = iframeURL.replace(frameID, streamID);

        document.getElementById('play-frame').src = changedFrame;

        $('.quality__list').removeClass('quality__list--active');
        btn.addClass('quality__list--active');
      }
    });
});
