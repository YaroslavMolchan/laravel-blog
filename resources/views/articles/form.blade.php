@include('errors.list')

<div class="field-title">
    {!! Form::text('title', null,  ['placeholder' => 'Title']) !!}
    <p class="help-block"></p>
</div>

<div class="field-short_description">
    {!! Form::textarea('short_description', null, ['placeholder' => 'Short description', 'rows' => 2]) !!}
    <p class="help-block"></p>
</div>

<div class="field-description">
    {!! Form::textarea('description', null) !!}
    <p class="help-block"></p>
</div>

<div class="field-category_id">
    {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
    <p class="help-block"></p>
</div>

<div class="field-is_publish">
    <label for="is_publish">
        {!! Form::checkbox('is_publish', 1, (isset($article) && !is_null($article->published_at)), ['id' => 'is_publish']) !!}
        Опубликовать запись
    </label>
    <p class="help-block"></p>
</div>


<div class="field-tags_id">
    {!! Form::select('tags_id[]', $tags, null, ['multiple' => 'multiple']) !!}
    <p class="help-block"></p>
</div>

<div class="form-group">
    <img id="image-preview" style="height: auto; width: auto" src="">
    <input type="file" name="image" id="image-upload" class="">
    {!! Form::input('hidden', 'x1') !!}
    {!! Form::input('hidden', 'y1') !!}
    {!! Form::input('hidden', 'x2') !!}
    {!! Form::input('hidden', 'y2') !!}
</div>

<div class="form-group">
    <button type="submit" class="button yellow"><i class="icon-ok"></i> {!! $submitButtonText !!}</button>
</div>

@push('styles')
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
    <link href="/css/redactor.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="/css/imgreaselect/imgareaselect-default.css"/>
@endpush

@push('scripts')
    <script type="text/javascript" src="/js/articles.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
    <script src="/js/imperavi/redactor.js"></script>
    <script src="/js/imperavi/lang/ru.js"></script>
    <script src="/js/imperavi/plugins/imagemanager/imagemanager.js"></script>
    <script src="/js/imperavi/plugins/fullscreen/fullscreen.js"></script>
    <script src="/js/imperavi/plugins/filemanager/filemanager.js"></script>
    <script src="/js/imperavi/plugins/clips/clips.js"></script>
    <script src="/js/jquery.imgareaselect.min.js"></script>
    <script>
        $(function() {
            $('#image-upload').change(function(){
                var input = this;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('img#image-preview').attr('src', e.target.result);
                        $('img#image-preview').imgAreaSelect({
                            maxWidth: 700,
                            maxHeight: 400,
                            handles: true,
                            onSelectEnd: function (img, selection) {
                                $('input[name="x1"]').val(selection.x1);
                                $('input[name="y1"]').val(selection.y1);
                                $('input[name="x2"]').val(selection.x2);
                                $('input[name="y2"]').val(selection.y2);
                            }
                        });
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });

            $('.field-description textarea').redactor({
                allowedAttr: [
                    ['pre', ['class', 'data-code']],
                    ['table', 'class'],
                    ['td', ['colspan', 'rowspan']],
                    ['a', '*'],
                    ['strong', '*'],
                    ['em', '*'],
                    ['del', '*'],
                    ['img', ['src', 'alt', 'data-redactor-inserted-image']],
                    ['span', ['class', 'rel', 'data-verified']],
                    ['iframe', '*'],
                    ['video', '*'],
                    ['audio', '*'],
                    ['embed', '*'],
                    ['object', '*'],
                    ['param', '*'],
                    ['source', '*']
                ],
                minHeight: 400,
                imageUpload: "{!! url('/upload/imageUpload') !!}",
                imageManagerJson: "{!! url('/upload/imageManager') !!}",
                fileUpload: "{!! url('/upload/fileUpload') !!}",
                fileManagerJson: "{!! url('/upload/fileManager') !!}",
                plugins: ["imagemanager","fullscreen", "filemanager", "clips"]
            });

            $('.field-category_id select').select2({
                placeholder: 'Chose category'
            });
            $('.field-tags_id select').select2({
                placeholder: 'Chose tags',
                tags: true
            });
        });
    </script>
@endpush