    $(function () {
      var toastTimer;

      function showToast(message) {
        $("#appToast").stop(true, true).text(message).fadeIn(160);
        clearTimeout(toastTimer);
        toastTimer = setTimeout(function () {
          $("#appToast").fadeOut(250);
        }, 2800);
      }

      $("[data-toast]").on("click", function (event) {
        showToast($(this).attr("data-toast"));
      });

      $(".nav-link").on("click", function (event) {
        var section = $(this).data("section");
        $(".nav-link").removeClass("active");
        $(this).addClass("active");
        if (section !== "Dashboard" && section !== "Holdings") {
          showToast(section + " page will be connected to your backend.");
        }
      });

      $("#coinSearch").on("input", function () {
        var query = $.trim($(this).val().toLowerCase());
        var matches = $("#holdingsBody tr").filter(function () {
          return $(this).text().toLowerCase().indexOf(query) !== -1 ||
            ($(this).data("coin") || "").indexOf(query) !== -1;
        });
        $("#holdingsBody tr").toggle(matches.length > 0);
        $("#emptySearch").toggleClass("d-none", matches.length > 0);
      });

      $(document).on("keydown", function (event) {
        if ((event.ctrlKey || event.metaKey) && event.key.toLowerCase() === "k") {
          $("#coinSearch").trigger("focus");
        }
        if (event.key === "Escape") $("#coinSearch").val("").trigger("input").blur();
      });

      $("#notificationButton").on("click", function () {
        showToast("You're all caught up — no new notifications.");
      });
      $("#profileButton").on("click", function () {
        showToast("Signed in as Ko Moe Htet.");
      });
      $("#viewAllButton").on("click", function () {
        $("#holdingsBody tr").show();
        $("#emptySearch").addClass("d-none");
        $("#coinSearch").val("");
        showToast("Showing all available holdings.");
      });

      var chartRanges = {
        "1D": { line: "M65 135 C110 128 135 145 180 115 S250 132 295 102 S365 111 410 80 S500 95 540 63 S575 67 595 48", area: "M65 135 C110 128 135 145 180 115 S250 132 295 102 S365 111 410 80 S500 95 540 63 S575 67 595 48 L595 171 L65 171Z" },
        "1W": { line: "M65 162 C95 153 126 137 155 137 S214 119 245 119 S305 109 335 108 S395 101 425 91 S486 60 515 54 S565 66 595 59", area: "M65 162 C95 153 126 137 155 137 S214 119 245 119 S305 109 335 108 S395 101 425 91 S486 60 515 54 S565 66 595 59 L595 171 L65 171Z" },
        "1M": { line: "M65 157 C100 150 120 122 155 130 S205 140 245 105 S300 122 335 92 S390 100 425 75 S485 83 515 48 S565 57 595 34", area: "M65 157 C100 150 120 122 155 130 S205 140 245 105 S300 122 335 92 S390 100 425 75 S485 83 515 48 S565 57 595 34 L595 171 L65 171Z" },
        "1Y": { line: "M65 164 C105 158 125 143 155 145 S205 117 245 126 S300 90 335 100 S390 73 425 85 S480 44 515 51 S565 26 595 35", area: "M65 164 C105 158 125 143 155 145 S205 117 245 126 S300 90 335 100 S390 73 425 85 S480 44 515 51 S565 26 595 35 L595 171 L65 171Z" },
        "ALL": { line: "M65 165 C100 160 130 147 155 153 S210 125 245 132 S300 105 335 112 S390 85 425 93 S480 60 515 63 S560 42 595 28", area: "M65 165 C100 160 130 147 155 153 S210 125 245 132 S300 105 335 112 S390 85 425 93 S480 60 515 63 S560 42 595 28 L595 171 L65 171Z" }
      };

      $(".range-tab").on("click", function () {
        var range = $(this).data("range");
        $(".range-tab").removeClass("active");
        $(this).addClass("active");
        $("#chartLine").attr("d", chartRanges[range].line);
        $("#chartArea").attr("d", chartRanges[range].area);
        var points = chartRanges[range].line.match(/-?\d+(?:\.\d+)?/g);
        var coords = [];
        for (var i = 0; i < points.length - 1; i += 2) {
          coords.push({ x: Number(points[i]), y: Number(points[i + 1]) });
        }
        var chosen = coords.filter(function (_, index) {
          return index === 0 || index === coords.length - 1 || index % 2 === 0;
        });
        $("#chartPoints").empty();
        $.each(chosen, function (index, point) {
          $("<circle>").attr({ cx: point.x, cy: point.y, r: index === chosen.length - 1 ? 7 : 4 }).appendTo("#chartPoints");
        });
      });
    });

    $(document).ready(function () {
        $('.mobile-menu').on('click', function () {
            $('.sidebar').toggleClass('open');
            $('.sidebar-scrim').toggleClass('show');
        });

        $('.sidebar-scrim').on('click', function () {
            $('.sidebar').removeClass('open');
            $(this).removeClass('show');
        });
    });