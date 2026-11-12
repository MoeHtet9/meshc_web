@extends('layouts.admin')
@section('user')
    active
@endsection
@section('content')
<main class="main-area">
<link rel="stylesheet" href="{{ asset('css/users.css') }}">
<div class="users-page">
  <div class="topbar">
    <div><h1 class="page-title">Users Management</h1><p class="page-subtitle">Manage MESH Crypto members, roles and account status.</p></div>
    <button class="users-btn" id="exportUsers">↓ Export CSV</button>
  </div>
  <div class="row g-3 mb-4">
    <div class="col-xl-3 col-sm-6"><div class="users-card users-stat"><div class="users-stat-icon">♙</div><div><div class="users-label">Total Users</div><div class="users-number" id="totalUsers">0</div><small class="users-green">Registered accounts</small></div></div></div>
    <div class="col-xl-3 col-sm-6"><div class="users-card users-stat"><div class="users-stat-icon">✓</div><div><div class="users-label">Active Users</div><div class="users-number" id="activeUsers">0</div><small class="users-green">Accounts in good standing</small></div></div></div>
    <div class="col-xl-3 col-sm-6"><div class="users-card users-stat"><div class="users-stat-icon">♛</div><div><div class="users-label">Administrators</div><div class="users-number" id="adminUsers">0</div><small class="users-purple">Privileged accounts</small></div></div></div>
    <div class="col-xl-3 col-sm-6"><div class="users-card users-stat"><div class="users-stat-icon">⊘</div><div><div class="users-label">Suspended Users</div><div class="users-number" id="suspendedUsers">0</div><small class="users-red">Require attention</small></div></div></div>
  </div>
  <section class="users-card">
    <div class="users-toolbar">
      <div><h5 class="fw-bold mb-1">All Users</h5><small class="users-muted">View and manage registered accounts</small></div>
      <div class="users-filters">
        <input type="search" class="users-input" id="userSearch" placeholder="Search name, email or ID...">
        <select class="users-input" id="roleFilter"><option value="">All Roles</option><option>User</option><option>Admin</option></select>
        <select class="users-input" id="statusFilter"><option value="">All Status</option><option>Active</option><option>Suspended</option></select>
      </div>
    </div>
    <div class="users-table-wrap">
      <table class="users-table" id="usersTable">
        <thead><tr><th>USER</th><th>USER ID</th><th>EMAIL</th><th>ROLE</th><th>JOINED DATE</th><th>STATUS</th><th>ACTION</th></tr></thead>
        <tbody id="usersTableBody">
          <tr data-role="User" data-status="Active" data-id="USR1001" data-name="John Doe" data-email="john@example.com" data-date="Nov 08, 2026"><td><div class="users-person"><span class="users-avatar">J</span><span>John Doe</span></div></td><td class="users-id">USR1001</td><td>john@example.com</td><td><span class="users-role user-role">User</span></td><td>Nov 08, 2026</td><td><span class="users-status active-status">Active</span></td><td><div class="users-actions"><button class="users-action view-user" title="View">⌕</button><button class="users-action edit-user" title="Edit">✎</button><button class="users-action toggle-user" title="Suspend">⊘</button><button class="users-action delete-user" title="Delete">×</button></div></td></tr>
          <tr data-role="Admin" data-status="Active" data-id="USR1002" data-name="Admin One" data-email="admin@meshcrypto.com" data-date="Nov 07, 2026"><td><div class="users-person"><span class="users-avatar">A</span><span>Admin One</span></div></td><td class="users-id">USR1002</td><td>admin@meshcrypto.com</td><td><span class="users-role admin-role">Admin</span></td><td>Nov 07, 2026</td><td><span class="users-status active-status">Active</span></td><td><div class="users-actions"><button class="users-action view-user">⌕</button><button class="users-action edit-user">✎</button><button class="users-action toggle-user">⊘</button><button class="users-action delete-user">×</button></div></td></tr>
          <tr data-role="User" data-status="Active" data-id="USR1003" data-name="Alice Kim" data-email="alice@example.com" data-date="Nov 06, 2026"><td><div class="users-person"><span class="users-avatar">A</span><span>Alice Kim</span></div></td><td class="users-id">USR1003</td><td>alice@example.com</td><td><span class="users-role user-role">User</span></td><td>Nov 06, 2026</td><td><span class="users-status active-status">Active</span></td><td><div class="users-actions"><button class="users-action view-user">⌕</button><button class="users-action edit-user">✎</button><button class="users-action toggle-user">⊘</button><button class="users-action delete-user">×</button></div></td></tr>
          <tr data-role="User" data-status="Suspended" data-id="USR1004" data-name="Sarah Wilson" data-email="sarah@example.com" data-date="Nov 05, 2026"><td><div class="users-person"><span class="users-avatar">S</span><span>Sarah Wilson</span></div></td><td class="users-id">USR1004</td><td>sarah@example.com</td><td><span class="users-role user-role">User</span></td><td>Nov 05, 2026</td><td><span class="users-status suspended-status">Suspended</span></td><td><div class="users-actions"><button class="users-action view-user">⌕</button><button class="users-action edit-user">✎</button><button class="users-action toggle-user">⊘</button><button class="users-action delete-user">×</button></div></td></tr>
          <tr data-role="User" data-status="Active" data-id="USR1005" data-name="David Smith" data-email="david@example.com" data-date="Nov 04, 2026"><td><div class="users-person"><span class="users-avatar">D</span><span>David Smith</span></div></td><td class="users-id">USR1005</td><td>david@example.com</td><td><span class="users-role user-role">User</span></td><td>Nov 04, 2026</td><td><span class="users-status active-status">Active</span></td><td><div class="users-actions"><button class="users-action view-user">⌕</button><button class="users-action edit-user">✎</button><button class="users-action toggle-user">⊘</button><button class="users-action delete-user">×</button></div></td></tr>
        </tbody>
      </table>
      <div id="noUsers" class="users-empty" style="display:none">No users found.</div>
    </div>
    <div class="users-table-footer"><small class="users-muted" id="usersCount">Showing 5 users</small><small class="users-muted">Demo data · Connect Laravel database for live records</small></div>
  </section>
</div>
</main>

<!-- View modal -->
<div class="modal fade users-modal" id="viewUserModal" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content">
  <div class="modal-header"><h5 class="modal-title fw-bold">User Profile</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
  <div class="modal-body">
    <div class="users-profile-head"><div class="users-profile-avatar" id="viewAvatar">J</div><div><h5 id="viewName" class="mb-1">John Doe</h5><span id="viewStatus" class="users-status active-status">Active</span></div></div>
    <div class="users-detail"><span>User ID</span><strong id="viewId">-</strong></div><div class="users-detail"><span>Email</span><strong id="viewEmail">-</strong></div><div class="users-detail"><span>Role</span><strong id="viewRole">-</strong></div><div class="users-detail"><span>Joined Date</span><strong id="viewDate">-</strong></div>
  </div>
</div></div></div>

<!-- Edit modal -->
<div class="modal fade users-modal" id="editUserModal" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content">
  <form id="editUserForm"><div class="modal-header"><h5 class="modal-title fw-bold">Edit User</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
    <div class="modal-body">
      <input type="hidden" id="editRowId">
      <label class="users-form-label" for="editName">Full Name</label><input class="users-input w-100 mb-3" id="editName" required maxlength="100">
      <label class="users-form-label" for="editEmail">Email Address</label><input type="email" class="users-input w-100 mb-3" id="editEmail" required maxlength="150">
      <label class="users-form-label" for="editRole">Role</label><select class="users-input w-100" id="editRole"><option>User</option><option>Admin</option></select>
      <p class="users-warning mt-3 mb-0">Demo only: this does not change Laravel permissions.</p>
    </div><div class="modal-footer"><button type="button" class="users-btn users-btn-secondary" data-bs-dismiss="modal">Cancel</button><button type="submit" class="users-btn">Save Changes</button></div>
  </form>
</div></div></div>

<!-- Delete confirmation -->
<div class="modal fade users-modal" id="deleteUserModal" tabindex="-1"><div class="modal-dialog modal-dialog-centered modal-sm"><div class="modal-content">
  <div class="modal-header"><h5 class="modal-title fw-bold">Delete User?</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
  <div class="modal-body"><p>Are you sure you want to delete <strong id="deleteUserName">this user</strong>?</p><p class="users-warning">Demo only: this removes the sample row, not a database record.</p><input type="hidden" id="deleteRowId"></div>
  <div class="modal-footer"><button type="button" class="users-btn users-btn-secondary" data-bs-dismiss="modal">Cancel</button><button type="button" class="users-btn users-btn-danger" id="confirmDeleteUser">Delete</button></div>
</div></div></div>

<script src="{{ asset('js/users.js') }}"></script>
@endsection