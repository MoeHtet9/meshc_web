$(document).ready(function () {

  const $password = $("#password");
  const $confirm_password = $("#password-confirm");

  $(".password-toggle").on("click", function () {
    const isPassword = $password.attr("type") === "password";
    $password.attr("type", isPassword ? "text" : "password");
    $(this).text(isPassword ? "◉" : "◎").attr("aria-label", isPassword ? "Hide password" : "Show password");
  });

  $(".confirm-password-toggle").on("click", function () {
    const isPassword = $confirm_password.attr("type") === "password";
    $confirm_password.attr("type", isPassword ? "text" : "password");
    $(this).text(isPassword ? "◉" : "◎").attr("aria-label", isPassword ? "Hide password" : "Show password");
  });

    const $form = $('.depositForm').not('#withdrawalForm');
    const $button = $('.continueButton');
    const $feedback = $('.formFeedback');

    function checkForm() {
        const amount = $('input[name="amout"]:checked').length > 0;

        const screenshotInput = $('.paymentScreenshot')[0];

        const screenshot = screenshotInput
            ? screenshotInput.files.length > 0
            : false;

        const isValid = amount && screenshot;

        $button.prop('disabled', !isValid);

        return isValid;
    }

    // Amount ရွေးတဲ့အခါ
    $('input[name="amout"]').on('change', function () {
        $feedback.text('');
        checkForm();
    });

    // Screenshot ရွေးတဲ့အခါ
    $('.paymentScreenshot').on('change', function () {
        $feedback.text('');
        checkForm();
    });

    // Form စတင်ဖွင့်ချိန်မှာ button ကို စစ်ဆေးရန်
    checkForm();

    // Submit လုပ်တဲ့အခါ
    $form.on('submit', function (event) {
        if (!checkForm()) {
            event.preventDefault();

            $feedback.text(
                'Please select an amount and upload your payment screenshot.'
            );

            return;
        }

        $button.prop('disabled', true);
        $button.find('span').text('Submitting...');
    });

    // HISTORY ///////////////////////////////////////////////////////////////////////////////////////////////
    const rowsPerPage = 8;
    let currentPage = 1;

    const $tbody = $('#transactionRows');
    const $summary = $('#resultsSummary');
    const $prev = $('#prevPage');
    const $next = $('#nextPage');
    const $empty = $('#emptyState');
    const $pagination = $('.pagination-nav');

    function renderPagination() {
        const $rows = $tbody.children('tr');
        const totalRows = $rows.length;
        const totalPages = Math.ceil(totalRows / rowsPerPage);

        // Clear previous pagination buttons
        $pagination.find('button[data-page]').remove();

        // Empty state
        if (totalRows === 0) {
            $rows.attr('hidden', true);
            $empty.show();
            $summary.text('Showing 0 to 0 of 0 transactions');
            $prev.prop('disabled', true);
            $next.prop('disabled', true);
            return;
        }

        $empty.hide();

        currentPage = Math.max(1, Math.min(currentPage, totalPages));

        const start = (currentPage - 1) * rowsPerPage;
        const end = Math.min(start + rowsPerPage, totalRows);

        // Hide every row using the hidden attribute
        $rows.attr('hidden', true);

        // Show only the current page rows
        $rows.slice(start, end).removeAttr('hidden');

        // Create page buttons
        for (let page = 1; page <= totalPages; page++) {
            $('<button>', {
                type: 'button',
                class: 'page-btn' + (page === currentPage ? ' active' : ''),
                'data-page': page,
                text: page
            }).insertBefore($next);
        }

        $prev.prop('disabled', currentPage === 1);
        $next.prop('disabled', currentPage === totalPages);

        $summary.text(
            `Showing ${start + 1} to ${end} of ${totalRows} transactions`
        );

        console.log(
            'Total:', totalRows,
            'Page:', currentPage,
            'Visible:', $rows.filter(':not([hidden])').length
        );
    }

    $pagination.on('click', 'button[data-page]', function () {
        currentPage = Number($(this).attr('data-page'));
        renderPagination();
    });

    $prev.on('click', function () {
        if (currentPage > 1) {
            currentPage--;
            renderPagination();
        }
    });

    $next.on('click', function () {
        const totalPages = Math.ceil(
            $tbody.children('tr').length / rowsPerPage
        );

        if (currentPage < totalPages) {
            currentPage++;
            renderPagination();
        }
    });

    renderPagination();

    // WITHDRAWAL
    const $withdrawalForm = $('#withdrawalForm');

    if ($withdrawalForm.length) {
        const $amount = $('#amount');
        const $address = $('#withdrawalAddress');
        const $feedback = $('#formFeedback');
        const $button = $withdrawalForm.find('button[type="submit"]');

        const balance = Number($('#balance').text().trim());
        const minimum = 1.05;

        function validateWithdrawal() {
            const value = $amount.val();
            const amount = Number(value);
            const address = $address.val().trim();

            if (!address) {
                $feedback.text('Please enter your wallet address.')
                        .css('color', 'red');
                return false;
            }

            if (value === '' || !Number.isFinite(amount) || amount < minimum) {
                $feedback.text('Minimum withdrawal is 1.05 USDT.')
                        .css('color', 'red');
                return false;
            }

            if (!Number.isFinite(balance) || amount > balance) {
                $feedback.text('Insufficient balance!')
                        .css('color', 'red');
                return false;
            }

            $feedback.text('');
            return true;
        }

        $amount.add($address).on('input', validateWithdrawal);

        $withdrawalForm.on('submit', function (event) {
            if (!validateWithdrawal()) {
                event.preventDefault();
                return;
            }

            $button.prop('disabled', true);
            $button.find('span').text('Submitting...');
        });
    }
});
