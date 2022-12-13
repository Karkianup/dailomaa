$(document).ready(function () {
    $("#document_type").change(function () {
        $(this).find("option:selected").each(function () {
            var optionValue = $(this).attr("value");
            if (optionValue) {
                $(".file-upload").not("." + optionValue).hide();
                $("." + optionValue).show();
            } else {
                $(".file-upload").hide();
            }
        });
    }).change()
});

var input = document.getElementById('document_image');
var input1 = document.getElementById('citizenship_image_back');
var infoArea = document.getElementById('document_image_info');
var infoArea1 = document.getElementById('citizenship_image_back_info');

input.addEventListener('change', showFileName);
input1.addEventListener('change', showFileName1);

function showFileName(event) {

    // the change event gives us the input it occurred in 
    var input = event.srcElement;

    // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
    var fileName = input.files[0].name;

    // use fileName however fits your app best, i.e. add it into a div
    infoArea.textContent = 'Uploaded file: ' + fileName;
}
function showFileName1(event) {

    // the change event gives us the input it occurred in 
    var input1 = event.srcElement;

    // the input1 has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
    var fileName = input1.files[0].name;

    // use fileName however fits your app best, i.e. add it into a div
    infoArea1.textContent = 'Uploaded file: ' + fileName;
}