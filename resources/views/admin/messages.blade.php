@extends('layouts.admin')
@section('content')
    <!-- Section for received messages -->
    <div class="row mt-4">
        <div class="col-11 mb-4 mb-lg-0">
            <div class="card">
                <h5 class="card-header">Messaggi Ricevuti</h5>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>MESSAGGI RICEVUTI: {{ $messageCount }}</strong>
                        <button id="deleteAllBtn" class="btn btn-danger float-end">Cancella Tutti</button>
                    </div>
                    @if ($messages->isEmpty())
                        <p class="text-center">Non hai ancora ricevuto nessun messaggio.</p>
                    @else
                        @foreach ($messages as $message)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $message->name_lastname }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $message->email_sender }}</h6>
                                    <p class="card-text">{{ $message->body }}</p>
                                    <button class="btn btn-danger deleteBtn" data-id="{{ $message->id }}">Cancella</button>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle delete individual message
    document.querySelectorAll('.deleteBtn').forEach(button => {
        button.addEventListener('click', function() {
            const messageId = this.getAttribute('data-id');
            fetch(`/admin/messages/${messageId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(response => response.json())
              .then(data => {
                  if (data.success) {
                      this.closest('.card').remove();
                  }
              });
        });
    });

    // Handle delete all messages
    document.getElementById('deleteAllBtn').addEventListener('click', function() {
        fetch('/admin/messages', {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }).then(response => response.json())
          .then(data => {
              if (data.success) {
                  document.querySelectorAll('.card').forEach(card => card.remove());
              }
          });
    });
});
</script>
