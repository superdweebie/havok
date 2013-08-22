define([
    'dojo/_base/declare',
    'dojo/_base/lang',
    'dojo/dom-construct',
    './_WidgetBase',
    'dojo/text!./template/DropdownBase.html',
    '../less!./less/dropdowns.less'
],
function (
    declare,
    lang,
    domConstruct,
    WidgetBase,
    template
){
    // module:
    //    	havok/widget/_DropdownBase

    return declare(
        [WidgetBase],
        {

            //This is a really basic empty dropdown.
            //

            defaultClass: 'dropdown-menu',

            templateString: template,

            buildRendering: function(){

                if (!this.srcNodeRef && this.innerHTML){
                    this.srcNodeRef = domConstruct.create(this.tag, {innerHTML: this.innerHTML});
                }
                this.inherited(arguments);
            },

            startup: function(){
                this.inherited(arguments);

                var i,
                    children = this.getChildren();
                for (i = 0; i < children.length; i++){
                    this.watchChildHasMouse(children[i]);
                }
            },

            onMouseenter: function(e){
                this.set('hasMouse', true);
                this.set('_primaryHasMouse', true);
            },

            onMouseleave: function(e){
                this.set('_primaryHasMouse', false);
                setTimeout(lang.hitch(this, function(){
                    if (!this.childHasMouse){
                        this.set('hasMouse', false);
                    }
                }), 50);
            },

            watchChildHasMouse: function(childWidget){
                childWidget.watch('hasMouse', lang.hitch(this, function(property, oldValue, newValue){
                    if (newValue){
                        this.set('childHasMouse', childWidget);
                    } else {
                        this.set('childHasMouse', false);
                    }
                    if (!newValue){
                        setTimeout(lang.hitch(this, function(){
                            if (!this._primaryHasMouse){
                                this.set('hasMouse', false);
                            }
                        }), 50);
                    }
                }));
            }
        }
    );
});