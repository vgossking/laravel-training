@if(count($errors) > 0)
    <div class="alert alert-danger mg-top-20">
        @foreach($errors->all() as $error)
            <ul>
                <li>{{$error}}</li>
            </ul>
        @endforeach
    </div>
@endif