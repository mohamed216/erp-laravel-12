@extends('layout.app')
@section('title', 'Backup')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4><i class="fas fa-database"></i> Database Backups</h4>
        <form method="POST" action="/backup/create">
            @csrf
            <button class="btn btn-primary"><i class="fas fa-plus"></i> Create Backup</button>
        </form>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        
        @if(count($backups) == 0)
            <div class="alert alert-info">No backups found</div>
        @else
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><i class="fas fa-file"></i> Filename</th>
                        <th><i class="fas fa-weight"></i> Size</th>
                        <th><i class="fas fa-cogs"></i> Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($backups as $backup)
                    <?php $file = basename($backup); ?>
                    <tr>
                        <td>{{ $file }}</td>
                        <td>{{ round(filesize($backup) / 1024, 2) }} KB</td>
                        <td>
                            <a href="/backup/download/{{ $file }}" class="btn btn-sm btn-success">
                                <i class="fas fa-download"></i> Download
                            </a>
                            <form method="POST" action="/backup/restore/{{ $file }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('Warning: This will replace ALL data! Continue?')">
                                    <i class="fas fa-upload"></i> Restore
                                </button>
                            </form>
                            <form method="POST" action="/backup/delete/{{ $file }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this backup?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
