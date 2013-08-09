define([
    'dojo/_base/declare',
    'dojo/_base/lang',
    'dojo/_base/array',
    'dojo/when',
    'dojo/Deferred',
    'dojo/dom-class',
    '../is',
    '../get!ValidatorFactory',
    'mystique/Result',
    'dijit/_FocusMixin'
],
function (
    declare,
    lang,
    array,
    when,
    Deferred,
    domClass,
    is,
    ValidatorFactory,
    Result,
    FocusMixin
){

    return declare(
        [FocusMixin],
        {
            // state: [readonly] String
            //		Shows current state (ie, validation result) of input ('' | Incomplete | Error | Validating)
            //		An empty string indicates successful validation.
            //      State will start as `Validating` until validation has executed the first time.
            state: 'Validating',

            // Indicates if the ui element has had user interaction
            // postActivity will be set to true after the first blur event or
            // after the state first changes to an invalid value
            //postActivity: undefined,

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

            // validator: an instance of mystique/Base.
            //validator: undefined,

            //Set to true to stop all validation. Set to falsey to allow validation
            //suppressValidation: undefined,

            //How long to delay validation after user input in milliseconds. Prevents validation on
            //every single keystroke.
            delay: 350,

            //_appliedStyle: undefined,

            //_onFocusValue: undefined,

            //_delayTimer: undefined,

            _setValueTimestamp: 0,

            startup: function(){
                this.inherited(arguments);

                //Set watchers
                this.watch('value', lang.hitch(this, '_triggerValidate'));
                this.watch('state', lang.hitch(this, '_updateActivityFromState'));
                this.watch('postActivity', lang.hitch(this, '_updateValidationStyle'));

                //Trigger first validation
                this.validateNow();
            },

            _updateActivityFromState: function(property, oldValue, newValue){
                //Watch the state if the state changes from valid to invalid,
                //while in focus,
                //and the value was not empty on focus,
                //then postActivity should be set to true
                if (newValue != '' &&
                    this._onFocusValue != undefined &&
                    this._onFocusValue != '' &&
                    this.get('focused')
                ){
                    this.set('postActivity', true);
                }
            },

            _updateValidationStyle: function(){
                //re-apply styles which may change postActivity
                this.set('validationStyle', this.validationStyle);
            },

            _triggerValidate: function(property, oldValue, newValue){

                if (this.suppressValidation){
                    return;
                }

                this._setValueTimestamp = new Date().getTime();
                this.set('state', 'Validating');
                this._startValidateTimer();
            },

            _setSuppressValidationAttr: function(value){
                if (this.state == 'Validating'){
                    this.set('state', '');
                }
                this._set('suppressValidation', value);
            },

            _setValidatorAttr: function(value){
                // summary:
                //     Will set the validator. May be one of three
                //     types:
                //
                //     Instance of mystique/Base - the validator property is set equal to this instance.
                //
                //     Array - if an array, it is assumed to be an array of validators, or validator definitions.
                //     The array will be passed to validatorFactory.create(). The validator property
                //     will be set to the returned instance of Validator/Group
                //
                //     Object - an an object, it is assumbed to be a validator definition.
                //     The definition will be passed to havok/validator/factory.create(). The validator property
                //     will be set to the returned instance of mytique/Base

                if (value.isValid){
                    this._set('validator', value);
                    this.validateNow();
                    return;
                }

                var validatorDeferred = new Deferred;
                validatorDeferred.then(lang.hitch(this, function(validator){
                    this.set('validator', validator);
                }));

                when(ValidatorFactory.create(value), function(validator){
                    validatorDeferred.resolve(validator);
                });
            },

            _setValidationStyleAttr: function(value){
                if (this._started){

                    //Determine which node the style classes should be applied to
                    var styleNode;
                    if (this.styleNode && this.styleNode.domNode){ //if the styleNode is a widget
                        styleNode = this.styleNode.domNode;
                    } else if (this.styleNode){
                        styleNode = this.styleNode;
                    } else if (this.containerNode){
                        styleNode = this.containerNode;
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
            },

            onFocus: function(){
                this.inherited(arguments);
                this._onFocusValue = this.get('value');
            },

            onBlur: function(){
                this.set('postActivity', true);
                this.inherited(arguments);
                this.validateNow(); //Force immediate validation on blur, no need to wait for the delay timer.
            },

            _startValidateTimer: function(){

                //Delay timer. Don't validate every single value change
                clearTimeout(this._delayTimer);
                this._delayTimer = setTimeout(lang.hitch(this, function(){
                    this.validateNow();
                }), this.delay);
            },

            validateNow: function(){
                // Stop the delay timer and force an immediate validation
                clearTimeout(this._delayTimer);
                this._validate();
            },

            _validate: function(){

                if (this.suppressValidation){
                    return;
                }

                if (this.validator && this.validator.isValid){
                    var timestamp = new Date().getTime();
                    this._processValidationResult(this.validator.isValid(this.get('value')), timestamp);
                } else {
                    //no validator set, so process an empty result to clear any old messages or styles
                    this._processValidationResult(new Result({value: true, messages: []}), new Date().getTime());
                }
            },

            _processValidationResult: function(resultObject, timestamp){

                if (this._setValueTimestamp > timestamp){
                    // _validate has been called with a fresh value, so don't update the ui
                    return null;
                }

                var result = resultObject.get('value'),
                    state;

                switch (true){
                    case (result === true):
                        state = this._getChildrenState();
                        break;
                    case (result === false):
                        state = 'Error';
                        break;
                    case is.isDeferred(result):
                        result.then(lang.hitch(this, function(resultObject){
                            this._processValidationResult(resultObject, timestamp);
                        }));
                        state = 'Validating';
                        break;
                }

                this.set('state', state);
                this.set('validationMessages', resultObject.get('messages'));
                this._updateValidationStyle();
                return null;
            },

            _getChildrenState: function(){

                if ( ! this._descendants){
                    return '';
                }

                var states = array.map(this._descendants, function(widget){
                    return widget.get("state") || "";
                });

                if (array.indexOf(states, "Error") >= 0){
                    return 'Error';
                }
                if (array.indexOf(states, "Validating") >= 0){
                    return "Validating";
                }
                if (array.indexOf(states, 'Incomplete') >= 0){
                    return 'Incomplete';
                }

                if (array.filter(states, function(state){
                        return (state != '');
                    }).length > 0
                ){
                    return 'Invalid';
                }

                return '';
            }
        }
    );
});
