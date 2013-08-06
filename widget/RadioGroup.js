define([
    'dojo/_base/declare',
    'dojo/_base/lang',
    'dojo/when',
    'dojo/dom-class',
    './ButtonGroup'
],
function (
    declare,
    lang,
    when,
    domClass,
    ButtonGroup
){
    // module:
    //    	havok/widget/RadioGroup

    return declare(
        [ButtonGroup],
        {

            _setActiveAttr: function(value){
                var id;
                if (this.store && this.store.get){
                    if (typeof value == 'object'){
                        id = value[this.store.idProperty];
                    } else {
                        id = value;
                    }
                    when(this.store.get(id), lang.hitch(this, function(item){
                        if (item === this.active){
                            return;
                        }
                        if (typeof this.active == 'object'){
                            domClass.remove(this.active.node, 'active');
                        }
                        if (item && item.node){
                            domClass.add(item.node, 'active');
                        }
                        this._set('active', item);
                    }))
                } else {
                    this._set('active', value);
                }
            }
        }
    );
});
