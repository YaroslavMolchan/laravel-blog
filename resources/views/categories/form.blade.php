@include('errors.list')

<div class="field-title">
    {!! Form::text('name', null,  ['placeholder' => 'Name']) !!}
    <p class="help-block"></p>
</div>

<div class="form-group">
    <button type="submit" class="button yellow"><i class="icon-ok"></i> Сохранить</button>
</div>