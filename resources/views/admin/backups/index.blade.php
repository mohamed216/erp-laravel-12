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
                                <i class="fas fa-download"></i>
                            </a>
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#restoreModal{{ $loop->index }}">
                                <i class="fas fa-upload"></i>
                            </button>
                            <form method="POST" action="/backup/delete/{{ $file }}" class="d-inline">
                                @csrf
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this backup?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    
                    <!-- Restore Modal -->
                    <div class="modal fade" id="restoreModal{{ $loop->index }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Restore Backup</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form method="POST" action="/backup/restore/{{ $file }}">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="alert alert-warning">
                                            <i class="fas fa-exclamation-triangle"></i> 
                                            Warning: This will overwrite all current data!
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="confirm" value="yes" id="confirm{{ $loop->index }}">
                                            <label class="form-check-label" for="confirm{{ $loop->index }}">
                                                I understand this will replace all data
                                            </label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-warning">Restore</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
