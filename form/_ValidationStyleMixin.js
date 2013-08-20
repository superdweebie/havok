define([
    'dojo/_base/declare',
    'dojo/_base/array',
    'dojo/dom-class'
],
function (
    declare,
    array,
    domClass
){

    return declare(
        [],
        {

            // Indicates the classes to apply in different validation states
            validationStyle: {
                preActivity: {
                    //valid: [], //A list of classes to apply when valid
                    //invalid: [] //apply when invalid
                },
                postActivity: {
                    //valid: [], //apply when valid
                    invalid: ['error'] //apply when invalid
                }
            },

            //_appliedStyle: undefined,

            updateValidationStyle: function(){
                this.set('validationStyle', this.validationStyle);
            },

            _setValidationStyleAttr: function(value){
                if (this._started){

                    //Determine which node the style classes should be applied to
                    var styleNode;
                    if (this.styleNode && this.styleNode.domNode){ //if the styleNode is a widget
                        styleNode = this.styleNode.domNode;
                    } else if (this.styleNode){
                        styleNode = this.styleNode;
                    } else {
                        styleNode = this.domNode;
                    }

                    //Determine which style classes to apply
                    var apply;
                    if (typeof value == 'array'){
                        apply = value;
                    } else if (typeof value == 'string'){
                        apply = [value];
                    } else if (this.postActivity && this.state == ''){
                        apply = value.postActivity.valid;
                    } else if (this.postActivity && this.state != ''){
                        apply = value.postActivity.invalid;
                    } else if (!this.postActivity && this.state == ''){
                        apply = value.preActivity.valid;
                    } else if (!this.postActivity && this.state != ''){
                        apply = value.preActivity.invalid;
                    } else {
                        apply = [];
                    }

                    // remove any previously applied styles
                    array.forEach(this._appliedStyle, function(item){
                        domClass.remove(styleNode, item);
                    }, this);

                    // add the new styles
                    array.forEach(apply, function(item){
                        domClass.add(styleNode, item);
                    }, this);

                    this._appliedStyle = apply;
                }

                this._set('validationStyle', value);
            }
        }
    );
});
