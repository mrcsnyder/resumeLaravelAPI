
//handy jQuery helper methods to get file names established client side
function baseId(fileName) {

    //prepend uuid and a dash to the beginning of fileName
    return Math.random().toString(16).slice(2) +'-'+fileName
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#img_logo')
                .attr('src', e.target.result)
        };

        reader.readAsDataURL(input.files[0]);
    }
}
$(function() {

    $("#image_file").change(function (){

        //need to make it so it strips first 12 characters before saving as filename in javascript...
        var fileName = $(this).val();

        $(".img_name").val(baseId(fileName.substring(12)));
        $("#image_preview").show();


    });


    $("#pdf_file").change(function (){

        //need to make it so it strips first 12 characters before saving as filename in javascript...
        var fileName = $(this).val();

        $(".file_name").val(fileName.substring(12));

    });


});



$(document).ready(function(){
    $(".img_name").hide();

    $("#image_preview").hide();
    $(".file_name").hide();

});
