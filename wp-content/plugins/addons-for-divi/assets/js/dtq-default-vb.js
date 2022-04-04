jQuery(function($) {
    var defaultImage =
        "data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTA4MCIgaGVpZ2h0PSI1NDAiIHZpZXdCb3g9IjAgMCAxMDgwIDU0MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KICAgIDxnIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI+CiAgICAgICAgPHBhdGggZmlsbD0iI0VCRUJFQiIgZD0iTTAgMGgxMDgwdjU0MEgweiIvPgogICAgICAgIDxwYXRoIGQ9Ik00NDUuNjQ5IDU0MGgtOTguOTk1TDE0NC42NDkgMzM3Ljk5NSAwIDQ4Mi42NDR2LTk4Ljk5NWwxMTYuMzY1LTExNi4zNjVjMTUuNjItMTUuNjIgNDAuOTQ3LTE1LjYyIDU2LjU2OCAwTDQ0NS42NSA1NDB6IiBmaWxsLW9wYWNpdHk9Ii4xIiBmaWxsPSIjMDAwIiBmaWxsLXJ1bGU9Im5vbnplcm8iLz4KICAgICAgICA8Y2lyY2xlIGZpbGwtb3BhY2l0eT0iLjA1IiBmaWxsPSIjMDAwIiBjeD0iMzMxIiBjeT0iMTQ4IiByPSI3MCIvPgogICAgICAgIDxwYXRoIGQ9Ik0xMDgwIDM3OXYxMTMuMTM3TDcyOC4xNjIgMTQwLjMgMzI4LjQ2MiA1NDBIMjE1LjMyNEw2OTkuODc4IDU1LjQ0NmMxNS42Mi0xNS42MiA0MC45NDgtMTUuNjIgNTYuNTY4IDBMMTA4MCAzNzl6IiBmaWxsLW9wYWNpdHk9Ii4yIiBmaWxsPSIjMDAwIiBmaWxsLXJ1bGU9Im5vbnplcm8iLz4KICAgIDwvZz4KPC9zdmc+Cg==";
    var title = "Your title goes here...";
    var content =
        "Your content goes here. Edit or remove this text inline or in the module content settings.";
    var contentSuffix =
        " You can also style every aspect of this content in the module Design settings and even apply custom CSS to this text in the module Advanced settings.";
    var is_vb = $("body").hasClass("et-fb");
    $(window).on("load", function() {
        is_vb &&
            window.ETBuilderBackend &&
            window.ETBuilderBackend.defaults &&
            ((window.ETBuilderBackend.defaults.ba_advanced_divider = {
                title: "Awesome",
                img_url: defaultImage
            }),
            (window.ETBuilderBackend.defaults.ba_review = {
                image: defaultImage,
                title,
                description: content + contentSuffix
            }),
            (window.ETBuilderBackend.defaults.ba_advanced_team = {
                member_name: "Jane Doe",
                job_title: "CEO, Acme Inc.",
                photo: defaultImage,
                short_bio: content,
                website: "#",
                facebook: "#",
                twitter: "#",
                linkedin: "#"
            }),
            (window.ETBuilderBackend.defaults.ba_card = {
                photo: defaultImage,
                title,
                description: content + contentSuffix
            }),
            (window.ETBuilderBackend.defaults.ba_video_popup = {
                video_link: "https://youtu.be/q9XI0Lo-SWE"
            }),
            (window.ETBuilderBackend.defaults.ba_testimonial = {
                name: "Jane Doe",
                title: "Web Designer",
                testimonial: content + contentSuffix
            }),
            (window.ETBuilderBackend.defaults.ba_skill_bar = {
                title: "My Skills"
            }),
            (window.ETBuilderBackend.defaults.ba_scroll_image = {
                image: defaultImage
            }),
            (window.ETBuilderBackend.defaults.ba_number = {
                number: "99"
            }),
            (window.ETBuilderBackend.defaults.ba_news_ticker = {
                title: "Breaking News"
            }),
            (window.ETBuilderBackend.defaults.ba_logo_carousel_child = {
                logo: defaultImage
            }),
            (window.ETBuilderBackend.defaults.ba_logo_grid_child = {
                logo_url: defaultImage
            }),
            (window.ETBuilderBackend.defaults.ba_info_box = {
                title,
                body_content: content + contentSuffix,
                photo: defaultImage
            }),
            (window.ETBuilderBackend.defaults.ba_image_carousel_child = {
                photo: defaultImage
            }),
            (window.ETBuilderBackend.defaults.ba_icon_box = {
                title,
                description: content + contentSuffix
            }),
            (window.ETBuilderBackend.defaults.ba_flipbox = {
                front_title: "Front Title",
                back_title: "Back Title"
            }),
            (window.ETBuilderBackend.defaults.ba_dual_button = {
                btn_a_text: "Primary",
                btn_b_text: "Secondary"
            }),
            (window.ETBuilderBackend.defaults.ba_business_hour_child = {
                day: "Friday",
                time: "10.00AM - 6.00PM"
            }),
            (window.ETBuilderBackend.defaults.ba_image_hover = {
                title: "Brain <span>Addons</span>",
                description: content,
                image: defaultImage
            }),
            (window.ETBuilderBackend.defaults.bapro_advanced_heading = {
                prefix: "Torque",
                center_text: "Heading"
            }),
            (window.ETBuilderBackend.defaults.bapro_horizontal_timeline_child = {
                title,
                description: content + contentSuffix,
                date_text: "01 January 1941"
            }),
            (window.ETBuilderBackend.defaults.ba_hotspots = {
                image: defaultImage
            }),
            (window.ETBuilderBackend.defaults.ba_hotspots_child = {
                tooltip_title: title,
                tooltip_description: content + contentSuffix
            }),
            (window.ETBuilderBackend.defaults.bapro_vertical_timeline_child = {
                title,
                description: content + contentSuffix
            }),
            (window.ETBuilderBackend.defaults.bapro_team_carousel_child = {
                member_name: "Jane Doe",
                job_title: "CEO, Company",
                photo: defaultImage,
                short_bio: content,
                website: "#",
                facebook: "#",
                twitter: "#",
                linkedin: "#"
            }),
            (window.ETBuilderBackend.defaults.bapro_testimonial_carousel_child = {
                name: "Jane Doe",
                title: "Job Title",
                testimonial: content + contentSuffix
            }),
            (window.ETBuilderBackend.defaults.bapro_hover_box = {
                title,
                description: content + contentSuffix
            }),
            (window.ETBuilderBackend.defaults.ba_image_accordion_child = {
                title,
                description: content + contentSuffix
            }),
            (window.ETBuilderBackend.defaults.bapro_list_group_child = {
                title,
                description: content
            }),
            (window.ETBuilderBackend.defaults.bapro_price_menu_child = {
                price: "$99.99",
                title,
                description: content
            }),
            (window.ETBuilderBackend.defaults.ba_alert = {
                title,
                description: content
            }),
            (window.ETBuilderBackend.defaults.ba_video_carousel_child = {
                image: defaultImage,
            }),
            (window.ETBuilderBackend.defaults.ba_image_accordion_child = {
                main_image: defaultImage,
            }),
            (window.ETBuilderBackend.defaults.bapro_text_highlight_child = {
                text: 'Divi Torque',
            }),
            (window.ETBuilderBackend.defaults.ba_animated_gallery_child = {
                image: defaultImage
            }));
    });
});
