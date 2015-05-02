$(window).resize(function(){

    $('#modal').css({
        position:'absolute',
        left: ($(window).width() - $('#modal').outerWidth())/2,
        top: ($(window).height() - $('#modal').outerHeight())/2
    });

});

// To initially run the function:
$(window).resize();