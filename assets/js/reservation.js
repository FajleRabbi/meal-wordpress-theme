;(function($){
    $(document).ready(function(){
        $("#reservenow").on('click', function(){
           $.post(mealurl.url, {
               action: "reservation",
               rn: $("#rn").val(),
               name: $("#name").val(),
               email: $("#email").val(),
               phone: $("#phone").val(),
               persons: $("#persons").val(),
               date: $("#date").val(),
               time: $("#time").val(),
           }, function (data){
               if('Duplicate' == data){
                   alert('Your have already request for this reservation. no need to submit again');
               }else {
                    $("#paynow").attr('href', data);
                    $("#reservenow").hide();
                    $("#paynow").show();
               }
           });
           return false;
        });
    });
})(jQuery);