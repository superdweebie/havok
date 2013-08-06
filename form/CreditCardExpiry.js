define([
    'dojo/_base/declare',
    './ValidationGroup',
    'dojo/text!./Template/CreditCardExpiry.html',
    './Select',
    '../Validator/CreditCardExpiry'
],
function (
    declare,
    ValidationGroup,
    expiryTemplate
){
    return declare(
        [ValidationGroup],
        {
            content: expiryTemplate,

            validator: 'CreditCardExpiry',

            postCreate: function(){

                var i = new Date().getUTCFullYear(),
                    thisyear = i,
                    thismonth = new Date().getMonth() + 1,
                    limit = i + 10,
                    years = {},
                    months = {};

                //Create years - 10 years from now
                for (i; i < limit; i++){
                    years[i] = ('' + i).substr(2,2);
                }
                this.year.set('options', years);
                this.year.set('value', thisyear);

                //Create months
                for (i = 1; i < 13; i++){
                    months[i] = i < 10 ? '0' + i : '' + i;
                }
                this.month.set('options', months);
                this.month.set('value', thismonth);

                this.inherited(arguments);
            }
        }
    );
});
