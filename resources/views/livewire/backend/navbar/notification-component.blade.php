<div>
    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
        <!-- Counter - Alerts -->
        <span class="badge badge-danger badge-counter">{{ $unReadNotificationsCount }}</span>
    </a>
    <!-- Dropdown - Alerts -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
         aria-labelledby="alertsDropdown">
        <h6 class="dropdown-header">
            Alerts Center
        </h6>
        @forelse($unReadNotifications as $notification)
            <a class="dropdown-item d-flex align-items-center" wire:click="markAsRead('{{ $notification->id }}')">
                <div class="mr-3">
                    <div class="icon-circle bg-primary">
                        <i class="fas fa-file-alt text-white"></i>
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500">{{ $notification->data['created_date'] }}</div>
                    <span class="font-weight-bold">A new order with amount ({{ $notification->data['amount'] }}) from {{ $notification->data['customer_name'] }}</span>
                </div>
            </a>
        @empty
            <div class="dropdown-item text-center">No notifications found!</div>
        @endforelse
    </div>
</div>
