$(document).ready(function() {

    $("#find").submit(function() {
        $.ajax({
            type: "POST",
            url: "app/find.php",
            data: $(this).serialize(),
            success: function (rez) {
                $('#findmes').html(rez + "<div class='clear'><br></div>");
                $('#findmes').show();
            }
        });
        return false;
    });

});