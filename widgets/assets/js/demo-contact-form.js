jQuery(window).on("elementor/frontend/init", function () {
  elementorFrontend.hooks.addAction(
    "frontend/element_ready/DemoContactForm.default",
    function ($scope, $) {
      hotelFolders = JSON.parse(
        jQuery(".obpress-contact-form").attr("data-hotel-folders")
      );

      function getUrlParam(param) {
        var sPageURL = window.location.search.substring(1);
        var sURLVariables = sPageURL.split("&");
        var sParameterName;

        for (var i = 0; i < sURLVariables.length; i++) {
          sParameterName = sURLVariables[i].split("=");

          if (sParameterName[0] === param) {
            return sParameterName[1] === undefined
              ? true
              : decodeURIComponent(sParameterName[1]);
          }
        }
      }

      /* add or update parameters in url */
      function updateUrlParam(key, value, url) {
        if (!url) url = window.location.href;
        var re = new RegExp("([?&])" + key + "=.*?(&|#|$)(.*)", "gi"),
          hash;

        if (re.test(url)) {
          if (typeof value !== "undefined" && value !== null) {
            return url.replace(re, "$1" + key + "=" + value + "$2$3");
          } else {
            hash = url.split("#");
            url = hash[0].replace(re, "$1$3").replace(/(&|\?)$/, "");
            if (typeof hash[1] !== "undefined" && hash[1] !== null) {
              url += "#" + hash[1];
            }
            return url;
          }
        } else {
          if (typeof value !== "undefined" && value !== null) {
            var separator = url.indexOf("?") !== -1 ? "&" : "?";
            hash = url.split("#");
            url = hash[0] + separator + key + "=" + value;
            if (typeof hash[1] !== "undefined" && hash[1] !== null) {
              url += "#" + hash[1];
            }
            return url;
          } else {
            return url;
          }
        }
      }

      function sortBySequence() {
        //buble sort
        var swapp;
        var n = hotelFolders.length - 1;
        var x = hotelFolders;
        do {
          swapp = false;
          for (var i = 0; i < n; i++) {
            if (x[i].IsPropertyFolder) {
              comparei = x[i].Sequence;
            } else {
              comparei = x[i].PropertySequence;
            }

            if (x[i + 1].IsPropertyFolder) {
              comparej = x[i + 1].Sequence;
            } else {
              comparej = x[i + 1].PropertySequence;
            }

            if (comparei > comparej) {
              var temp = x[i];
              x[i] = x[i + 1];
              x[i + 1] = temp;
              swapp = true;
            }
          }
          n--;
        } while (swapp);
        return x;
      }

      var sortedHotels = sortBySequence();

      //separate already sorted hotels and folders
      var onlyHotels = [];
      var onlyFolders = [];
      for (var i = 0; i < sortedHotels.length; i++) {
        if (sortedHotels[i].IsPropertyFolder) {
          onlyFolders.push(sortedHotels[i]);
        } else {
          onlyHotels.push(sortedHotels[i]);
        }
      }

      function getHotelsForFolder(UID) {
        var hotels = [];
        for (var i = 0; i < onlyHotels.length; i++) {
          if (onlyHotels[i].PropertyFolderUID == UID) {
            hotels.push(onlyHotels[i]);
          }
        }
        return hotels;
      }

      function getFoldersForFolder(UID) {
        var folders = [];
        for (var i = 0; i < onlyFolders.length; i++) {
          if (
            onlyFolders[i].ParentFolderUID != null &&
            onlyFolders[i].ParentFolderUID == UID
          ) {
            folders.push(onlyFolders[i]);
          }
        }
        return folders;
      }

      function getFoldersWithoutParents() {
        var folders = [];
        for (var i = 0; i < onlyFolders.length; i++) {
          if (
            onlyFolders[i].ParentFolderUID == null ||
            onlyFolders[i].ParentFolderUID == -1
          ) {
            folders.push(onlyFolders[i]);
          }
        }
        return folders;
      }

      function getHotelsWithoutParents() {
        var hotels = [];
        for (var i = 0; i < onlyHotels.length; i++) {
          if (onlyHotels[i].PropertyFolderUID == -1) {
            hotels.push(onlyHotels[i]);
          }
        }
        return hotels;
      }

      var hotels_div = jQuery(".hotels_dropdown");
      var hotels_folder_div = jQuery(".hotels_dropdown")
        .find(".hotels_folder")
        .eq(0);
      var hotels_hotel_div = jQuery(".hotels_dropdown")
        .find(".hotels_hotel")
        .eq(0);

      function getFolderChildren(UID, level) {
        if (UID == null) {
          UID = -1;
        }

        //CHANGE BECAUSE OF NOT REDIRECTING TO HOTELRESULT PAGE, UID WAS NOT -1
        if (onlyHotels.length == 1) {
          UID = onlyHotels[0].PropertyFolderUID;
        }

        var folders = [];
        if (UID == -1) {
          //starting
          folders = getFoldersWithoutParents();
        } else {
          folders = getFoldersForFolder(UID);
        }

        var hotels = getHotelsForFolder(UID);

        //list folders
        for (var i = 0; i < folders.length; i++) {
          //go through all folders and find the ones where uid is missing or -1
          if (!hasSubHotels(folders[i].PropertyFolderUID, 0)) continue;
          var folderName = folders[i].PropertyFolderName;
          var cloned = hotels_folder_div.clone();
          // cloned.attr("data-folder-id",folders[i].PropertyFolderUID);
          cloned.attr("data-folder-id", folders[i].PropertyFolderName);
          cloned.removeAttr("hidden");
          cloned.text(folderName);
          cloned.css("padding-left", 20 + "px");
          hotels_div.append(cloned);
          getFolderChildren(folders[i].PropertyFolderUID, level + 1);
        }
        //list hotels
        for (var j = 0; j < hotels.length; j++) {
          var hotelName = hotels[j].Property_Name;
          var cloned = hotels_hotel_div.clone(true);
          cloned.removeAttr("hidden");
          cloned.text(hotelName);
          cloned.css("padding-left", 50 + "px");
          cloned.attr("data-id", hotels[j].Property_UID);
          cloned.attr("data-parent-id", UID);
          hotels_div.append(cloned);
          if (jQuery(".hotels_folder").length > 1) {
            jQuery(".hotels_hotel").css("background-position-x", "20px");
          } else {
            jQuery(".hotels_hotel").css("background-position-x", "20px");
          }
        }
      }

      function hasSubHotels(UID, num) {
        if (UID == null) {
          UID = -1;
        }
        var folders = [];

        if (UID == -1) {
          //starting
          folders = getFoldersWithoutParents();
        } else {
          folders = getFoldersForFolder(UID);
        }
        var hotels = getHotelsForFolder(UID);

        num = num + hotels.length;

        //list hotels
        for (var i = 0; i < folders.length; i++) {
          //go through all folders and find the ones where uid is missing or -1
          return num + hasSubHotels(folders[i].PropertyFolderUID, num);
        }
        return hotels.length;
      }

      getFolderChildren(null, 0);

      $("#hotels").click(function () {
        var dropdown = $(this).closest('.obpress-input-holder').find(".hotels_dropdown");
        if (dropdown.css("display") == "none") {
          dropdown.find("*").removeClass("d-none");
          dropdown.slideDown(200);
        }
      });

      $(".hotels_hotel").on("click", function () {
        jQuery(".hotels_dropdown").slideUp();

        hotel_name = jQuery(this).text();

        jQuery("#hotels").val(hotel_name);
      });

      $(document).mouseup(function (e) {
        var box = $(".hotels_dropdown");
        if (!box.is(e.target) && box.has(e.target).length === 0) {
          box.slideUp(200);
        }

        if(inputClicked == true) {
          var form = $('.material-textfield');
          if (!form.is(e.target) && form.has(e.target).length === 0) {
            if(inputErrors == false && (isEmail($('.email-input').val()) == true && $('.email-input').val() != '') && (isPhone($('.phone-input').val()) == true && $('.phone-input').val() != '') && $(".message-input").val().length > 0) {
              inputsValidation();
            }
          }
        }
        
      });

      function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
      }

      function isPhone(phone) {
        var regex = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
        return regex.test(phone);
      }


      // check if every input is corret and send mail
      $(document).on('click', '.obpress-contact-submit', function(e){

          e.preventDefault();

          $(".obpress-contact-form .obpress-erorr-holder").hide();
          var action = "send_mail";
          var data = {};
          data.action = action;
          var errors = false;

          if ( $('.name-input').val() == "" ) {
            $("#obpress-contact-form-name-warning").css("display","inline-block");
            errors = true;
          }

          if ( $('.phone-input').val() == "" ) {
            $("#obpress-contact-form-phone-warning").css("display","inline-block");
            errors = true;
          }

          if (  isEmail(  $('.email-input').val() ) == false )  {
            $("#obpress-contact-form-email-warning").css("display","inline-block");
            errors = true;
          } 

          if ( $(".message-input").val().length == 0 ) {
            $("#obpress-contact-form-message-warning").css("display","inline-block");    
            errors = true;    
          }

          if (errors == true) {
            return;
          }
          

          var msg = {};
          msg.name = $('.name-input').val();
          msg.email = $('.email-input').val();
          msg.phone = $('.phone-input').val();
          msg.hotel = $('.hotel-input').val();
          msg.message = $('.message-input').val();
        
          data.msg = msg;
          
          $.post(contactAjax.ajaxurl, data, function(res){
            $("#obpress-contact-form-success").css("display","inline-block"); 
            $(".obpress-contact-form input, .obpress-contact-form textarea").val("");
          })
          

      });

      var inputErrors = false;
      function inputsValidation() {

        if ($('.name-input').val() == "") {
          $("#obpress-contact-form-name-warning").css("display","inline-block");
          inputErrors = true;
        } else {
          inputErrors = false;
          $("#obpress-contact-form-name-warning").hide();
        }

        if(isPhone($('.phone-input').val()) == false && $('.phone-input').val() == '') {
          $("#obpress-contact-form-phone-warning").css("display","inline-block");
          inputErrors = true;
        } else {
          inputErrors = false;
          $("#obpress-contact-form-phone-warning").hide();
        }

        if (isEmail($('.email-input').val()) == false && $('.email-input').val() == '')  {
          $("#obpress-contact-form-email-warning").css("display","inline-block");
          inputErrors = true;
        } else {
          inputErrors = false;
          $("#obpress-contact-form-email-warning").hide();
        }

        if ($(".message-input").val().length == 0) {  
          $("#obpress-contact-form-message-warning").css("display","inline-block");   
          inputErrors = true;    
        } else {
          inputErrors = false;
          $("#obpress-contact-form-message-warning").hide();  
        }

        if(inputErrors == false) {
          $('.obpress-contact-submit').prop('disabled', false);
        } else {
          $('.obpress-contact-submit').prop('disabled', true);
        }

      }

      $("#input-name").on('keypress', function(event) {
        var inputValue = event.charCode;
        if(!((inputValue > 64 && inputValue < 91) || (inputValue > 96 && inputValue < 123)||(inputValue==32) || (inputValue==0))){
            event.preventDefault();
        }
      })
      
      $(document).on('keyup', '#input-name', function() {

        if ($(this).val() == "") {
          $("#obpress-contact-form-name-warning").css("display","inline-block");
          inputErrors = true;
        } else {
          inputErrors = false;
          $("#obpress-contact-form-name-warning").hide();
        }

        if(inputErrors == false && (isEmail($('.email-input').val()) == true && $('.email-input').val() != '') && (isPhone($('.phone-input').val()) == true && $('.phone-input').val() != '') && $(".message-input").val().length > 0) {
          $('.obpress-contact-submit').prop('disabled', false);
        } else {
          $('.obpress-contact-submit').prop('disabled', true);
        }

      });

      $(document).on('keyup', '#input-email', function() {

        if (isEmail($(this).val()) == false)  {
          $("#obpress-contact-form-email-warning").css("display","inline-block");
          inputErrors = true;
        } else {
          inputErrors = false;
          $("#obpress-contact-form-email-warning").hide();
        }

        if(inputErrors == false && (isEmail($('.email-input').val()) == true && $('.email-input').val() != '') && (isPhone($('.phone-input').val()) == true && $('.phone-input').val() != '') && $(".message-input").val().length > 0) {
          $('.obpress-contact-submit').prop('disabled', false);
        } else {
          $('.obpress-contact-submit').prop('disabled', true);
        }

      })

      $(document).on('keyup', '#input-phone', function() {

        if(isPhone($(this).val()) == false) {
          $("#obpress-contact-form-phone-warning").css("display","inline-block");
          inputErrors = true;
        } else {
          inputErrors = false;
          $("#obpress-contact-form-phone-warning").hide();
        }

        if(inputErrors == false && (isEmail($('.email-input').val()) == true && $('.email-input').val() != '') && (isPhone($('.phone-input').val()) == true && $('.phone-input').val() != '') && $(".message-input").val().length > 0) {
          $('.obpress-contact-submit').prop('disabled', false);
        } else {
          $('.obpress-contact-submit').prop('disabled', true);
        }
      });

      $(document).on('keyup', '#message', function() {
        if ($(this).val().length == 0) {  
          $("#obpress-contact-form-message-warning").css("display","inline-block");   
          inputErrors = true;    
        } else {
          inputErrors = false;  
          $("#obpress-contact-form-message-warning").hide();  
        }
        if(inputErrors == false && (isEmail($('.email-input').val()) == true && $('.email-input').val() != '') && (isPhone($('.phone-input').val()) == true && $('.phone-input').val() != '') && $(".message-input").val().length > 0) {
          $('.obpress-contact-submit').prop('disabled', false);
        } else {
          $('.obpress-contact-submit').prop('disabled', true);
        }

      })

      var inputClicked = false;
      $(document).on('click', '#input-name, #input-email, #input-email, #hotels, #message', function() {
        inputClicked = true;
      });


    }
  );
});
