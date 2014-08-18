(function($){

  validFile = true;

  $.fileValidator = function(options){
    var validations = [];
    var onInvalid = options.onInvalid;
    var onValid = options.onValid;


    for (var key in $.fileValidator.validations){
      if (!options[key]){ continue; }
      validations.push( $.fileValidator.validations[key](options[key], onInvalid, onValid));
    }


    return function(file){
      for(var i=0, len = validations.length; i < len; i++){
        validations[i].call(this, file);
      }
      if(validFile){onValid.call(this);}
    };
  };

  $.fileValidator.validations = {
    maxSize: function(maxSize, invalid, valid){
      if( typeof maxSize == 'string' ){ 
        maxSize = $.fileValidator.sizeToBytes(maxSize);
      }

      return function(file){
        if (file.size > maxSize){ invalid.call(this,'maxSize',file); validFile = false; }
      };
    },

    type: function(contentType, invalid, valid){
      var isValid;
      if( typeof contentType == 'function' ){ 
        isValid = contentType; 
      } else if (contentType.constructor === RegExp ) { 
        isValid = function(type){ return type.match(contentType); }; 
      } else { 
        isValid = function(type){ return ~type.indexOf(contentType); }; 
      }

      return function(file){
        if (!isValid(file.type)) { invalid.call(this,'type', file); validFile = false; }
      };
    }
  };

  $.fn.fileValidator = function(userOptions) {
        var options = $.extend({
          // Validations
          maxSize: null,
          type: null,

          // Callbacks
          onValidation: $.fileValidator.doNothing,
          onInvalid: $.fileValidator.doNothing,
      onValid: $.fileValidator.doNothing
        }, userOptions);

        return this.each(function() {
            var el = $(this);
            var validator = $.fileValidator( $.extend({}, options, el.data()) );

          el.bind('change', function(event){
            var files = this.files || [];
            options.onValidation.call(this, files);
            for(var i=0, len=files.length; i < len; i++){
              validator.call(this, files[i]);
            }
          });
        });     
    };

  $.fileValidator.doNothing   = function doNothing(){};
  $.fileValidator.sizeToBytes = function sizeToBytes(size){
    var scale = 1;

    if (~ size.indexOf('k')){ 
      scale = 1024; 
    } else if (~ size.indexOf('m')){ 
      scale = 1024 * 1024; 
    } else if (~ size.indexOf('g')){ 
      scale = 1024 * 1024 * 1024; 
    }
    return parseInt(size,10) * scale;
  };
})( jQuery );