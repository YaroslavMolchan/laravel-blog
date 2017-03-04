(function(){
    var ArticleForm = {
        init: function() {
            this.form = $('.main-form');
            this.submitButton = this.form.find('button[type=submit]');
            this.submitButtonValue = this.submitButton.html();

            this.bindEvents();
        },

        bindEvents: function() {
            this.form.on('submit', $.proxy(this.sendRequest, this));
        },

        sendRequest:function(event) {
            event.preventDefault();

            this.submitButton.prop('disabled', true).html('Validating data...');

            $.ajax({
                url: this.form.attr('action'),
                type: 'POST',
                // dataType: 'json',
                data: new FormData($('.main-form')[0]),
                context: this,
                async: false,
                cache: false,
                contentType: false,
                processData: false
            })
            .done(function() {
                this.form[0].submit();
            })
            .fail(function(response) {
                response = JSON.parse(response);
            	this.submitButton.prop('disabled', false).html(this.submitButtonValue);
            	this.form.find('.help-block').html('');
                $.each(response.responseJSON, function(field, value) {
                	this.form.find('.field-' + field + ' .help-block').html(value);
                }.bind(this));
            });
        }
    }

    ArticleForm.init();
})();