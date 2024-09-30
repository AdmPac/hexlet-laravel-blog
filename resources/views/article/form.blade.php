@if ($errors->any())
    <div>
        errors:
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<p>{{html()->label('Имя', 'name')}}</p>
<p>{{html()->text('name')}}</p>
<p>{{html()->label('Текст', 'body')}}</p>
<p>{{html()->textarea('body')}}</p>