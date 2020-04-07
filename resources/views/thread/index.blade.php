@foreach($threads as $thread)
<li 
    className="list-group-item list-group-item-action d-flex 
    justify-content-between align-items-center rounded mb-4"
    href=""
    >
        <div className="container">
            <div className="row">
                <h4>{{$thread->title}}</h4>
            </div>
            <div className="row">
                <p className="lead">{{$thread->subtitle}}</p>
            </div>
        </div>
</li>
@endforeach