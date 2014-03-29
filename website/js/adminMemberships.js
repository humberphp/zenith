/* 
 * Author: Jagsir Singh
 * Date: 29 March 2014
 */

$(document).ready(function(){
    $('#divForm').hide();
    $('#divRecords').show();
    $('#addNew').click(function(e){
        e.preventDefault();
        $('#divRecords').slideToggle("slow");
        $('#divForm').slideToggle("slow");
    });
});


