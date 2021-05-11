<ul role="tablist" class="nav flex-column dashboard-list">
    <li><a href="{{ route('dashboard') }}"  class="nav-link active">Dashboard</a></li>
    <li> <a href="{{ route('purchase_history.index') }}"  class="nav-link">Orders / Purchase History</a></li>
    <li><a href="{{ route('wishlists.index') }}"  class="nav-link">Wishlist</a></li>
    
    <li><a href="{{ route('wallet.index') }} " class="nav-link">My Wallet</a></li>
    <li><a href="{{ route('profile') }}"  class="nav-link">Manage Profile</a></li>
    <li><a href="{{ route('support_ticket.index') }}"  class="nav-link">Support Ticket</a></li>
    <li><a href="{{ route('dashboard') }}" class="nav-link">logout</a></li>
</ul>