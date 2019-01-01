/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
    $('#example').DataTable();
});


//Click me
$(document).ready(function() {
    
    jQuery('#btn').click(function(e){
        e.preventDefault();
        console.log('Test');
            jQuery.ajax({
            url:'/admin/getposts',
            type: 'GET',

            success: function( data ){

                console.log(data);
                
            },
            error: function (xhr, b, c) {
                console.log("xhr=" + xhr + " b=" + b + " c=" + c);
            }

        });
    
    });

});