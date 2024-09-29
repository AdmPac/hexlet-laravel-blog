{{html()->modelForm($article, 'POST', route('articles.store'))->open()}}
    @include('article.form')
    {{html()->submit('Сохранить')}}
{{html()->closeModelForm()}}