define([
    'dojo/_base/declare',
    'dojo/_base/lang',
    './_WidgetBase',
    './_WidgetsInTemplateMixin',
    'dojo/text!./template/TextEditor.html',
    './TextToolbar'
],
function (
    declare,
    lang,
    WidgetBase,
    WidgetsInTemplateMixin,
    template
){
    // module:
    //    	havok/widget/TextEditor

    return declare(
        [WidgetBase, WidgetsInTemplateMixin],
        {
            // summary:
            //      Widget to display tooltips.

            // templateString: String
            templateString: template,

            /*=====
            // _observer: MutationObserver
            //      Watches for changes to the text being edited
            _observer: undefined,
            =====*/

            buildRendering: function(){
                this.inherited(arguments);
                this._parseComplete.then(lang.hitch(this, function(){
                    this.toolbar.set('target', this.containerNode);
                }));
            },

            startup: function(){
                this.inherited(arguments);
                this._observer = new MutationObserver(lang.hitch(this, function(){
                    this._set('text', this.get('text'));
                }))
                this._observer.observe(this.containerNode, {childList: true, characterData: true, subtree: true});
            },

            _getTextAttr: function(){
                return this.containerNode.innerHTML;
            },

            _setTextAttr: function(value){
                if (value != this.containerNode.innerHTML){
                    this.containerNode.innerHTML = value;
                    this._set('text', value);
                }
            },

            destroy: function(){
                this._observer.disconnect();
                this.inherited(arguments);
            }
        }
    );
});