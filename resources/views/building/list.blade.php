@extends('layout')

@section('content')

<h1>{{ $title }}</h1>

@if (count($items) > 0)

    <table class="table table-sm table-hover table-striped">
        <thead class="thead-light">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Architect</th>
            <th>Year</th>
            <th>Completed</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>

        @foreach($items as $building)
        <tr>
            <td>{{ $building->id }}</td>
            <td>{{ $building->name }}</td>
            <td>{{ $building->architect->name ?? 'Unknown' }}</td>
            <td>{{ $building->year }}</td>
            <td>{!! $building->display ? '&#x2714;' : '&#x274C;' !!}</td>
            <td>
            <a
                href="/buildings/update/{{ $building->id }}"
                class="btn btn-outline-primary btn-sm"
            >Edit</a> /
            <form
                method="post"
                action="/buildings/delete/{{ $building->id }}"
                class="d-inline deletion-form"
            >
            @csrf
            <button
                type="submit"
                class="btn btn-outline-danger btn-sm"
            >Delete</button>
            </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    @else
        <p>No entries found in database</p>
    @endif
    
    <a href="/buildings/create" class="btn btn-primary">Add new building</a>
    @endsection
