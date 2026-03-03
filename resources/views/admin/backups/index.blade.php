@extends('layout.app')
@section('title', 'Backup')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Database Backups</h4>
        <form method="POST" action="/backup/create">
            @csrf
            <button class="btn btn-primary">Create Backup</button>
        </form>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        @if(count($backups) == 0)
            <div class="alert alert-info">No backups found</div>
        @else
            <table class="table">
                <tr><th>Filename</th><th>Size</th><th>Actions</th></tr>
                @foreach($backups as $backup)
                <?php $file = basename($backup); ?>
                <tr>
                    <td>{{ $file }}</td>
                    <td>{{ round(filesize($backup) / 1024, 2) }} KB</td>
                    <td>
                        <a href="/backup/download/{{ $file }}" class="btn btn-sm btn-success">Download</a>
                        <form method="POST" action="/backup/delete/{{ $file }}" class="d-inline">
                            @csrf
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        @endif
    </div>
</div>
@endsection
