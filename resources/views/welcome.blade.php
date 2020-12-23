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
        <th>Data and Time</th>
        <th>items_in_file</th>
        <th>changes_in_casts</th>
        <th>changes_in_countries</th>
        <th>changes_in_genres</th>
        <th>changes_in_languages</th>
        <th>changes_in_movies</th>
        <th>changes_in_new_movies</th>
        <th>changes_in_old_movies</th>
        <th>parse_time</th>
    </tr>

    @foreach($parse as $item)
        <tr>
            <td>{{ ($item['created_at']) }}</td>
            <td>{{ ($item['items_in_file']) }}</td>
            <td>{{ ($item['changes_in_casts']) }}</td>
            <td>{{ ($item['changes_in_countries']) }}</td>
            <td>{{ ($item['changes_in_genres']) }}</td>
            <td>{{ ($item['changes_in_languages']) }}</td>
            <td>{{ ($item['changes_in_movies']) }}</td>
            <td>{{ ($item['changes_in_new_movies']) }}</td>
            <td>{{ ($item['changes_in_old_movies']) }}</td>
            <td>{{ ($item['parse_time']) }}</td>
        </tr>
    @endforeach

</table>
</body>
</html>
