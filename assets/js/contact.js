;(function($){
    $(document).ready(function(){
        $("#send_message").on('click', function(){
            $.post(mealurl.url, {
                action: 'contact',
                cn: $("#contact").val(),
                name: $("#cname").val(),
                email: $("#cemail").val(),
                phone: $("#cphone").val(),
                message: $("#cmessage").val(),

            },function(data){
                console.log(data);
            });

            return false;
        });
    });
})(jQuery);