<meta name="csrf-token" content="{{ csrf_token() }}">
<a href="{{ url('upload') }}">Upload CSV</a>

<a href="{{ url('/') }}">Parse</a>

<a href="{{ url('/top') }}">topFilms</a>
<div style="margin-top: 20px; border: 2px solid black; width: 250px;">
    <form action="{{ url('/movie/create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            MovieCSV
            <div class="col-md-6">
                <input type="file" name="file" class="form-control">
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-success">Upload</button>
            </div>
        </div>
    </form>
    <form action="{{ url('/cast/create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            NameCSV
            <div class="col-md-6">
                <input type="file" name="file" class="form-control">
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-success">Upload</button>
            </div>
        </div>
    </form>
</div>
