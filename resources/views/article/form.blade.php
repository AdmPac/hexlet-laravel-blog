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

{{html()->label('Имя', 'name')}}
{{html()->text('name')}}
{{html()->label('Текст', 'body')}}
{{html()->textarea('body')}}