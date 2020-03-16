function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#img_logo')
                .attr('src', e.target.result)
            // .width(150)
            // .height(200);
        };

        reader.readAsDataURL(input.files[0]);
    }
}
$(function() {
    $("input:file").change(function (){
        //need to make it so it strips first 12 characters before saving as filename in javascript...
        var fileName = $(this).val();
        $(".filename").val(fileName.substring(12));
        // $(".filename").show();
        $(".img_string").show();
        $("#image_preview").show();


    });
});


$(document).ready(function(){
    $(".filename").hide();
    $(".img_string").hide();
    $("#image_preview").hide();



});
