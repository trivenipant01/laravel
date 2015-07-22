<h1>Blog form</h1>

<ul>
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>

{!! Form::open(array('route' => 'api.posts.store', 'class' => 'form')) !!}

<div class="form-group">
    {!! Form::label('Name') !!}
    {!! Form::text('name', null, 
        array('required', 
              'class'=>'form-control', 
              'placeholder'=>'post title ')) !!}
</div>

<div class="form-group">
    {!! Form::label('slug') !!}
    {!! Form::text('slug', null, 
        array('required', 
              'class'=>'form-control', 
              'placeholder'=>'slug')) !!}
</div>

<div class="form-group">
    {!! Form::label('post description') !!}
    {!! Form::textarea('body', null, 
        array('required', 
              'class'=>'form-control', 
              'placeholder'=>'description')) !!}
</div>

<div class="form-group">
    {!! Form::submit('submit!', 
      array('class'=>'btn btn-primary')) !!}
</div>
{!! Form::close() !!}
