$(document).ready(function () {
    $(".img-list a").on("click", function (e) {
        e.preventDefault();

        var imgLink = $(this)
            .children("img")
            .attr("src");

        $(".mask").html(
            '<div class="img-box"><img src="' +
            imgLink +
            '"><a class="close">&times;</a>'
        );

        $(".mask")
            .addClass("is-visible fadein")
            .on("animationend", function () {
                $(this)
                    .removeClass("fadein is-visible")
                    .addClass("is-visible");
            });

        $(".close").on("click", function () {
            $(this)
                .parents(".mask")
                .addClass("fadeout")
                .on("animationend", function () {
                    $(this).removeClass("fadeout is-visible");
                });
        });
    });
});
var modal = document.getElementById("img-list a");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function () {
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function () {
    modal.style.display = "none";
}

// Showing delete button on hover
$("#delete").click(function () {
    $("#image-button").css("display", "none");
});