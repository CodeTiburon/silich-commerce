$(document).ready(function() {
   $('.fancybox').fancybox();
   $('#mainPhoto').elevateZoom({tint:true, tintColour:'#F90', tintOpacity:0.5});

   $('.sortable').sortable();
   $( ".sortable" ).disableSelection();
});
