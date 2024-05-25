@section('links')
    <script src="{{ asset('js/dashboard.js') }}" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
@endsection

<style>
/* Your existing CSS */
.notification {
    position: relative;
    display: inline-block;
}

.notification .badge {
    position: absolute;
    top: -5px;
    right: -5px;
    background: red;
    color: white;
    border-radius: 50%;
    padding: 2px 6px;
    font-size: 10px;
}

.notifications-dropdown {
    display: none;
    position: absolute;
    top: 0; /* Align with the top edge of the container */
    right: 0; /* Align with the right edge of the container */
    background-color: white;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    width: 300px;
    font-size: 12px;
}


.notification:hover .notifications-dropdown {
    display: block;
}

.notifications-dropdown ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.notifications-dropdown li {
    padding: 8px;
    border-bottom: 1px solid #ddd;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.notifications-dropdown li:last-child {
    border-bottom: none;
}

.mark-as-read, .mark-all-link {
    color: #007bff;
    text-decoration: none;
}

.mark-as-read:hover, .mark-all-link:hover {
    text-decoration: underline;
}

.mark-all-link {
    display: block;
    text-align: center;
    padding: 8px;
    font-size: 12px;
    cursor: pointer;
}
</style>

<div class="notification">
    <i class="fa fa-bell" style="font-size: 35px;"></i>
    @if(auth()->user()->unreadNotifications->count())
        <span class="badge">{{ auth()->user()->unreadNotifications->count() }}</span>
    @endif
    <div class="notifications-dropdown">
        <ul>
            @if(session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @if (auth()->user()->role === 'admin')
                @forelse(auth()->user()->unreadNotifications as $notification)
                    <div class="alert alert-success" role="alert">
                        [{{ $notification->created_at }}] Customer {{ $notification->data['name'] }} ({{ $notification->data['email'] }}) has just registered.
                        <form action="{{ route('markNotification') }}" method="POST" style="display:inline;">
                            @csrf
                            <input type="hidden" name="id" value="{{ $notification->id }}">
                            <button type="submit" class="btn btn-link p-0 mark-as-read">
                                Mark as read
                            </button>
                        </form>
                    </div>

                    @if($loop->last)
                        <form action="{{ route('markNotification') }}" method="POST" id="mark-all-form">
                            @csrf
                            <button type="submit" class="btn btn-link mark-all-link">
                                Mark all as read
                            </button>
                        </form>
                    @endif
                @empty
                    There are no new notifications
                @endforelse
            @else
                You are logged in!
            @endif
        </ul>
    </div>
</div>
