$(document).ready(function(){
$('#otherfield').collapse('hide');    
$('input[name="gender"]').change( function() {
        
        if ($('#other').is(":checked")){

            $('#otherfield').collapse('show');
        
        } else {
            
            $('#otherfield').collapse('hide');
        }
        
  });
});