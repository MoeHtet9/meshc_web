$(function() {
    // Count-up effect
    $('.count').each(function() {
      const $el = $(this), target = Number($el.data('count')), duration = 1250, start = performance.now();
      function tick(now) {
        const p = Math.min((now - start) / duration, 1), eased = 1 - Math.pow(1 - p, 3);
        $el.text(Math.floor(target * eased).toLocaleString('en-US'));
        if (p < 1) requestAnimationFrame(tick);
      }
      requestAnimationFrame(tick);
    });

    // Mobile sidebar
    function closeSidebar() {
      $('#sidebar').removeClass('open');
      $('#sidebarBackdrop').removeClass('show');
    }
    $('#mobileMenu').on('click', function() {
      $('#sidebar').addClass('open');
      $('#sidebarBackdrop').addClass('show');
    });
    $('#sidebarBackdrop').on('click', closeSidebar);   

    // Market range buttons: illustrative chart changes
    const chartSets = {
      '24H': { price: '$68,420.50', change: '+3.72%', path: 'M0 151 C25 139 27 119 49 130 S83 99 105 112 S139 129 160 107 S191 88 211 102 S249 143 274 120 S308 112 329 91 S359 111 382 88 S415 64 437 80 S469 119 491 93 S521 70 542 80 S572 48 595 63 S626 81 650 57 S682 78 704 44 S737 29 760 12' },
      '7D': { price: '$67,985.20', change: '+2.91%', path: 'M0 137 C30 126 45 145 69 117 S105 92 127 108 S160 130 184 92 S222 81 244 100 S279 121 301 91 S338 102 362 75 S398 51 421 72 S455 104 479 83 S516 56 540 70 S575 88 599 48 S635 61 658 42 S701 58 723 24 S745 31 760 18' },
      '30D': { price: '$66,740.80', change: '+6.18%', path: 'M0 150 C25 143 39 120 62 134 S101 111 126 119 S159 89 184 106 S219 128 243 92 S277 85 300 99 S334 113 356 78 S392 91 414 66 S451 81 473 58 S510 73 532 54 S566 69 590 43 S624 58 648 37 S686 51 709 27 S741 38 760 14' },
      '1Y': { price: '$68,420.50', change: '+18.42%', path: 'M0 157 C30 149 48 139 71 145 S111 117 135 130 S173 108 197 118 S235 87 259 102 S299 112 321 82 S357 96 380 68 S418 80 440 60 S476 75 500 50 S536 65 559 42 S595 57 619 35 S655 49 679 29 S716 41 738 18 S751 23 760 9' }
    };
    $('.range-btn').on('click', function() {
      const range = $(this).data('range'), data = chartSets[range];
      $('.range-btn').removeClass('active');
      $(this).addClass('active');
      $('#btcPrice').text(data.price);
      $('#btcChange').text('⌃ ' + data.change);
      $('#chartLine').attr('d', data.path);
      $('#chartArea').attr('d', data.path + ' L760 170 L0 170Z');
      $('#chartLine').css('animation', 'none');
      void $('#chartLine')[0].getBoundingClientRect();
      $('#chartLine').css('animation', 'drawLine .8s ease');
    });

    // Ripple feedback for buttons
    $(document).on('click', '.range-btn,.icon-btn,.mobile-menu,.panel-link', function(e) {
      const $btn = $(this), offset = $btn.offset(), size = Math.max($btn.outerWidth(), $btn.outerHeight());
      const x = e.pageX - offset.left - size / 2, y = e.pageY - offset.top - size / 2;
      const $r = $('<span class="ripple"></span>').css({ width: size, height: size, left: x, top: y });
      $btn.css('position', 'relative').css('overflow', 'hidden').append($r);
      setTimeout(() => $r.remove(), 650);
    });

    // Demo feedback for links without a backend route
    $('a[href^="#"]').not('.nav-link-custom').on('click', function(e) {
      const target = $(this).attr('href');
      if (['#logout', '#profile', '#all-users', '#all-activities', '#kyc', '#transactions', '#settings'].includes(target)) {
        e.preventDefault();
        showToast('Connect ' + target + ' to your Laravel route.');
      }
    });

    let toastTimer;
    function showToast(message) {
      $('#toastNote').text(message).addClass('show');
      clearTimeout(toastTimer);
      toastTimer = setTimeout(() => $('#toastNote').removeClass('show'), 2600);
    }

    // Transaction page: filter, view details, export CSV #########################################################################
    // SEARCH + FILTER
    function filterTransactions() {

        let search = $('#txSearch').val().toLowerCase();
        let status = $('#txStatus').val();
        let type = $('#txType').val();

        let visible = 0;

        $('#transactionBody tr').each(function () {

            let row = $(this);
            let text = row.text().toLowerCase();

            let matchSearch = text.includes(search);
            let matchStatus = !status || row.data('status') === status;
            let matchType = !type || row.data('type') === type;

            if (matchSearch && matchStatus && matchType) {
                row.show();
                visible++;
            } else {
                row.hide();
            }
        });

        $('#noTransactions').toggle(visible === 0);
        $('#txCount').text('Showing ' + visible + ' transactions');
    }

    $('#txSearch').on('input', filterTransactions);
    $('#txStatus, #txType').on('change', filterTransactions);


    // VIEW DETAILS MODAL
    $(document).on('click', '.view-tx', function () {

        let row = $(this).closest('tr');

        let img = row.find('.img').val();
        let address = row.find('.address').val();
        let id = row.find('td:eq(0)').text().trim();
        let user = row.find('.tx-user').text().trim();
        let type = row.find('td:eq(2)').text().trim();
        let asset = row.find('td:eq(3)').text().trim();
        let amount = row.find('td:eq(4)').text().trim();
        let date = row.find('td:eq(5)').text().trim();
        let status = row.data('status');

        if(!img) {
            $('#modalImg').html('<div style="font-size:15px;color:#9c80ff;margin-bottom:10px;overflow-x: auto;scrollbar-width: thin;">' + address + '</div>');
        } else {
            $('#modalImg').html('<img src="' + img + '" alt="Transaction Image" style="max-width:100%;max-height:200px;border-radius:5px;margin-bottom:10px">');
        }
        $('#modalId').text(id);
        $('#modalUser').text(user);
        $('#modalType').text(type);
        $('#modalAsset').text(asset);
        $('#modalAmount').text(amount);
        $('#modalDate').text(date);

        $('#modalStatus')
            .text(status)
            .removeClass('completed pending failed')
            .addClass(status.toLowerCase());

        let modal = bootstrap.Modal.getOrCreateInstance(
            document.getElementById('transactionModal')
        );

        modal.show();
    });

    // User #####################################################################################################
    const viewModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('viewUserModal'));
    const editModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('editUserModal'));
    const deleteModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('deleteUserModal'));

    function refreshStats() {
        const rows = $('#usersTableBody tr');
        $('#totalUsers').text(rows.length.toLocaleString());
        $('#activeUsers').text(rows.filter('[data-status="Active"]').length.toLocaleString());
        $('#suspendedUsers').text(rows.filter('[data-status="Suspended"]').length.toLocaleString());
        $('#adminUsers').text(rows.filter('[data-role="Admin"]').length.toLocaleString());
    }

    function filterUsers() {
        const search = $('#userSearch').val().toLowerCase().trim();
        const role = $('#roleFilter').val();
        const status = $('#statusFilter').val();
        let visible = 0;

        $('#usersTableBody tr').each(function () {
            const row = $(this);
            const matches = row.text().toLowerCase().includes(search)
                && (!role || row.attr('data-role') === role)
                && (!status || row.attr('data-status') === status);
            row.toggle(matches);
            if (matches) visible++;
        });

        $('#noUsers').toggle(visible === 0);
        $('#usersCount').text('Showing ' + visible + ' users');
    }

    $('#userSearch').on('input', filterUsers);
    $('#roleFilter, #statusFilter').on('change', filterUsers);

    $(document).on('click', '.view-user', function () {
        const row = $(this).closest('tr');
        const name = row.attr('data-name');
        const status = row.attr('data-status');

        $('#viewAvatar').text(name.trim().charAt(0).toUpperCase());
        $('#viewName').text(name);
        $('#viewId').text(row.attr('data-id'));
        $('#viewEmail').text(row.attr('data-email'));
        $('#viewRole').text(row.attr('data-role'));
        $('#viewDate').text(row.attr('data-date'));
        $('#viewStatus').text(status)
            .removeClass('active-status suspended-status')
            .addClass(status === 'Active' ? 'active-status' : 'suspended-status');
        viewModal.show();
    });

    $(document).on('click', '.edit-user', function () {
        const row = $(this).closest('tr');
        $('#editRowId').val(row.attr('data-id'));
        $('#editName').val(row.attr('data-name'));
        $('#editEmail').val(row.attr('data-email'));
        $('#editRole').val(row.attr('data-role'));
        editModal.show();
    });

    $('#editUserForm').on('submit', function (event) {
        event.preventDefault();
        const id = $('#editRowId').val();
        const row = $('#usersTableBody tr').filter(function () {
            return $(this).attr('data-id') === id;
        }).first();
        const name = $('#editName').val().trim();
        const email = $('#editEmail').val().trim();
        const role = $('#editRole').val();
        if (!row.length || !name || !email) return;

        row.attr({'data-name': name, 'data-email': email, 'data-role': role});
        row.find('.users-person > span:last-child').text(name);
        row.find('.users-avatar').text(name.charAt(0).toUpperCase());
        row.find('td:eq(2)').text(email);
        row.find('td:eq(3)').html(
            '<span class="users-role ' + (role === 'Admin' ? 'admin-role' : 'user-role') + '">' + role + '</span>'
        );
        editModal.hide();
        refreshStats();
        filterUsers();
    });

    $(document).on('click', '.toggle-user', function () {
        const row = $(this).closest('tr');
        const next = row.attr('data-status') === 'Active' ? 'Suspended' : 'Active';
        row.attr('data-status', next);
        row.find('.users-status').text(next)
            .removeClass('active-status suspended-status')
            .addClass(next === 'Active' ? 'active-status' : 'suspended-status');
        $(this).attr('title', next === 'Active' ? 'Suspend' : 'Activate');
        refreshStats();
        filterUsers();
    });

    $(document).on('click', '.delete-user', function () {
        const row = $(this).closest('tr');
        $('#deleteRowId').val(row.attr('data-id'));
        $('#deleteUserName').text(row.attr('data-name'));
        deleteModal.show();
    });

    $('#confirmDeleteUser').on('click', function () {
        const id = $('#deleteRowId').val();
        $('#usersTableBody tr').filter(function () {
            return $(this).attr('data-id') === id;
        }).remove();
        deleteModal.hide();
        refreshStats();
        filterUsers();
    });

    $('#exportUsers').on('click', function () {
        const rows = [];
        $('#usersTable thead tr, #usersTableBody tr:visible').each(function () {
            const cells = [];
            $(this).find('th,td').each(function (index) {
                if (index === 8) return;
                const value = $(this).text().trim().replace(/\s+/g, ' ');
                cells.push('"' + value.replace(/"/g, '""') + '"');
            });
            rows.push(cells.join(','));
        });

        const blob = new Blob(['\uFEFF' + rows.join('\n')], {type:'text/csv;charset=utf-8;'});
        const url = URL.createObjectURL(blob);
        const link = document.createElement('a');
        link.href = url;
        link.download = 'mesh-users.csv';
        link.click();
        URL.revokeObjectURL(url);
    });

    refreshStats();
    filterUsers();

});
