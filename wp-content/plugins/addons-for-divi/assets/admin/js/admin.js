(function($, DTQ_PLUGIN) {
    "use strict";

    var $tabsNav = $(".dtq-nav").find(".dtq-tabs-nav"),
        $tabsContent = $(".dtq-admin-tabs").find(".dtq-admin-tabs-content");

    $tabsNav.on("click", ".dtq-admin-nav-item-link", function(e) {
        var $currentTab = $(e.currentTarget),
            tabTargetHash = e.currentTarget.hash,
            tabIdSelector = "#tab-content-" + tabTargetHash.substring(1),
            $currentTabContent = $tabsContent.find(tabIdSelector);

        e.preventDefault();

        $currentTab
            .addClass("active-tab")
            .siblings()
            .removeClass("active-tab");

        $currentTabContent
            .addClass("active-tab")
            .siblings()
            .removeClass("active-tab");

        window.location.hash = tabTargetHash;
    });

    if (window.location.hash) {
        $tabsNav.find('a[href="' + window.location.hash + '"]').click();
    }

    var $adminForm = $(".dtq-form-admin"),
        $saveButton = $adminForm.find(".dtq-btn-save");

    $adminForm.on("submit", function(e) {
        e.preventDefault();
        $.post({
            url: DTQ_PLUGIN.ajaxUrl,
            data: {
                nonce: DTQ_PLUGIN.nonce,
                action: DTQ_PLUGIN.action,
                data: $adminForm.serialize()
            },

            beforeSend: function() {
                $saveButton.text("Saving...");
            },

            success: function(response) {
                if (response.success) {
                    var t = setTimeout(function() {
                        $saveButton
                            .attr("disabled", true)
                            .text("Changes Saved");
                        clearTimeout(t);
                    }, 500);
                }
            }
        });
    });

    $adminForm.on("change", ":checkbox, :radio", function() {
        $saveButton.attr("disabled", false).text("Save Changes");
    });

    $adminForm.on("change", ":text", function() {
        $saveButton.attr("disabled", false).text("Save Changes");
    });

    var $adminNotice = $(
        ".dtq-review-deserve, .dtq-review-later, .dtq-review-done"
    );

    $adminNotice.on("click", function(e) {
        var btn = $(this),
            notice = btn.closest(".dtq-notice");

        if (!btn.hasClass("dtq-review-deserve")) {
            e.preventDefault();
        }

        $.ajax({
            url: DTQ_PLUGIN.ajaxUrl,
            type: "POST",
            data: {
                action: "divitorque-dismiss-notice",
                nonce: DTQ_PLUGIN.nonce,
                repeat: !!btn.hasClass("dtq-review-later")
            }
        });

        notice.animate(
            {
                opacity: "-=1"
            },
            1000,
            function() {
                notice.remove();
            }
        );
    });

    $('.dtq-pro-alert-close').on('click', function(){
        $(this).parents('.dtq-pro-alert').hide();
    });

    $('.dtq-btn-alert').on('click', function(e){
        e.preventDefault();
        $('.dtq-pro-alert').show();
    });

})(jQuery, window.DTQ_PLUGIN);
