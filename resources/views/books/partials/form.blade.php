@include('errors.list')

<div class="field-title">
    {!! Form::text('title', null,  ['placeholder' => 'Title']) !!}
    <p class="help-block"></p>
</div>

<div class="field-authors_id">
    {!! Form::select('authors_id[]', $authors, null, ['multiple' => 'multiple']) !!}
    <p class="help-block"></p>
</div>

<div class="field-link">
    {!! Form::text('link', null,  ['placeholder' => 'Store link']) !!}
    <p class="help-block"></p>
</div>

<div class="field-description">
    {!! Form::textarea('description', null,  ['placeholder' => 'Description']) !!}
    <p class="help-block"></p>
</div>

<div class="form-group">
    <img id="image-preview" style="height: auto; width: auto" src="">
    <input type="file" name="image" id="image-upload" class="">
</div>

<div class="form-group">
    <button type="submit" class="button yellow"><i class="icon-ok"></i> {!! $submitButtonText !!}</button>
</div>

@push('styles')
     <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
    <script src="/js/books.js"></script>
    <script>
        $(function() {
            $('#image-upload').change(function(){
                var input = this;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('img#image-preview').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            });

            $('.field-authors_id select').select2({
                placeholder: 'Chose authors',
                tags: true
            });
        });
    </script>
@endpush