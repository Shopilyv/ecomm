$(document).ready(function() {


    var userFeed = new Instafeed({
        get: 'user',
        userId: '2996874853',
        limit: 18,
        resolution: 'standard_resolution',
        accessToken: '2996874853.1677ed0.64755cac7d014cf19607750160b3bee3',
        sortBy: 'most-recent',
        template: '<div class="col-md-2 instaimg"><a href="{{image}}" title="{{caption}}" target="_blank"><img src="{{image}}" alt="{{caption}}" class="img-fluid"/></a></div>'
    });


    userFeed.run();

    
    // This will create a single gallery from all elements that have class "gallery-item"
    $('#instafeed').magnificPopup({
        type: 'image',
        delegate: 'a',
        gallery: {
            enabled: true
        }
    });


});