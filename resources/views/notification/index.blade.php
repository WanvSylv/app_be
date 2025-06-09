@extends('layouts.template')

@section('title', 'Notifications')
@section('page-title', 'Notifications')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Toutes les notifications</div>
        <div class="card-body">
            <ul class="list-group">
                @forelse($notifications as $notification)
                    <li class="list-group-item">
                        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small><br>
                        {{ $notification->message }}
                    </li>
                @empty
                    <li class="list-group-item text-center">Aucune notification</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection
