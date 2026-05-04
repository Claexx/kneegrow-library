@extends('template.layout-admin')

@section('title', 'Notifikasi Admin')

@section('header')
    @include('template.sidebar')
@endsection

@section('main')
<main class="pl-34 p-6 min-h-screen bg-white">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Notifikasi</h1>
        <button onclick="markAllAsRead()" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            Tandai Semua Dibaca
        </button>
    </div>

    {{-- Notifikasi List --}}
    <div class="space-y-4">
        @if(auth()->user()->notifications->count() > 0)
            @foreach(auth()->user()->notifications()->latest()->get() as $notification)
                <div class="flex items-start gap-4 bg-white border-l-4 @if(!$notification->read_at) border-blue-500 @else border-gray-300 @endif p-4 rounded-lg shadow hover:shadow-lg transition"
                    data-notification-id="{{ $notification->id }}">
                    
                    {{-- Icon --}}
                    <div class="flex-shrink-0">
                        @if($notification->data['type'] === 'success')
                            <div class="flex items-center justify-center h-10 w-10 rounded-full bg-green-100">
                                <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                        @elseif($notification->data['type'] === 'error')
                            <div class="flex items-center justify-center h-10 w-10 rounded-full bg-red-100">
                                <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                        @elseif($notification->data['type'] === 'warning')
                            <div class="flex items-center justify-center h-10 w-10 rounded-full bg-yellow-100">
                                <svg class="h-6 w-6 text-yellow-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0 0v2M5.343 5.343l1.414 1.414m12.728-1.414l1.414-1.414M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                                </svg>
                            </div>
                        @else
                            <div class="flex items-center justify-center h-10 w-10 rounded-full bg-blue-100">
                                <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    
                    {{-- Content --}}
                    <div class="flex-grow">
                        <p class="text-gray-800 text-sm font-medium @if(!$notification->read_at) font-bold @endif">
                            {{ $notification->data['message'] }}
                        </p>
                        <p class="text-gray-500 text-xs mt-1">
                            {{ $notification->created_at->diffForHumans() }}
                        </p>
                        @if($notification->data['type'] === 'warning' && isset($notification->data['denda']))
                            <div class="mt-2 p-2 bg-yellow-50 rounded border border-yellow-200">
                                <p class="text-yellow-800 text-xs font-medium">
                                    💰 Denda: Rp {{ number_format($notification->data['denda'], 0, ',', '.') }}
                                </p>
                            </div>
                        @endif
                    </div>
                    
                    {{-- Action --}}
                    <button onclick="markAsRead('{{ $notification->id }}')" 
                        class="text-gray-400 hover:text-gray-600 transition">
                        @if(!$notification->read_at)
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        @else
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        @endif
                    </button>
                </div>
            @endforeach
        @else
            <div class="flex items-center justify-center py-12">
                <div class="text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <p class="mt-4 text-gray-600">Tidak ada notifikasi baru</p>
                </div>
            </div>
        @endif
    </div>

</main>

<script>
    function markAsRead(notificationId) {
        const element = document.querySelector(`[data-notification-id="${notificationId}"]`);
        if (element) {
            element.remove();
        }
    }

    function markAllAsRead() {
        const elements = document.querySelectorAll('[data-notification-id]');
        elements.forEach(el => el.remove());
    }
</script>

@endsection
