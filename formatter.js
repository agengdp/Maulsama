$(document).ready(function (){
  $('.repeater').repeater({
    initEmpty: true,

    show: function(){
      $(this).slideDown();
    },

    hide: function(deleteElement){
      if(confirm('Yakin ingin menghapus ini?'){
        $(this).slideUp(deleteElement);
      })
    },

    ready: function (setIndexes){
      $dragAndDrop.on('drop', setIndexes);
    },

    isFirstItemUndeletable:true



  })
});
