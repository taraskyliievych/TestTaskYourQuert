<!DOCTYPE html>
<html lang="">
<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            margin-left: 5px;
            margin-right: 5px;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        a {
            margin-right: 20px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
    <title></title>
</head>
<body>
<a href="{{ url('upload') }}">Upload CSV</a>

<a href="{{ url('/') }}">Parse</a>

<a href="{{ url('/top') }}">topFilms</a>

<h2>Parses</h2>

<table>
    <tr>
        <th>Years</th>
        <th>Ratings</th>
        <th>Movie name</th>
        <th>Year of movie</th>
        <th>Count of actors</th>
        <th>Genre</th>
    </tr>

    @foreach($topMovies as $periodKey => $periodValues)
        @if (!empty($periodValues))
            @foreach($periodValues as $values)
                <tr>
                    <td>{{ ($periodKey) }}</td>
                    <td>{{ ($values['avg_vote']) }}</td>
                    <td>{{ ($values['title']) }}</td>
                    <td>{{ ($values['year']) }}</td>
                    <td>{{ count(explode(', ', ($values['actors']))) }}</td>
                    <td>{{ ($values['genre']) }}</td>
                </tr>
            @endforeach
        @endif
        <tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>
    @endforeach

</table>
</body>
</html>
