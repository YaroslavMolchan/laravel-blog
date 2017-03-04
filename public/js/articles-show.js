(function(){
    var ArticleShow = {
        init: function() {
            this.commentFormSelector = $('#comments-form');
            this.commentForm = $(this.commentFormSelector);
            this.commentSubmitButton = this.commentForm.find('button[type=submit]');
            this.commentSubmitButtonValue = this.commentSubmitButton.html();

            this.bindEvents();
        },

        bindEvents: function() {
            this.commentForm.on('submit', $.proxy(this.sendCommentRequest, this));
        },

        sendCommentRequest:function(event) {
            event.preventDefault();

            this.commentSubmitButton.prop('disabled', true).html('Ожидайте...');

            $.ajax({
                url: this.commentForm.attr('action'),
                type: 'POST',
                dataType: 'json',
                data: new FormData($(this.commentFormSelector)[0]),
                context: this,
                async: false,
                cache: false,
                contentType: false,
                processData: false
            })
            .done(function() {
                this.commentForm[0].submit();
            })
            .fail(function(response) {
            	this.commentSubmitButton.prop('disabled', false).html(this.commentSubmitButtonValue);
            	this.commentForm.find('.help-block').html('');
                $.each(response.responseJSON, function(field, value) {
                	this.commentForm.find('.field-' + field + ' .help-block').html(value);
                }.bind(this));
            });
        }
    }

    ArticleShow.init();
})();