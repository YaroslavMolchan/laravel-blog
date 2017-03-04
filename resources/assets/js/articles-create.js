(function(){
    var ArticleForm = {
        init: function() {
            this.form = $('.main-form');
            this.submitButton = this.form.find('button[type=submit]');
            this.submitButtonValue = this.submitButton.val();

            this.bindEvents();
        },

        bindEvents: function() {
            this.form.on('submit', $.proxy(this.sendRequest, this));
        },

        sendRequest:function(event) {
            event.preventDefault();

            // this.submitButton.prop('disabled', true).val('Validating data...');

            $.ajax({
                url: this.form.attr('action'),
                type: 'POST',
                dataType: 'json',
                data: new FormData(this),
            })
            .done(function() {
                console.log("success");
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
        }
    }
    ArticleForm.init();
})();