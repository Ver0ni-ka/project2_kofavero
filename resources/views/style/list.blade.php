@extends('layout')

@section('content')
    <h1>{{ $title }}</h1>

    @if (count($items) > 0)
    
        <table class="table table-striped table-hover table-sm">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $style)
                    <tr>
                        <td>{{ $style->id }}</td>
                        <td>{{ $style->name }}</td>
                        <td>{{ $style->description }}</td>
                        <td>
                            <a href="/styles/update/{{ $style->id }}" class="btn btn-outline-primary btn-sm">Edit</a>

                        / <form action="/styles/delete/{{ $style->id }}" method="post" class="deletion-form d-inline">
    @csrf
    <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
</form>

</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No entries found in database</p>
    @endif
    <a href="/styles/create" class="btn btn-primary">Add new</a>
@endsection
