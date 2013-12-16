define([],
function(){
    // module:
    //		havok/parser/config

    /*=====
    var __ParserConfig = {
        // tags: Object
        //      A mapping of custom tags to widgets.
        //      Eg: `{'modal' : 'havok/widget/Modal'}`
        //      This mapping may be expanded or overridden.
        //
        // mixins: Object
        //      A mapping of friendly mixin names to modules.
        //      Eg: `{'sortable' : 'havok/widget/_SortableMixin'}`
        //      This mapping may be expanded or overridden.
    };
    =====*/

    return {
        // summary:
        //		Default parser config
        // description:
        //      This module can be used by [havok/config/manager](../config/manager.html) to provide default parser configuration.

        // parser: __ParserConfig
        //      Parser configuration object
        parser: {
            tags: {
                'f-checkbox'           : '../form/Checkbox',
                'f-currency-textbox'   : '../form/CurrencyTextBox',
                'f-date-textbox'       : '../form/DateTextBox',
                'f-email-textbox'      : '../form/EmailTextBox',
                'f-checkbox-group'     : '../form/CheckboxGroup',
                'f-number-textbox'     : '../form/NumberTextBox',
                'f-password-textbox'   : '../form/PasswordTextBox',
                'f-radio-group'        : '../form/RadioGroup',
                'f-textbox'            : '../form/TextBox',
                'f-toggle-button'      : '../form/ToggleButton',
                'f-validation-textbox' : '../form/ValidationTextBox',

                'w-affix'              : '../widget/Affix',
                'w-accordion'          : '../widget/Accordion',
                'w-alert'              : '../widget/Alert',
                'w-button-group'       : '../widget/ButtonGroup',
                'w-date-dropdown'      : '../widget/DateDropdown',
                'w-dragable'           : '../widget/Dragable',
                'w-dropdown'           : '../widget/Dropdown',
                'w-dropdown-container' : '../widget/DropdownContainer',
                'w-dropdown-submenu'   : '../widget/DropdownSubmenu',
                'w-dropdown-toggle'    : '../widget/DropdownToggle',
                'w-carousel'           : '../widget/Carousel',
                'w-checkbox-group'     : '../widget/CheckboxGroup',
                'w-hotkey-button'      : '../widget/HotkeyButton',
                'w-modal'              : '../widget/Modal',
                'w-nav-bar'            : '../widget/NavBar',
                'w-nav-bar-links'      : '../widget/NavBarLinks',
                'w-nav-list'           : '../widget/NavList',
                'w-nav-pill'           : '../widget/NavPill',
                'w-nav-tab'            : '../widget/NavTab',
                'w-overlay'            : '../widget/Overlay',
                'w-radio-group'        : '../widget/RadioGroup',
                'w-tab-container'      : '../widget/TabContainer',
                'w-tree'               : '../widget/Tree',
                'w-toggle-button'      : '../widget/ToggleButton',
                'w-tooltip'            : '../widget/Tooltip'
            },
            mixins: {
                'affix'     : '../widget/_AffixMixin',
                'hotkey'    : '../widget/_HotkeyMixin',
                'scrollspy' : '../widget/_ScrollSpyMixin',
                'sortable'  : '../widget/_SortableMixin',
                'store'     : '../widget/_StoreMixin'
            }
        }
    }
});


