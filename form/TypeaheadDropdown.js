define([
    'dojo/_base/declare',
    'dojo/_base/lang',
    'dojo/string',
    'dojo/dom-construct',
    '../widget/Dropdown'
],
function (
    declare,
    lang,
    string,
    domConstruct,
    Dropdown
){
    // module:
    //    	havok/form/TypeaheadDropdown

    return declare(
        [Dropdown],
        {

            //re: undefined,

            _highlight: function(text){
                return text.replace(this.re, function($1, match){
                    return '<strong>' + $1 + '</strong>';
                });
            },

            _createLink: function(item){
                domConstruct.place(
                    '<li>' + string.substitute(this.linkTemplate, lang.mixin({href: ''}, item, {text: this._highlight(item.text)})) + '</li>',
                    this.containerNode,
                    'last'
                );
            },

            _refresh: function(data){
                //apply highlighting to already existing nodes
                for (var i = 0; i < data.length; i++){
                    if (data[i].node){
                        data[i].node.firstElementChild.innerHTML = this._highlight(data[i].text);
                    }
                }

                this.inherited(arguments);
            }
        }
    );
});
