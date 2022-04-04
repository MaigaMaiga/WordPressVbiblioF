export const process_margin_padding = (
    val = "0|0|0|0",
    type = "padding",
    imp = false
) => {
    if (val) {
        let _val = val.split("|"),
            top = "",
            right = "",
            bottom = "",
            left = "",
            important = "";

        if (imp) {
            important = "!important";
        }

        if (Array.isArray(_val)) {
            top = `${type}-top:${_val[0]}${important};`;
            right = `${type}-right:${_val[1]}${important};`;
            bottom = `${type}-bottom:${_val[2]}${important};`;
            left = `${type}-left:${_val[3]}${important};`;
        }

        return `${top} ${right} ${bottom} ${left}`;
    }
};

export const process_flex_style = (data, type, important) => {
    let flex_val = "center";
    if (data === "left") {
        flex_val = "flex-start";
    } else if (data === "right") {
        flex_val = "flex-end";
    }

    return `${type}:${flex_val}${important ? "!important" : ""}`;
};

export const get_conditional_responsive_styles = (styles = {}, data, style) => {
    let important = styles["important"] ? styles["important"] : false;

    if (
        style === "align-self" ||
        style === "align-items" ||
        style === "justify-content"
    ) {
        return process_flex_style(data, style, important);
    } else if (style === "padding" || style === "margin") {
        return process_margin_padding(data, style, important);
    } else if (style === "flex") {
        return `flex: 0 0 ${data}`;
    } else {
        return `
			  ${style}:${data}${important ? "!important" : ""}`;
    }
};

export const get_responsive_styles = (
    props,
    opt_name,
    selector,
    styles = {},
    pre_values = {}
) => {
    let additionalCss = [],
        _data = props[opt_name],
        _style = styles["primary"],
        _data_tablet = props[opt_name + "_tablet"],
        _data_phone = props[opt_name + "_phone"],
        opt_last_edited = props[opt_name + "_last_edited"],
        is_enabled = opt_last_edited && opt_last_edited.startsWith("on");

    if (!_data && pre_values) {
        let is_default = true;
        if (pre_values["conditional"]) {
            pre_values["conditional"]["values"].forEach(value => {
                let property_val = props[pre_values["conditional"]["name"]];
                if (property_val === value["a"]) {
                    _data = value["b"];
                    is_default = false;
                }
            });
        }
        if (is_default) {
            _data = pre_values["default"];
        }
    }

    if (_data) {
        additionalCss.push([
            {
                selector,
                declaration: get_conditional_responsive_styles(
                    styles,
                    _data,
                    _style
                )
            }
        ]);

        if (styles["secondary"]) {
            additionalCss.push([
                {
                    selector,
                    declaration: styles["secondary"]
                }
            ]);
        }
    }

    if (is_enabled) {
        if (_data_tablet) {
            additionalCss.push([
                {
                    selector,
                    device: "tablet",
                    declaration: get_conditional_responsive_styles(
                        styles,
                        _data_tablet,
                        _style
                    )
                }
            ]);

            if (styles["secondary"]) {
                additionalCss.push([
                    {
                        selector,
                        device: "tablet",
                        declaration: styles["secondary"]
                    }
                ]);
            }
        }

        if (_data_phone) {
            additionalCss.push([
                {
                    selector,
                    device: "phone",
                    declaration: get_conditional_responsive_styles(
                        styles,
                        _data_phone,
                        _style
                    )
                }
            ]);

            if (styles["secondary"]) {
                additionalCss.push([
                    {
                        selector,
                        device: "phone",
                        declaration: styles["secondary"]
                    }
                ]);
            }
        }
    }

    return additionalCss;
};

export const _getButtonsStyles = (prefix, props, selector) => {
    let additionalCss = [],
        padding_hover_status = props[prefix + "_custom_padding__hover_enabled"],
        is_padding_hover = padding_hover_status
            ? padding_hover_status.split("|")[0] === "on"
                ? true
                : false
            : false,
        border_color = props[prefix + "_border_color"],
        border_radius = props[prefix + "_border_radius"],
        custom_padding = props[prefix + "_custom_padding"],
        custom_padding_tablet = props[prefix + "_custom_padding_tablet"],
        custom_padding_phone = props[prefix + "_custom_padding_phone"],
        custom_padding_responsive_status =
            props[prefix + "_custom_padding_last_edited"] &&
            props[prefix + "_custom_padding_last_edited"].startsWith("on"),
        custom_padding__hover = props[prefix + "_custom_padding__hover"],
        is_custom = props["custom_" + prefix],
        hover_enabled = props.hover_enabled;

    if (is_custom === "on") {
        if (border_color) {
            additionalCss.push([
                {
                    selector,
                    declaration: `border-color: ${border_color} !important;`
                }
            ]);
        }

        if (border_radius) {
            additionalCss.push([
                {
                    selector,
                    declaration: `border-radius: ${border_radius} !important;`
                }
            ]);
        }

        // Custom padding
        if (custom_padding) {
            let _custom_padding = custom_padding.split("|");
            additionalCss.push([
                {
                    selector: `body #page-container ${selector}, .et-db #et-boc ${selector}`,
                    declaration: `
					  padding-top: ${_custom_padding[0]}!important;
					  padding-right: ${_custom_padding[1]}!important;
					  padding-bottom: ${_custom_padding[2]}!important;
					  padding-left: ${_custom_padding[3]}!important;`
                }
            ]);
        }

        if (is_padding_hover && custom_padding__hover) {
            let _custom_padding__hover = custom_padding__hover.split("|");
            additionalCss.push([
                {
                    selector: `body #page-container ${selector}:hover, .et-db #et-boc ${selector}:hover`,
                    declaration: `
					  padding-top: ${_custom_padding__hover[0]}!important;
					  padding-right: ${_custom_padding__hover[1]}!important;
					  padding-bottom: ${_custom_padding__hover[2]}!important;
					  padding-left: ${_custom_padding__hover[3]}!important;`
                }
            ]);
            if (hover_enabled === 1) {
                additionalCss.push([
                    {
                        selector: `body #page-container ${selector}, .et-db #et-boc ${selector}`,
                        declaration: `
						  padding-top: ${_custom_padding__hover[0]}!important;
						  padding-right: ${_custom_padding__hover[1]}!important;
						  padding-bottom: ${_custom_padding__hover[2]}!important;
						  padding-left: ${_custom_padding__hover[3]}!important;`
                    }
                ]);
            }
        } else {
            if (custom_padding) {
                let custom_padding_hover = custom_padding.split("|");
                additionalCss.push([
                    {
                        selector: `body #page-container ${selector}:hover, .et-db #et-boc ${selector}:hover`,
                        declaration: `
						  padding-top: ${custom_padding_hover[0]}!important;
						  padding-right: ${custom_padding_hover[1]}!important;
						  padding-bottom: ${custom_padding_hover[2]}!important;
						  padding-left: ${custom_padding_hover[3]}!important;`
                    }
                ]);
                if (hover_enabled === 1) {
                    additionalCss.push([
                        {
                            selector: `body #page-container ${selector}, .et-db #et-boc ${selector}`,
                            declaration: `
							  padding-top: ${custom_padding_hover[0]}!important;
							  padding-right: ${custom_padding_hover[1]}!important;
							  padding-bottom: ${custom_padding_hover[2]}!important;
							  padding-left: ${custom_padding_hover[3]}!important;`
                        }
                    ]);
                }
            }
        }

        if (custom_padding_tablet && custom_padding_responsive_status) {
            custom_padding_tablet = custom_padding_tablet.split("|");
            additionalCss.push([
                {
                    selector: `body #page-container ${selector}, .et-db #et-boc ${selector}`,
                    device: "tablet",
                    declaration: `
					  padding-top: ${custom_padding_tablet[0]}!important;
					  padding-right: ${custom_padding_tablet[1]}!important;
					  padding-bottom: ${custom_padding_tablet[2]}!important;
					  padding-left: ${custom_padding_tablet[3]}!important;`
                }
            ]);
        }

        if (custom_padding_phone && custom_padding_responsive_status) {
            custom_padding_phone = custom_padding_phone.split("|");
            additionalCss.push([
                {
                    selector: `body #page-container ${selector}, .et-db #et-boc ${selector}`,
                    device: "phone",
                    declaration: `
					  padding-top: ${custom_padding_phone[0]}!important;
					  padding-right: ${custom_padding_phone[1]}!important;
					  padding-bottom: ${custom_padding_phone[2]}!important;
					  padding-left: ${custom_padding_phone[3]}!important;`
                }
            ]);
        }

        // Custom padding end
    }

    return additionalCss;
};

export const _getOverlayStyleCss = (props, photo_opt_name, hover_element) => {
    let additionalCss = [],
        overlay_icon_color = props.overlay_icon_color
            ? props.overlay_icon_color
            : "#2EA3F2",
        overlay_icon_color__hover = props.overlay_icon_color__hover,
        overlay_on_hover = props.overlay_on_hover,
        overlay_hover_speed = props.overlay_hover_speed
            ? props.overlay_hover_speed
            : "300ms",
        overlay_icon_size = props.overlay_icon_size
            ? props.overlay_icon_size
            : "32px",
        overlay_icon_size__hover = props.overlay_icon_size__hover,
        overlay_icon_opacity = props.overlay_icon_opacity
            ? props.overlay_icon_opacity
            : "1",
        overlay_icon_opacity__hover = props.overlay_icon_opacity__hover,
        photo_raddi = props["border_radii_" + photo_opt_name];

    if (photo_raddi) {
        let $raddi = photo_raddi.split("|"),
            $raddi_1 = $raddi[1] !== "" ? $raddi[1] : "0",
            $raddi_2 = $raddi[2] !== "" ? $raddi[2] : "0",
            $raddi_3 = $raddi[3] !== "" ? $raddi[3] : "0",
            $raddi_4 = $raddi[4] !== "" ? $raddi[4] : "0";

        additionalCss.push([
            {
                selector: "%%order_class%% .dtq-overlay",
                declaration: `border-radius: ${$raddi_1} ${$raddi_2} ${$raddi_3} ${$raddi_4};`
            }
        ]);
    }

    if ("on" === overlay_on_hover) {
        additionalCss.push([
            {
                selector: "%%order_class%% .dtq-overlay",
                declaration: "opacity:0;"
            }
        ]);
        additionalCss.push([
            {
                selector: hover_element + ":hover .dtq-overlay",
                declaration: "opacity:1;"
            }
        ]);
    }

    additionalCss.push([
        {
            selector:
                "%%order_class%% .dtq-overlay, %%order_class%% .dtq-overlay .dtq-overlay-icon",
            declaration: `
			transition: all ${overlay_hover_speed} ease-in-out;`
        }
    ]);

    additionalCss.push([
        {
            selector: "%%order_class%% .dtq-overlay .dtq-overlay-icon",
            declaration: `
			color: ${overlay_icon_color};`
        }
    ]);

    if (overlay_icon_color__hover) {
        additionalCss.push([
            {
                selector:
                    hover_element + ":hover .dtq-overlay .dtq-overlay-icon",
                declaration: `color: ${overlay_icon_color__hover};`
            }
        ]);
    }

    additionalCss.push([
        {
            selector: "%%order_class%% .dtq-overlay .dtq-overlay-icon",
            declaration: `font-size: ${overlay_icon_size};`
        }
    ]);

    if (overlay_icon_size__hover) {
        additionalCss.push([
            {
                selector:
                    hover_element + ":hover .dtq-overlay .dtq-overlay-icon",
                declaration: `font-size: ${overlay_icon_size__hover};`
            }
        ]);
    }

    additionalCss.push([
        {
            selector: "%%order_class%% .dtq-overlay .dtq-overlay-icon",
            declaration: `opacity: ${overlay_icon_opacity};`
        }
    ]);

    if (overlay_icon_opacity__hover) {
        additionalCss.push([
            {
                selector:
                    hover_element + ":hover .dtq-overlay .dtq-overlay-icon",
                declaration: `opacity: ${overlay_icon_opacity__hover};`
            }
        ]);
    }

    if (props.hover_enabled === 1) {
        if (overlay_icon_opacity__hover) {
            additionalCss.push([
                {
                    selector: "%%order_class%% .dtq-overlay .dtq-overlay-icon",
                    declaration: `opacity: ${overlay_icon_opacity__hover};`
                }
            ]);
        }
        if (overlay_icon_size__hover) {
            additionalCss.push([
                {
                    selector: "%%order_class%% .dtq-overlay .dtq-overlay-icon",
                    declaration: `font-size: ${overlay_icon_size__hover};`
                }
            ]);
        }
        if (overlay_icon_color__hover) {
            additionalCss.push([
                {
                    selector: "%%order_class%% .dtq-overlay .dtq-overlay-icon",
                    declaration: `color: ${overlay_icon_color__hover};`
                }
            ]);
        }
    }

    // Overlay Background
    let overlay_bg_style = _getCustomBgCss(
        props,
        "overlay",
        "%%order_class%% .dtq-overlay",
        "%%order_class%%:hover .dtq-overlay"
    );

    return additionalCss.concat(overlay_bg_style);
};

export const render_swapped_image = (
    opt_name,
    props,
    figure_callback,
    state
) => {
    let photo_status = props[opt_name + "_last_edited"]
            ? props[opt_name + "_last_edited"]
            : "off|desktop",
        is_photo_edited = photo_status.split("|")[0],
        device =
            is_photo_edited === "on" ? photo_status.split("|")[1] : "desktop",
        photo_hover_enabled = props[opt_name + "__hover_enabled"]
            ? props[opt_name + "__hover_enabled"]
            : "off|desktop",
        has_photo_hover =
            photo_hover_enabled.split("|")[0] === "on" ? true : false,
        hover_status = props.hover_enabled ? props.hover_enabled : "0",
        photo = props[opt_name] ? props[opt_name] : "",
        photo_tablet = props[opt_name + "_tablet"]
            ? props[opt_name + "_tablet"]
            : photo,
        photo_phone = props[opt_name + "_phone"]
            ? props[opt_name + "_phone"]
            : photo_tablet,
        photo_hover = props[opt_name + "__hover"]
            ? props[opt_name + "__hover"]
            : photo,
        figure = null;

    if (device === "desktop") {
        if (has_photo_hover && hover_status === 1) {
            figure = figure_callback(photo_hover);
        } else {
            figure = figure_callback(photo);
        }
    } else if (device === "tablet") {
        if (state.width > 800) {
            figure = figure_callback(photo);
        } else {
            figure = figure_callback(photo_tablet);
        }
    } else if (device === "phone") {
        if (state.width > 500) {
            figure = figure_callback(photo);
        } else {
            figure = figure_callback(photo_phone);
        }
    }

    return figure;
};

export const _getAbsoluteElementStyles = (
    props,
    prefix,
    selector,
    defaultData
) => {
    let additionalCss = [],
        position = props[prefix + "_position"]
            ? props[prefix + "_position"]
            : defaultData.position,
        split_position = position.split("_"),
        offset_x = props[prefix + "_offset_x"]
            ? props[prefix + "_offset_x"]
            : defaultData.offset_x,
        offset_y = props[prefix + "_offset_y"]
            ? props[prefix + "_offset_y"]
            : defaultData.offset_y,
        is_center_y = props[prefix + "_is_center_y"]
            ? props[prefix + "_is_center_y"]
            : "off",
        is_center_x = props[prefix + "_is_center_x"]
            ? props[prefix + "_is_center_x"]
            : "off",
        val_y = 0,
        val_x = 0;

    additionalCss.push([
        {
            selector,
            declaration: `position: absolute; z-index: 999;`
        }
    ]);

    if (is_center_y === "on") {
        additionalCss.push([
            {
                selector,
                declaration: `${split_position[1]}: 50%;`
            }
        ]);
    } else {
        additionalCss.push([
            {
                selector,
                declaration: `${split_position[1]}: ${offset_y};`
            }
        ]);
    }

    if (is_center_x === "on") {
        additionalCss.push([
            {
                selector,
                declaration: `${split_position[0]}: 50%;`
            }
        ]);
    } else {
        additionalCss.push([
            {
                selector,
                declaration: `${split_position[0]}: ${offset_x};`
            }
        ]);
    }

    if (position === "right_top") {
        if (is_center_y === "on") {
            val_y = "-50%";
        }
        if (is_center_x === "on") {
            val_x = "50%";
        }
    } else if (position === "right_bottom") {
        if (is_center_y === "on") {
            val_y = "50%";
        }
        if (is_center_x === "on") {
            val_x = "50%";
        }
    } else if (position === "left_bottom") {
        if (is_center_y === "on") {
            val_y = "50%";
        }
        if (is_center_x === "on") {
            val_x = "-50%";
        }
    } else if (position === "left_top") {
        if (is_center_y === "on") {
            val_y = "-50%";
        }
        if (is_center_x === "on") {
            val_x = "-50%";
        }
    }

    additionalCss.push([
        {
            selector,
            declaration: `transform : translateX(${val_x}) translateY(${val_y});`
        }
    ]);

    return additionalCss;
};

export const _getBadgeStyles = (
    props,
    prefix,
    selector,
    hoverSelector,
    defaultData
) => {
    let additionalCss = [],
        padding = props[prefix + "_padding"]
            ? props[prefix + "_padding"]
            : defaultData.padding,
        _padding = padding.split("|");

    // BG
    let badgeBg = _getCustomBgCss(props, "badge", selector, hoverSelector);

    // padding
    additionalCss.push([
        {
            selector,
            declaration: `
			  padding-top:${_padding[0]};
			  padding-right:${_padding[1]};
			  padding-bottom:${_padding[2]};
			  padding-left:${_padding[3]};`
        }
    ]);

    return additionalCss
        .concat(_getAbsoluteElementStyles(props, prefix, selector, defaultData))
        .concat(badgeBg);
};

export const _getCustomBgCss = (
    props,
    opt_name,
    selector,
    hover_selector,
    default_color
) => {
    let _bg_style = "";
    let _bg_images = [];
    let additionalCss = [];

    let has_bg_color_gradient = false;

    // A. Background Gradient.
    let use_background_color_gradient =
        props[opt_name + "_bg_use_color_gradient"] || "off";
    let _bg_gradient_overlays_image =
        props[opt_name + "_bg_color_gradient_overlays_image"] || "off";

    if ("on" === use_background_color_gradient) {
        let _bg_gradient_type =
            props[opt_name + "_bg_color_gradient_type"] || "linear";
        let _bg_gradient_direction =
            props[opt_name + "_bg_color_gradient_direction"] || "180deg";
        let _bg_gradient_radial_direction =
            props[opt_name + "_bg_color_gradient_direction_radial"] || "center";
        let _bg_gradient_color_start =
            props[opt_name + "_bg_color_gradient_start"] || "#2b87da";
        let _bg_gradient_color_end =
            props[opt_name + "_bg_color_gradient_end"] || "#29c4a9";
        let _bg_gradient_start_position =
            props[opt_name + "_bg_color_gradient_start_position"] || "0%";
        let _bg_gradient_end_position =
            props[opt_name + "_bg_color_gradient_end_position"] || "100%";

        _bg_gradient_direction =
            _bg_gradient_type === "linear"
                ? _bg_gradient_direction
                : `circle at ${_bg_gradient_radial_direction}`;

        let _bg_gradient_css = `${_bg_gradient_type}-gradient( ${_bg_gradient_direction}, ${_bg_gradient_color_start} ${_bg_gradient_start_position}, ${_bg_gradient_color_end} ${_bg_gradient_end_position} )`;

        _bg_images.push(_bg_gradient_css);

        has_bg_color_gradient = true;
    }

    // Image
    let _bg_image = props[opt_name + "_bg_image"] || "";
    let _parallax = props[opt_name + "_bg_parallax"] || "";
    let is_bg_image_active =
        "" !== props[opt_name + "_bg_image"] && "on" !== _parallax;

    if (is_bg_image_active) {
        // Background Size
        let _bg_size = props[opt_name + "_bg_size"];
        if (_bg_size) {
            _bg_style += `background-size:${_bg_size} !important;`;
        }

        // Background Position
        let _bg_position = props[opt_name + "_bg_position"];
        if (_bg_position) {
            _bg_position = _bg_position.split("_").join(" ");
            _bg_style += `background-position:${_bg_position} !important;`;
        }

        // Background Repeat
        let _bg_repeat = props[opt_name + "_bg_repeat"];
        if (_bg_repeat) {
            _bg_style += `background-repeat:${_bg_repeat} !important;`;
        }

        // Background Blend Mode
        let _bg_blend = props[opt_name + "_bg_blend"];
        if (_bg_blend) {
            _bg_style += `background-blend-mode:${_bg_blend} !important;`;
        }

        if (_bg_image && _bg_image.length > 0) {
            let _bg_image_url = `url(${_bg_image})`;
            _bg_images.push(_bg_image_url);
        }
    }

    // if (_bg_images !== "") {
    //   if ("on" !== _bg_gradient_overlays_image) {
    // 	_bg_images = _bg_images.reverse();
    //   }
    //   _bg_style += `background-image:${_bg_images.join(", ")} !important;`;
    // }

    if (_bg_images !== "") {
        // The browsers stack the images in the opposite order to what you'd expect.
        if ("on" !== _bg_gradient_overlays_image) {
            _bg_images = _bg_images.reverse();
        }

        if (_bg_images && _bg_images.length > 0) {
            // Set background image styles only it's different compared to the larger device.
            _bg_style += `background-image:${_bg_images.join(
                ", "
            )} !important;`;
        }
    }

    if (!has_bg_color_gradient) {
        let _bg_output = props[opt_name + "_bg_color"]
            ? props[opt_name + "_bg_color"]
            : default_color;
        // The background color
        if (typeof props[opt_name + "_bg_color"] !== "undefined") {
            _bg_style += `background-color: ${_bg_output} !important;`;
        }
    }

    if (_bg_style.length > 0) {
        additionalCss.push([
            {
                selector: selector,
                declaration: `${_bg_style}`
            }
        ]);
    }

    // hover
    let _bg_style_hover = "";
    let _bg_images_hover = [];
    let _hover_enabled = props[opt_name + "_bg_color__hover_enabled"];
    let has_bg_color_gradient_hover = false;

    _hover_enabled = _hover_enabled ? _hover_enabled.startsWith("on") : false;

    if (_hover_enabled) {
        // A. Background Gradient.
        let use_background_color_gradient_hover =
            props[opt_name + "_bg_use_color_gradient__hover"] || "off";
        let _bg_gradient_overlays_image_hover =
            props[opt_name + "_bg_color_gradient_overlays_image__hover"] ||
            "off";

        if (
            "on" === use_background_color_gradient_hover ||
            props[opt_name + "_bg_color_gradient_start__hover"]
        ) {
            let _bg_gradient_type_hover =
                props[opt_name + "_bg_color_gradient_type__hover"] || "linear";
            let _bg_gradient_direction_hover =
                props[opt_name + "_bg_color_gradient_direction__hover"] ||
                "180deg";
            let _bg_gradient_radial_direction_hover =
                props[
                    opt_name + "_bg_color_gradient_direction_radial__hover"
                ] || "circle";
            let _bg_gradient_color_start_hover =
                props[opt_name + "_bg_color_gradient_start__hover"] ||
                "#2b87da";
            let _bg_gradient_color_end_hover =
                props[opt_name + "_bg_color_gradient_end__hover"] || "#29c4a9";
            let _bg_gradient_start_position_hover =
                props[opt_name + "_bg_color_gradient_start_position__hover"] ||
                "0%";
            let _bg_gradient_end_position_hover =
                props[opt_name + "_bg_color_gradient_end_position__hover"] ||
                "100%";

            _bg_gradient_direction_hover =
                _bg_gradient_type_hover === "linear"
                    ? _bg_gradient_direction_hover
                    : `circle at ${_bg_gradient_radial_direction_hover}`;

            let _bg_gradient_css_hover = `${_bg_gradient_type_hover}-gradient( ${_bg_gradient_direction_hover}, ${_bg_gradient_color_start_hover} ${_bg_gradient_start_position_hover}, ${_bg_gradient_color_end_hover} ${_bg_gradient_end_position_hover} )`;
            _bg_images_hover.push(_bg_gradient_css_hover);
            has_bg_color_gradient_hover = true;
        }

        // Image Hover
        let _bg_image_hover = props[opt_name + "_bg_image__hover"] || "";
        let _parallax_hover = props[opt_name + "_bg_parallax__hover"] || "";
        let is_bg_image_active_hover =
            "" !== props[opt_name + "_bg_image__hover"] &&
            "on" !== _parallax_hover;

        if (is_bg_image_active_hover) {
            // Background Size Hover
            let _bg_size_hover = props[opt_name + "_bg_size__hover"];
            if (_bg_size_hover) {
                _bg_style_hover += `background-size:${_bg_size_hover} !important;`;
            }

            // Background Position Hover
            let _bg_position_hover = props[opt_name + "_bg_position__hover"];
            if (_bg_position_hover) {
                _bg_position_hover = _bg_position_hover.split("_").join(" ");
                _bg_style_hover += `background-position:${_bg_position_hover} !important;`;
            }

            // Background Repeat Hover
            let _bg_repeat_hover = props[opt_name + "_bg_repeat__hover"];
            if (_bg_repeat_hover) {
                _bg_style_hover += `background-repeat:${_bg_repeat_hover} !important;`;
            }

            // Background Blend Mode Hover
            let _bg_blend_hover = props[opt_name + "_bg_blend__hover"];
            if (_bg_blend_hover) {
                _bg_style_hover += `background-blend-mode:${_bg_blend_hover} !important;`;
            }

            let _bg_image_url_hover = `url(${_bg_image_hover})`;

            _bg_images_hover.push(_bg_image_url_hover);
        }

        if (_bg_images_hover !== "") {
            if ("on" !== _bg_gradient_overlays_image_hover) {
                _bg_images_hover = _bg_images_hover.reverse();
            }
            _bg_style_hover += `background-image:${_bg_images_hover.join(
                ", "
            )} !important;`;
        }

        if (_bg_images_hover !== "") {
            // The browsers stack the images in the opposite order to what you'd expect.
            if ("on" !== _bg_gradient_overlays_image_hover) {
                _bg_images_hover = _bg_images_hover.reverse();
            }
            // Set background image styles only it's different compared to the larger device.
            _bg_style_hover += `background-image: ${_bg_images_hover.join(
                ", "
            )} !important;`;
        }

        if (!has_bg_color_gradient_hover) {
            // The background color
            if (typeof props[opt_name + "_bg_color__hover"] !== "undefined") {
                _bg_style_hover += `background-color: ${
                    props[opt_name + "_bg_color__hover"]
                } !important;`;
            }
        }

        if (props.hover_enabled === 1) {
            additionalCss.push([
                {
                    selector: selector,
                    declaration: `${_bg_style_hover}`
                }
            ]);
        }

        additionalCss.push([
            {
                selector: hover_selector,
                declaration: `${_bg_style_hover}`
            }
        ]);
    }

    return additionalCss;
};

export const _isPhotoUploaded = (props, opt_name) => {
    let mobile_opts = props[opt_name + "_last_edited"].split("|")[0],
        hover_opt = props[opt_name + "__hover_enabled"].split("|")[0],
        is_uploaded = false;

    if (hover_opt === "on") {
        if (props[opt_name + "__hover"]) {
            is_uploaded = true;
        }
    }

    if (mobile_opts === "on") {
        if (props[opt_name]) {
            is_uploaded = true;
        }

        if (props[opt_name + "_tablet"]) {
            is_uploaded = true;
        }

        if (props[opt_name + "_phone"]) {
            is_uploaded = true;
        }
    }

    return is_uploaded;
};

export const _getCarouselSettings = (props, type) => {
    let content_length = 0,
        slide_count = props.slide_count,
        slide_count_tablet = props.slide_count_tablet
            ? props.slide_count_tablet
            : slide_count,
        slide_count_phone = props.slide_count_phone
            ? props.slide_count_phone
            : slide_count_tablet,
        is_swipe = props.is_swipe,
        is_swipe_tablet = props.is_swipe_tablet
            ? props.is_swipe_tablet
            : is_swipe,
        is_swipe_phone = props.is_swipe_phone
            ? props.is_swipe_phone
            : is_swipe_tablet,
        is_nav = props.use_nav === "on" ? true : false,
        is_nav_tablet = props.use_nav_tablet
            ? props.use_nav_tablet === "on"
                ? true
                : false
            : is_nav,
        is_nav_phone = props.use_nav_phone
            ? props.use_nav_phone === "on"
                ? true
                : false
            : is_nav_tablet,
        is_pagi = props.use_pagi === "on" ? true : false,
        is_pagi_tablet = props.use_pagi_tablet
            ? props.use_pagi_tablet === "on"
                ? true
                : false
            : is_pagi,
        is_pagi_phone = props.use_pagi_phone
            ? props.use_pagi_phone === "on"
                ? true
                : false
            : is_pagi_tablet,
        center_mode_type = props.center_mode_type,
        css_transition = props.css_transition,
        center_padding = props.center_padding,
        center_padding_tablet = props.center_padding_tablet,
        center_padding_phone = props.center_padding_phone,
        is_variable_width = props.is_variable_width,
        slide_to_scroll = props.slide_to_scroll,
        slide_to_scroll_tablet = props.slide_to_scroll_tablet,
        slide_to_scroll_phone = props.slide_to_scroll_phone,
        slide_infinite = null,
        slide_infinite_tablet = null,
        slide_infinite_phone = null;

    // Center Mode Responsive
    if (!center_padding_tablet) {
        center_padding_tablet = center_padding;
    }

    if (!center_padding_phone) {
        center_padding_phone = center_padding_tablet;
    }

    // Center Mode Responsive
    if (!slide_to_scroll_tablet) {
        slide_to_scroll_tablet = slide_to_scroll;
    }

    if (!slide_to_scroll_phone) {
        slide_to_scroll_phone = slide_to_scroll_tablet;
    }

    //fixing slide infinite issue
    if (type !== "jQuery") {
        content_length = props.content.length;
        slide_infinite =
            content_length >= slide_count && props.is_infinite === "on"
                ? true
                : false;
        slide_infinite_tablet =
            content_length >= slide_count_tablet && props.is_infinite === "on"
                ? true
                : false;
        slide_infinite_phone =
            content_length >= slide_count_phone && props.is_infinite === "on"
                ? true
                : false;
    } else {
        slide_infinite = props.is_infinite === "on" ? true : false;
        slide_infinite_tablet = slide_infinite;
        slide_infinite_phone = slide_infinite;
    }

    // variable width won't work for multiple slides
    if (is_variable_width === "on") {
        slide_count = 1;
        slide_count_tablet = 1;
        slide_count_phone = 1;
    }

    // global carousel settings
    let settings = {
        dots: is_pagi,
        arrows: is_nav,
        cssEase: css_transition,
        waitForAnimate: true,
        swipe: is_swipe === "on" ? true : false,
        infinite: slide_infinite,
        autoplay: props.is_autoplay === "on" ? true : false,
        autoplaySpeed: parseInt(props.autoplay_speed),
        speed: parseInt(props.animation_speed),
        slidesToShow: parseInt(slide_count),
        variableWidth: is_variable_width === "on" ? true : false,
        slidesToScroll: parseInt(slide_to_scroll),
        centerMode: props.is_center === "on" ? true : false,
        centerPadding:
            is_variable_width === "off" && center_mode_type === "classic"
                ? center_padding
                : 0,
        vertical: props.is_vertical === "on" ? true : false,

        responsive: [
            {
                breakpoint: 980,
                settings: {
                    slidesToShow: parseInt(slide_count_tablet),
                    dots: is_pagi_tablet,
                    arrows: is_nav_tablet,
                    infinite: slide_infinite_tablet,
                    swipe: is_swipe_tablet === "on" ? true : false,
                    centerPadding:
                        is_variable_width === "off" &&
                        center_mode_type === "classic"
                            ? center_padding_tablet
                            : 0,
                    slidesToScroll: parseInt(slide_to_scroll_tablet)
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: parseInt(slide_count_phone),
                    dots: is_pagi_phone,
                    arrows: is_nav_phone,
                    swipe: is_swipe_phone === "on" ? true : false,
                    infinite: slide_infinite_phone,
                    centerPadding:
                        is_variable_width === "off" &&
                        center_mode_type === "classic"
                            ? center_padding_phone
                            : 0,
                    slidesToScroll: parseInt(slide_to_scroll_phone)
                }
            }
        ]
    };

    return settings;
};

export const _getCarouselCss = props => {
    const additionalCss = [];

    let nav_height = props.nav_height,
        nav_height_tablet = props.nav_height_tablet
            ? props.nav_height_tablet
            : nav_height,
        nav_height_phone = props.nav_height_phone
            ? props.nav_height_phone
            : nav_height_tablet,
        nav_width = props.nav_width,
        nav_width_tablet = props.nav_width_tablet
            ? props.nav_width_tablet
            : nav_width,
        nav_width_phone = props.nav_width_phone
            ? props.nav_width_phone
            : nav_width_tablet,
        nav_color = props.nav_color,
        nav_color__hover = props.nav_color__hover
            ? props.nav_color__hover
            : nav_color,
        nav_bg = props.nav_bg,
        nav_bg__hover = props.nav_bg__hover ? props.nav_bg__hover : nav_bg,
        nav_icon_size = props.nav_icon_size,
        nav_icon_size_tablet = props.nav_icon_size_tablet
            ? props.nav_icon_size_tablet
            : nav_icon_size,
        nav_icon_size_phone = props.nav_icon_size_phone
            ? props.nav_icon_size_phone
            : nav_icon_size_tablet,
        icon_right = props.icon_right,
        icon_left = props.icon_left,
        nav_border_width = props.nav_border_width,
        nav_border_color = props.nav_border_color,
        nav_border_color__hover = props.nav_border_color__hover
            ? props.nav_border_color__hover
            : nav_border_color,
        nav_border_style = props.nav_border_style,
        nav_pos_y = props.nav_pos_y,
        nav_pos_y_tablet = props.nav_pos_y_tablet
            ? props.nav_pos_y_tablet
            : nav_pos_y,
        nav_pos_y_phone = props.nav_pos_y_phone
            ? props.nav_pos_y_phone
            : nav_pos_y_tablet,
        nav_x_center = props.nav_x_center,
        nav_pos_x = props.nav_pos_x,
        nav_pos_x_tablet = props.nav_pos_x_tablet
            ? props.nav_pos_x_tablet
            : nav_pos_x,
        nav_pos_x_phone = props.nav_pos_x_phone
            ? props.nav_pos_x_phone
            : nav_pos_x_tablet,
        nav_type = props.nav_type,
        nav_pos = props.nav_pos,
        nav_pos_hz = props.nav_pos_hz,
        nav_gap = props.nav_gap,
        nav_gap_tablet = props.nav_gap_tablet ? props.nav_gap_tablet : nav_gap,
        nav_gap_phone = props.nav_gap_phone
            ? props.nav_gap_phone
            : nav_gap_tablet,
        nav_skew = props.nav_skew,
        int_skew = parseInt(nav_skew),
        nav_skew_inner =
            int_skew < 0 ? `${Math.abs(int_skew)}` : `-${Math.abs(int_skew)}`,
        pagi_alignment = props.pagi_alignment,
        pagi_bg = props.pagi_bg,
        pagi_bg__hover = props.pagi_bg__hover ? props.pagi_bg__hover : pagi_bg,
        pagi_pos_y = props.pagi_pos_y,
        pagi_spacing = props.pagi_spacing,
        pagi_bg_active = props.pagi_bg_active,
        pagi_height = props.pagi_height,
        pagi_width = props.pagi_width,
        pagi_radius = props.pagi_radius.split("|"),
        pagi_width_active = props.pagi_width_active,
        pagi_text_active = props.pagi_text_active,
        pagi_type = props.pagi_type,
        pagi_text = props.pagi_text,
        pagi_color = props.pagi_color,
        pagi_color__hover = props.pagi_color__hover,
        left_border_radius = props.left_border_radius.split("|"),
        right_border_radius = props.right_border_radius.split("|"),
        slide_spacing = props.slide_spacing,
        use_both_side_spacing = props.use_both_side_spacing,
        is_vertical = props.is_vertical,
        is_variable_width = props.is_variable_width,
        slide_width = props.slide_width,
        slide_width_tablet = props.slide_width_tablet,
        slide_width_phone = props.slide_width_phone,
        slide_width_responsive_status =
            props.slide_width_last_edited &&
            props.slide_width_last_edited.startsWith("on"),
        animation_speed = props.animation_speed,
        custom_cursor = props.custom_cursor,
        cursor_name = props.cursor_name,
        carousel_spacing_top = props.carousel_spacing_top,
        carousel_spacing_top_tablet = props.carousel_spacing_top_tablet,
        carousel_spacing_top_phone = props.carousel_spacing_top_phone,
        carousel_spacing_top_responsive_status =
            props.carousel_spacing_top_last_edited &&
            props.carousel_spacing_top_last_edited.startsWith("on"),
        carousel_spacing_bottom = props.carousel_spacing_bottom,
        carousel_spacing_bottom_tablet = props.carousel_spacing_bottom_tablet,
        carousel_spacing_bottom_phone = props.carousel_spacing_bottom_phone,
        carousel_spacing_bottom_responsive_status =
            props.carousel_spacing_bottom_last_edited &&
            props.carousel_spacing_bottom_last_edited.startsWith("on");

    const utils = window.ET_Builder.API.Utils,
        rightIcon = icon_right ? utils.processFontIcon(icon_right) : "",
        leftIcon = icon_left ? utils.processFontIcon(icon_left) : "";
    let leftIconStyle = renderFontStyle(
        props,
        "icon_left",
        "%%order_class%% .dtq-carousel .slick-prev:before"
    );
    let rightIconStyle = renderFontStyle(
        props,
        "icon_right",
        "%%order_class%% .dtq-carousel .slick-next:before"
    );
    let cursor_data = {
        pizza:
            "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgBAMAAACBVGfHAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAIVBMVEUAAAAAAAD/////zGb/mTOZAAAAzAD/zDP/AAD/Zmb/mZm5WRymAAAAAXRSTlMAQObYZgAAAAFiS0dEAmYLfGQAAAAJcEhZcwAAAMgAAADIAGP6560AAAAHdElNRQfkBRkTCRh4PlpnAAAA8ElEQVQoz12QsbnDIAyExQaWQ0ySztngfW8BMgIFA3gEVardEXfu3KbzmJEgTrCvEfo5wQEgABjMakDVNgZP/1l/GbX9p81ISHuvgJL23tfgIUAs5VCxWgWyjKoQ8GRlpO2lwXOM3TkG9IACAkoTg7pKKsc6hWKzGg1ZhVKohHVMGUkhr8Bw57Kjc5RfA0626Jmk2A9g7m7LNDL6AsRNlynNNJQezOL4ktK4TQDcRr5OMtJswMxMaXXkv2BkJ3kJvkIamAb7A441mv8Bo+9AqIR8fdoadJjWpgaGltnvwfqCnXB/hH6kPwCCg+wRbJe+ATasSMvHEwtpAAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDIwLTA1LTI1VDE5OjA5OjIzKzAwOjAwCTF7LQAAACV0RVh0ZGF0ZTptb2RpZnkAMjAyMC0wNS0yNVQxOTowOTowNiswMDowMGhx60sAAAAASUVORK5CYII=",
        burger:
            "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB8AAAAfBAMAAADtgAsKAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAALVBMVEUAAAAAAAD////MZgBmMwCZMwD/zDP/mQD/zAB4eHhGRkbc3NygoKDIyMhmAAAKaD9VAAAAAXRSTlMAQObYZgAAAAFiS0dEAmYLfGQAAAAJcEhZcwAAAMgAAADIAGP6560AAAAHdElNRQfkBRkTGhFgDaNRAAAAEGNhTnYAAAAgAAAAIAAAAAAAAAAAYrnu+gAAATdJREFUKM9lkbFOwzAQhl2lM4qrLLW68AYgG2VtlIu6sVTxCzCwA5XzACCydmyUpWNNl670CVLyBkxImXkG7i6oSOFXlv+7/85nR4RiIDkEk2FkcvkPUCSA9DyDvMlyDVc9CKmca9Q5FMAS7c2dNr/ELNmiDHcFmdaWPms1R0zOVa1j98gRwCp1xKt7R4A60FlnnXugnnGK3pFs8doDi92OAiVPHWd4JvmyLDWBEa0Vk33Bydd4l4j3cCs63ExDIbfAq7OSdwQ7GQHkdD0jpwqBqrYSSImsP99CMVLN2kvS7ORnByEupG/aTdWu1/VOHSMEX1Ltvd+3zWnzcQAEt1IqX3tfHb2MDIKuS3iEwtkLTIhvMMAkguJpLiiSaj52UZTAb9oBb+ncM8z7Vx4DvwnA3+/jlr78AzvMazraOl3vAAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDIwLTA1LTI1VDE5OjI2OjE2KzAwOjAwfOGxJQAAACV0RVh0ZGF0ZTptb2RpZnkAMjAyMC0wNS0yNVQxOToyNjoxNiswMDowMA28CZkAAAAASUVORK5CYII="
    };

    // center mode animation speed
    additionalCss.push([
        {
            selector: "%%order_class%% .dtq-centered--highlighted .slick-slide",
            declaration: `transition: transform ${animation_speed};`
        }
    ]);

    // Custom Cursor
    if (custom_cursor === "on") {
        let cursor_type = cursor_name.split("_")[0];
        let cursor_icon = cursor_name.split("_")[1];

        if (cursor_type === "css") {
            additionalCss.push([
                {
                    selector: "%%order_class%%",
                    declaration: `cursor: ${cursor_icon}!important;`
                }
            ]);
        } else if (cursor_type === "custom") {
            additionalCss.push([
                {
                    selector: "%%order_class%%",
                    declaration: `cursor: url('${cursor_data[cursor_icon]}'), auto!important;`
                }
            ]);
        }
    }

    // Carousel Spacing Top - Bottom
    additionalCss.push([
        {
            selector: "%%order_class%% .dtq-carousel .slick-track",
            declaration: `padding-top: ${carousel_spacing_top}; padding-bottom: ${carousel_spacing_bottom};`
        }
    ]);

    // Carousel Spacing Top Tablet
    if (carousel_spacing_top_tablet && carousel_spacing_top_responsive_status) {
        additionalCss.push([
            {
                selector: "%%order_class%% .dtq-carousel .slick-track",
                device: "tablet",
                declaration: `padding-top: ${carousel_spacing_top_tablet};`
            }
        ]);
    }

    // Carousel Spacing Top Phone
    if (carousel_spacing_top_phone && carousel_spacing_top_responsive_status) {
        additionalCss.push([
            {
                selector: "%%order_class%% .dtq-carousel .slick-track",
                device: "phone",
                declaration: `padding-top: ${carousel_spacing_top_phone};`
            }
        ]);
    }

    // Carousel Spacing Bottom Tablet
    if (
        carousel_spacing_bottom_tablet &&
        carousel_spacing_bottom_responsive_status
    ) {
        additionalCss.push([
            {
                selector: "%%order_class%% .dtq-carousel .slick-track",
                device: "tablet",
                declaration: `padding-bottom: ${carousel_spacing_bottom_tablet};`
            }
        ]);
    }

    // Carousel Spacing Bottom Phone
    if (
        carousel_spacing_bottom_phone &&
        carousel_spacing_bottom_responsive_status
    ) {
        additionalCss.push([
            {
                selector: "%%order_class%% .dtq-carousel .slick-track",
                device: "phone",
                declaration: `padding-bottom: ${carousel_spacing_bottom_phone};`
            }
        ]);
    }

    // Slide Variable Width
    if (is_variable_width === "on") {
        additionalCss.push([
            {
                selector: "%%order_class%% .dtq-carousel .slick-slide",
                declaration: `width: ${slide_width};`
            }
        ]);

        // Slide Variable Width Tablet
        if (slide_width_tablet && slide_width_responsive_status) {
            additionalCss.push([
                {
                    selector: "%%order_class%% .dtq-carousel .slick-slide",
                    device: "tablet",
                    declaration: `width: ${slide_width_tablet};`
                }
            ]);
        }

        // Slide Variable Width Phone
        if (slide_width_phone && slide_width_responsive_status) {
            additionalCss.push([
                {
                    selector: "%%order_class%% .dtq-carousel .slick-slide",
                    device: "phone",
                    declaration: `width: ${slide_width_phone};`
                }
            ]);
        }
    }

    // Arrow
    additionalCss.push([
        {
            selector: "%%order_class%% .dtq-carousel .slick-arrow",
            declaration: `
				  height: ${nav_height};
				  width: ${nav_width};
				  color: ${nav_color};
				  background: ${nav_bg};
				  border: ${nav_border_width} ${nav_border_style} ${nav_border_color};
				  margin-top: -${parseInt(nav_height) / 2}px;
				  transform: skew(${nav_skew});`
        }
    ]);

    additionalCss.push([
        {
            selector: "%%order_class%% .dtq-carousel .slick-arrow:before",
            declaration: `
				  font-size: ${nav_icon_size};
				  transform: skew(${nav_skew_inner}deg);
				  display: inline-block;`
        }
    ]);

    additionalCss.push([
        {
            selector: "%%order_class%% .dtq-carousel .slick-next",
            declaration: `
				  border-radius: ${right_border_radius[1]} ${right_border_radius[2]} ${right_border_radius[3]} ${right_border_radius[4]};`
        }
    ]);

    additionalCss.push([
        {
            selector: "%%order_class%% .dtq-carousel .slick-prev",
            declaration: `
				  border-radius: ${left_border_radius[1]} ${left_border_radius[2]} ${left_border_radius[3]} ${left_border_radius[4]};`
        }
    ]);

    // nav tablet
    additionalCss.push([
        {
            selector: "%%order_class%% .dtq-carousel .slick-arrow",
            device: "tablet",
            declaration: `height: ${nav_height_tablet}; width: ${nav_width_tablet};`
        }
    ]);

    additionalCss.push([
        {
            selector: "%%order_class%% .dtq-carousel .slick-arrow:before",
            device: "tablet",
            declaration: `font-size: ${nav_icon_size_tablet};`
        }
    ]);

    //nav phone
    additionalCss.push([
        {
            selector: "%%order_class%% .dtq-carousel .slick-arrow",
            device: "phone",
            declaration: `height: ${nav_height_phone}; width: ${nav_width_phone};`
        }
    ]);

    additionalCss.push([
        {
            selector: "%%order_class%% .dtq-carousel .slick-arrow:before",
            device: "phone",
            declaration: `font-size: ${nav_icon_size_phone};`
        }
    ]);

    //nav hover
    additionalCss.push([
        {
            selector: "%%order_class%% .dtq-carousel .slick-arrow:hover",
            declaration: ` color: ${nav_color__hover}; background: ${nav_bg__hover}; border-color: ${nav_border_color__hover};`
        }
    ]);

    // nav type
    if (nav_type === "default") {
        // default nav type
        additionalCss.push([
            {
                selector: "%%order_class%% .dtq-carousel .slick-arrow",
                declaration: `top: ${nav_pos_y};`
            }
        ]);

        additionalCss.push([
            {
                selector: "%%order_class%% .dtq-carousel .slick-next",
                declaration: `right: ${nav_pos_x};`
            }
        ]);

        additionalCss.push([
            {
                selector: "%%order_class%% .slick-prev",
                declaration: `left: ${nav_pos_x};`
            }
        ]);

        // default nav tablet
        additionalCss.push([
            {
                selector: "%%order_class%% .dtq-carousel .slick-arrow",
                device: "tablet",
                declaration: `top: ${nav_pos_y_tablet};`
            }
        ]);

        additionalCss.push([
            {
                selector: "%%order_class%% .dtq-carousel .slick-next",
                device: "tablet",
                declaration: `right: ${nav_pos_x_tablet};`
            }
        ]);

        additionalCss.push([
            {
                selector: "%%order_class%% .dtq-carousel .slick-prev",
                device: "tablet",
                declaration: `left: ${nav_pos_x_tablet};`
            }
        ]);

        // default nav phone
        additionalCss.push([
            {
                selector: "%%order_class%% .dtq-carousel .slick-arrow",
                device: "phone",
                declaration: `top: ${nav_pos_y_phone};`
            }
        ]);

        additionalCss.push([
            {
                selector: "%%order_class%% .dtq-carousel .slick-next",
                device: "phone",
                declaration: `right: ${nav_pos_x_phone};`
            }
        ]);

        additionalCss.push([
            {
                selector: "%%order_class%% .dtq-carousel .slick-prev",
                device: "phone",
                declaration: `left: ${nav_pos_x_phone};`
            }
        ]);
    }

    // alongside nav type
    else if (nav_type === "alongside") {
        additionalCss.push([
            {
                selector: "%%order_class%% .dtq-carousel .slick-arrow",
                declaration: `top: auto; ${nav_pos}: ${nav_pos_y};`
            }
        ]);

        if (nav_x_center && nav_x_center === "on") {
            //desktop
            additionalCss.push([
                {
                    selector: "%%order_class%% .dtq-carousel .slick-next",
                    declaration: `right: calc(50% - ${parseInt(nav_width) +
                        parseInt(nav_gap) / 2}px);`
                }
            ]);

            additionalCss.push([
                {
                    selector: "%%order_class%% .dtq-carousel .slick-prev",
                    declaration: `left: calc(50% - ${parseInt(nav_width) +
                        parseInt(nav_gap) / 2}px);`
                }
            ]);

            // tablet
            additionalCss.push([
                {
                    selector: "%%order_class%% .dtq-carousel .slick-next",
                    device: "tablet",
                    declaration: `right: calc(50% - ${parseInt(
                        nav_width_tablet
                    ) +
                        parseInt(nav_gap_tablet) / 2}px);`
                }
            ]);

            additionalCss.push([
                {
                    selector: "%%order_class%% .dtq-carousel .slick-prev",
                    device: "tablet",
                    declaration: `left: calc(50% - ${parseInt(
                        nav_width_tablet
                    ) +
                        parseInt(nav_gap_tablet) / 2}px);`
                }
            ]);

            // phone
            additionalCss.push([
                {
                    selector: "%%order_class%% .dtq-carousel .slick-next",
                    device: "phone",
                    declaration: `right: calc(50% - ${parseInt(
                        nav_width_phone
                    ) +
                        parseInt(nav_gap_phone) / 2}px);`
                }
            ]);

            additionalCss.push([
                {
                    selector: "%%order_class%% .dtq-carousel .slick-prev",
                    device: "phone",
                    declaration: `left: calc(50% - ${parseInt(nav_width_phone) +
                        parseInt(nav_gap_phone) / 2}px);`
                }
            ]);
        } else {
            // position X
            additionalCss.push([
                {
                    selector: "%%order_class%% .dtq-carousel .slick-next",
                    declaration: `${nav_pos_hz}: ${nav_pos_x};`
                }
            ]);

            additionalCss.push([
                {
                    selector: "%%order_class%% .dtq-carousel .slick-prev",
                    declaration: `left: auto; ${nav_pos_hz}: ${nav_pos_x};`
                }
            ]);

            // position X tablet
            additionalCss.push([
                {
                    selector: "%%order_class%% .dtq-carousel .slick-next",
                    device: "tablet",
                    declaration: `${nav_pos_hz}: ${nav_pos_x_tablet};`
                }
            ]);

            additionalCss.push([
                {
                    selector: "%%order_class%% .dtq-carousel .slick-prev",
                    device: "tablet",
                    declaration: `left: auto; ${nav_pos_hz}: ${nav_pos_x_tablet};`
                }
            ]);

            // position X phone
            additionalCss.push([
                {
                    selector: "%%order_class%% .dtq-carousel .slick-next",
                    device: "phone",
                    declaration: `${nav_pos_hz}: ${nav_pos_x_phone};`
                }
            ]);

            additionalCss.push([
                {
                    selector: "%%order_class%% .dtq-carousel .slick-prev",
                    device: "phone",
                    declaration: `left: auto; ${nav_pos_hz}: ${nav_pos_x_phone};`
                }
            ]);

            // nav gap
            additionalCss.push([
                {
                    selector: "%%order_class%% .dtq-carousel .slick-prev",
                    declaration: `margin-${nav_pos_hz}: calc(${nav_width} + ${nav_gap});`
                }
            ]);

            // nav gap tablet
            additionalCss.push([
                {
                    selector: "%%order_class%% .dtq-carousel .slick-prev",
                    device: "tablet",
                    declaration: `margin-${nav_pos_hz}: calc(${nav_width_tablet} + ${nav_gap_tablet});`
                }
            ]);

            // nav gap phone
            additionalCss.push([
                {
                    selector: "%%order_class%% .dtq-carousel .slick-prev",
                    device: "phone",
                    declaration: `margin-${nav_pos_hz}: calc(${nav_width_phone} + ${nav_gap_phone});`
                }
            ]);
        }

        // position Y tablet
        additionalCss.push([
            {
                selector: "%%order_class%% .dtq-carousel .slick-arrow",
                device: "tablet",
                declaration: `top: auto;${nav_pos}: ${nav_pos_y_tablet};`
            }
        ]);

        // position Y phone
        additionalCss.push([
            {
                selector: "%%order_class%% .dtq-carousel .slick-arrow",
                device: "phone",
                declaration: `top: auto; ${nav_pos}: ${nav_pos_y_phone};`
            }
        ]);
    }

    // nav custom icon
    additionalCss.push([
        {
            selector: "%%order_class%% .dtq-carousel .slick-next:before",
            declaration: `content: "${rightIcon}";`
        }
    ]);

    additionalCss.push([
        {
            selector: "%%order_class%% .dtq-carousel .slick-prev:before",
            declaration: `content:" ${leftIcon}";`
        }
    ]);

    // slide spacing
    if (is_vertical === "off") {
        additionalCss.push([
            {
                selector:
                    "%%order_class%% .dtq-carousel .slick-slide, .et-db #et-boc %%order_class%% .dtq-carousel .slick-slide",
                declaration: `padding-left: ${slide_spacing}; padding-right: ${slide_spacing};`
            }
        ]);

        if (use_both_side_spacing === "off") {
            additionalCss.push([
                {
                    selector:
                        "%%order_class%% .dtq-carousel .slick-list, .et-db #et-boc %%order_class%% .dtq-carousel .slick-list",
                    declaration: `margin-left: -${slide_spacing}!important; margin-right: -${slide_spacing}!important;`
                }
            ]);
        }
    } else {
        additionalCss.push([
            {
                selector:
                    "%%order_class%% .dtq-carousel .slick-slide, .et-db #et-boc %%order_class%% .dtq-carousel .slick-slide",
                declaration: `padding-top: ${slide_spacing}!important; padding-bottom: ${slide_spacing}!important;`
            }
        ]);

        if (use_both_side_spacing === "off") {
            additionalCss.push([
                {
                    selector:
                        "%%order_class%% .dtq-carousel .slick-list, .et-db #et-boc %%order_class%% .dtq-carousel .slick-list",
                    declaration: `margin-top: -${slide_spacing}!important; margin-bottom: -${slide_spacing}!important;`
                }
            ]);
        }
    }

    // Pagination
    if (pagi_type === "dot") {
        additionalCss.push([
            {
                selector: "%%order_class%% .dtq-carousel .slick-dots li button",
                declaration: "font-size: 0!important;"
            }
        ]);
    } else if (pagi_type === "number") {
        additionalCss.push([
            {
                selector: "%%order_class%% .dtq-carousel .slick-dots li button",
                declaration: `font-size: ${pagi_text}!important; color: ${pagi_color};`
            }
        ]);
        if (pagi_color__hover) {
            additionalCss.push([
                {
                    selector:
                        "%%order_class%% .dtq-carousel .slick-dots li:hover button",
                    declaration: `color: ${pagi_color__hover};`
                }
            ]);
        }
    }

    additionalCss.push([
        {
            selector: "%%order_class%% .dtq-carousel .slick-dots",
            declaration: `text-align: ${pagi_alignment}; transform: translateY(${pagi_pos_y});`
        }
    ]);

    additionalCss.push([
        {
            selector: "%%order_class%% .dtq-carousel .slick-dots li",
            declaration: `margin: 0 ${pagi_spacing};`
        }
    ]);

    additionalCss.push([
        {
            selector: "%%order_class%% .dtq-carousel .slick-dots li button",
            declaration: `
				  background: ${pagi_bg};
				  height: ${pagi_height};
				  width: ${pagi_width};
				  border-radius: ${pagi_radius[1]} ${pagi_radius[2]} ${pagi_radius[3]} ${pagi_radius[4]};`
        }
    ]);

    if (pagi_bg__hover) {
        additionalCss.push([
            {
                selector:
                    "%%order_class%% .dtq-carousel .slick-dots li:hover button",
                declaration: `background: ${pagi_bg__hover};`
            }
        ]);
    }

    if (pagi_bg_active) {
        additionalCss.push([
            {
                selector:
                    "%%order_class%% .dtq-carousel .slick-dots li.slick-active button",
                declaration: `background: ${pagi_bg_active};`
            }
        ]);
    }

    if (pagi_width_active) {
        additionalCss.push([
            {
                selector:
                    "%%order_class%% .dtq-carousel .slick-dots li.slick-active button",
                declaration: `width: ${pagi_width_active};`
            }
        ]);
    }

    if (pagi_text_active) {
        additionalCss.push([
            {
                selector:
                    "%%order_class%% .dtq-carousel .slick-dots li.slick-active button",
                declaration: `color: ${pagi_text_active};`
            }
        ]);
    }

    if (props.hover_enabled === 1) {
        if (pagi_color__hover) {
            additionalCss.push([
                {
                    selector:
                        "%%order_class%% .dtq-carousel .slick-dots li button",
                    declaration: `color: ${pagi_color__hover};`
                }
            ]);
        }

        if (pagi_bg__hover) {
            additionalCss.push([
                {
                    selector:
                        "%%order_class%% .dtq-carousel .slick-dots li button",
                    declaration: `background: ${pagi_bg__hover};`
                }
            ]);
        }
    }

    return additionalCss.concat(leftIconStyle).concat(rightIconStyle);
};

export const hex2rgba = (hex, alpha = 1) => {
    const [r, g, b] = hex.match(/\w\w/g).map(x => parseInt(x, 16));
    return `rgba(${r},${g},${b},${alpha})`;
};

export const get_pattern = (name, color, weight) => {
    let pattern = {
        curved: `data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' preserveAspectRatio='none' overflow='visible' height='100%' viewBox='0 0 24 24' stroke='${color}' stroke-width='${weight}' fill='none' stroke-linecap='square' stroke-miterlimit='10'%3E%3Cpath d='M0,6c6,0,6,13,12,13S18,6,24,6'/%3E%3C/svg%3E`,

        zigzag: `data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' preserveAspectRatio='none' overflow='visible' height='100%' viewBox='0 0 24 24' stroke='${color}' stroke-width='${weight}' fill='none' stroke-linecap='square' stroke-miterlimit='10'%3E%3Cpolyline points='0,18 12,6 24,18 '/%3E%3C/svg%3E`,

        square: `data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' preserveAspectRatio='none' overflow='visible' height='100%' viewBox='0 0 24 24' fill='none' stroke='${color}' stroke-width='${weight}' stroke-linecap='square' stroke-miterlimit='10'%3E%3Cpolyline points='0,6 6,6 6,18 18,18 18,6 24,6 '/%3E%3C/svg%3E`,

        curly: `data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' preserveAspectRatio='none' overflow='visible' height='100%' viewBox='0 0 24 24' fill='none' stroke='${color}' stroke-width='${weight}' stroke-linecap='square' stroke-miterlimit='10'%3E%3Cpath d='M0,21c3.3,0,8.3-0.9,15.7-7.1c6.6-5.4,4.4-9.3,2.4-10.3c-3.4-1.8-7.7,1.3-7.3,8.8C11.2,20,17.1,21,24,21'/%3E%3C/svg%3E`
    };

    return pattern[name];
};

export const renderFontStyle = (props, slug, selector) => {
    if (props[slug]) {
        let fontFamily = {
                divi: "ETmodules !important",
                fa: "FontAwesome!important"
            },
            icon = props[slug] ? props[slug].split("|") : [],
            additionalCss = [];

        additionalCss.push([
            {
                selector,
                declaration: `
                font-family: ${fontFamily[icon[2]]};
                font-weight: ${icon[4]}!important;`
            }
        ]);
        return additionalCss;
    }

    return [];
};
