$("#contactForm").validator().on("submit", function (event) {
    if (event.isDefaultPrevented()) {
        // handle the invalid form...
        formError();
        submitMSG(false, "Did you fill in the form properly?");
    } else {
        // everything looks good!
        event.preventDefault();
        submitForm();
    }
});


function submitForm(){
    // Initiate Variables With Form Content
    var searchName = $("#searchName").val();
    var searchCountry = $("#searchCountry").val();
    var searchScoreFrom = $("#searchScoreFrom").val();
    var searchScoreTo = $("#searchScoreTo").val();
    var searchRankFrom = $("#searchRankFrom").val();
	var searchRankTo = $("#searchRankTo").val();


    $.ajax({
        type: "POST",
        url: "php/form-process.php",
        data: "searchName=" + searchName + "&searchCountry=" + searchCountry + "&searchScoreFrom=" + searchScoreFrom + "&searchScoreTo=" + searchScoreTo + "&searchRankFrom=" + searchRankFrom + "&searchRankTo=" + searchRankTo,
        success : function(text){
            $('#msgSubmit').html(text);
        }
    });
}

function formSuccess(){
    $("#contactForm")[0].reset();
    submitMSG(true, "Message Submitted!")
}

function formError(){
    $("#contactForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
        $(this).removeClass();
    });
}

function submitMSG(valid, msg){
    if(valid){
        var msgClasses = "h3 text-center tada animated text-success";
    } else {
        var msgClasses = "h3 text-center text-danger";
    }
    $("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
}