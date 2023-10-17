$('.favorite-button').click(function(e) {
    e.preventDefault();
    var videoId = $(this).data('video-id');
    $.post(`/videos/${videoId}/favorite`, function(response) {
        alert(response.message);
    });
});
