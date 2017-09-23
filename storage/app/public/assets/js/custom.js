(function() {

  var laravel = {
    initialize: function() {
      this.methodLinks = $('a[data-method]');

      this.registerEvents();
    },

    registerEvents: function() {
      this.methodLinks.on('click', this.handleMethod);
    },

    handleMethod: function(e) {
      var link = $(this);
      var httpMethod = link.data('method').toUpperCase();
      var form;

      // If the data-method attribute is not PUT or DELETE,
      // then we don't know what to do. Just ignore.
      if ( $.inArray(httpMethod, ['PUT', 'DELETE']) === - 1 ) {
        return;
      }

      // Allow user to optionally provide data-confirm="Are you sure?"
      if ( link.data('confirm') ) {
        if ( ! laravel.verifyConfirm(link) ) {
          return false;
        }
      }

      form = laravel.createForm(link);
      form.submit();

      e.preventDefault();
    },

    verifyConfirm: function(link) {
      return confirm(link.data('confirm'));
    },

    createForm: function(link) {
      var form =
      $('<form>', {
        'method': 'POST',
        'action': link.attr('href')
      });

      var token =
      $('<input>', {
        'type': 'hidden',
        'name': '_token',
          'value': link.data('token') // hmmmm...
        });

      var hiddenInput =
      $('<input>', {
        'name': '_method',
        'type': 'hidden',
        'value': link.data('method')
      });

      return form.append(token, hiddenInput)
                 .appendTo('body');
    }
  };

  laravel.initialize();

})();

$(document).ready(function () {

    $('.repeater').repeater({
        // (Required if there is a nested repeater)
        // Specify the configuration of the nested repeaters.
        // Nested configuration follows the same format as the base configuration,
        // supporting options "defaultValues", "show", "hide", etc.
        // Nested repeaters additionally require a "selector" field.

        initEmpty: false,

        defaultValues:{
          video_type: 'mp4',
          video_quality: '1080p',
        }

    });


    $('#edit-episode').on('show.bs.modal', function (event){
      var button      = $(event.relatedTarget);
      var episode     = button.data('episode');
      var actionLink  = button.data('action-link');

      var s_eps = JSON.stringify(episode);
      var telek = jQuery.parseJSON(s_eps);

      var obj = JSON.parse(telek.links);
      var $repeater = $('.repeater-edit').repeater();
      $repeater.setList(obj);

      var modal = $(this);
      modal.find('.modal-body input#episode').val(telek.episode);
      modal.find('.modal-body input#judul').val(telek.judul_episode);
      modal.find('.modal-body textarea#spoiler').val(telek.spoiler);
      modal.find('.modal-footer input#episode_id').val(telek.id);
      // modal.getElementById('uploadedimage').src = telek.cover;
      document.getElementById('uploadedimage').src = '/storage/' + telek.cover;

      $("#form-edit-episode").attr('action', actionLink);

    });


    $('#delete-episode').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal
      var episode = button.data('episode'); // Extract info from data-* attributes
      var judul = button.data('judul');
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this);
      modal.find('.modal-body input#episode').val(episode);
      modal.find('.modal-body input#judul').val(judul);
    });

 
    // Upload image with preview
    document.getElementById('jimage').onchange = function () {
          var reader = new FileReader();

          reader.onload = function (e) {
              if (e.total > 25000000) {
                  $('#imageerror').text('Image too large');
                  $jimage = $("#jimage");
                  $jimage.val("");
                  $jimage.wrap('<form>').closest('form').get(0).reset();
                  $jimage.unwrap();
                  $('#uploadedimage').removeAttr('src');
                  return;
              }
              $('#imageerror').text('');
              document.getElementById("uploadedimage").src = e.target.result;
          };
          reader.readAsDataURL(this.files[0]);
    };

    document.getElementById('coverEpisode').onchange = function () {
          var reader = new FileReader();

          reader.onload = function (e) {
              if (e.total > 25000000) {
                  $('#imageerror').text('Image too large');
                  $coverEpisode = $("#coverEpisode");
                  $coverEpisode.val("");
                  $coverEpisode.wrap('<form>').closest('form').get(0).reset();
                  $coverEpisode.unwrap();
                  $('#uploadedimage1').removeAttr('src');
                  return;
              }
              $('#imageerror').text('');
              document.getElementById("uploadedimage1").src = e.target.result;
          };
          reader.readAsDataURL(this.files[0]);
    };
});
