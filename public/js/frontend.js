function ufcWindowLoadEvent(e) {
    var l = window.onload;
    typeof window.onload !== 'function' ? window.onload = e : window.onload = function () {
        l(), e();
    };
}

function ufcTrackFBComments(_action, _href, _commentID, _parentCommentID, _message) {
    jQuery.ajax({
        type: "POST",
        url: ufc_frontend_ajax_data.ajaxurl,
        dataType: "json",
        data: {
            action: _action,
            href: _href,
            commentID: _commentID,
            parentCommentID: _parentCommentID,
            commentText: _message,
            postTitle: ufc_frontend_ajax_data.title,
            postID: ufc_frontend_ajax_data.postid,
            security: ufc_frontend_ajax_data.security,
        },
        success: function() {
            //console.log( 'UFC: Response Success' );
        },
        error: function() {
            //console.log( 'UFC: Invalid Response' );
        }
    });
}

var ufcFacebookCommentID = '';
var ufcFacebookCommentDelID = '';

// load ajax functions
function ufcFBCommentsdkInit() {
    'undefined' != typeof FB && FB.Event.subscribe('comment.create', function(response) {
        void 0 !== response.commentID && response.commentID && ufcFacebookCommentID != response.commentID && (ufcFacebookCommentID = response.commentID,
            //console.log( 'Comment Created' ),
            ufcTrackFBComments('ufc_handle_fb_comment_created', response.href, response.commentID, response.parentCommentID, response.message)
        );
    });

    'undefined' != typeof FB && FB.Event.subscribe('comment.remove', function(response) {
        void 0 !== response.commentID && response.commentID && ufcFacebookCommentDelID != response.commentID && (ufcFacebookCommentDelID = response.commentID,
            //console.log( 'Comment Removed' ),
            ufcTrackFBComments('ufc_handle_fb_comment_removed', null, null, null, null)
        );
    });
}

ufcWindowLoadEvent(function() {
    if (void 0 !== window.fbAsyncInit && !0 === window.fbAsyncInit.hasRun) {
        ufcFBCommentsdkInit();
    } else {
        var e = window.fbAsyncInit;
        window.fbAsyncInit = function() {
            "function" == typeof e && e(), ufcFBCommentsdkInit()
        }, ufcFBCommentsdkInit()
    }
});