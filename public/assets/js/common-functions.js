//Convert Title to slug lowercase
function convertToSlug(Text) {
    return Text.toLowerCase()
        .replace(/ /g, "-")
        .replace(/[^\w-]+/g, "");
}

//Data Table Initialization with Button
function dataTableDisplay(datatable_id, module_name, ajax_url, columns_array) {
    $("#" + datatable_id).DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        // lengthChange: true,
        autoWidth: false,
        scrollX: true,
        // dom: "Blfrtip",
        ajax: {
            url: ajax_url,
            dataType: "json",
            type: "GET",
            data: { _token: "{{csrf_token()}}" },
        },
        columns: columns_array,
        buttons: [
            {
                extend: "pdf",
                title: module_name,
                exportOptions: {
                    columns: ":gt(0)", // indexes of the columns that should be printed,
                }, // Exclude indexes that you don't want to print.
            },
            {
                extend: "csv",
                title: module_name,
                exportOptions: {
                    columns: ":gt(0)",
                    modifier: {
                        page: 'all'
               }
                },
            },
            {
                extend: "excel",
                title: module_name,
                exportOptions: {
                    columns: ":gt(0)",
                },
            },
            {
                extend: "print",
                title: module_name,
                exportOptions: {
                    columns: ":gt(0)",
                },
            },
            {
                extend: "colvis",
                title: module_name,
                exportOptions: {
                    columns: ":gt(0)",
                },
            },
        ],
    });
}

function customFormValidation(
    validation_fields,
    validation_messages,
    form_name = ""
) {
    var form_id_or_class =
        form_name == "" ? ".js-validation-material" : "#" + form_name;

    //US Pattern Phone Number Validation Rule
    $.validator.addMethod(
        "phoneUS",
        function (phone_number, element) {
            phone_number = phone_number.replace(/\s+/g, "");
            return (
                this.optional(element) ||
                (phone_number.length > 9 &&
                    phone_number.match(
                        /^(\+?1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/
                    ))
            );
        },
        "Please specify a valid phone number"
    );

    //Email Validation Rule
    $.validator.addMethod(
        "emailordomain",
        function (value, element) {
            return (
                this.optional(element) ||
                /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/.test(value) ||
                /[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/.test(
                    value
                )
            );
        },
        "Please specify the correct domain/email"
    );

    //Strong Password Validation Rule
    $.validator.addMethod(
        "strong_password",
        function (value, element) {
            let password = value;
            if (
                !/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@#$%&])(.{9,20}$)/.test(
                    password
                )
            ) {
                return false;
            }
            return true;
        },
        function (value, element) {
            let password = $(element).val();
            if (!/^(.{9,64}$)/.test(password)) {
                return "Password must be between 9 to 64 characters long.";
            } else if (!/^(?=.*[A-Z])/.test(password)) {
                return "Password must contain at least one uppercase.";
            } else if (!/^(?=.*[a-z])/.test(password)) {
                return "Password must contain at least one lowercase.";
            } else if (!/^(?=.*[0-9])/.test(password)) {
                return "Password must contain at least one digit.";
            } else if (!/^(?=.*[@#$%&])/.test(password)) {
                return "Password must contain special characters from @#$%&.";
            }
            return false;
        }
    );

    //Image Upload Validation Rule
    $.validator.addMethod(
        "filesize",
        function (value, element, param) {
            return (
                this.optional(element) ||
                element.files[0].size <= param * 1000000
            );
        },
        "File size must be less than {0} MB"
    );

    //Date of Birth Validation Rule
    $.validator.addMethod("minAge", function(value, element, min) {
        var today = new Date();
        var birthDate = new Date(value);
        var age = today.getFullYear() - birthDate.getFullYear();
     
        if (age > min+1) { return true; }
     
        var m = today.getMonth() - birthDate.getMonth();
     
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) { age--; }
     
        return age >= min;
    }, "You are not old enough!");


    $.validator.addMethod("greaterThan",
    function(value, element, params) {

        if (!/Invalid|NaN/.test(new Date(value))) {
            return new Date(value) > new Date($(params).val());
        }

        return isNaN(value) && isNaN($(params).val())
            || (Number(value) > Number($(params).val()));
    },'Must be greater than {0}.');
    $.validator.addMethod("registration_end_at", function(value, element){
        var startdatevalue = $('#registration_start_at').val();
        console.log(startdatevalue);
         return Date.parse(startdatevalue) &lt; Date.parse(value);
  }, 'End Date should be greater than equal to Start Date.');
  
    //alphanumeric validation
    jQuery.validator.addMethod("alphanumeric", function(value, element) {
        return this.optional(element) || /^\w+$/i.test(value);
    }, "Subdomain must be Letters, numbers, and underscores only");

    $(form_id_or_class).validate({
        //    errorClass: 'help-block text-right animated fadeInDown',
        errorElement: "span",
        errorPlacement: function (error, element) {
            error.addClass("invalid-feedback");
            element.closest(".form-group, .input-group").append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass("is-invalid");
        },
        rules: validation_fields,
        messages: validation_messages,
    });
}

function updateUrlParameters(params) {
    // Get the current URL
    var currentUrl = window.location.href;

    // Function to escape special characters in a string
    function escapeRegExp(string) {
        return string.replace(/[.*+\-?^${}()|[\]\\]/g, "\\$&");
    }

    // Loop through the provided params array
    for (var i = 0; i < params.length; i++) {
        var paramName = params[i].name;
        var paramValue = params[i].value;

        // Use a regular expression to search for the parameter in the URL
        var regex = new RegExp(
            `([?&])${escapeRegExp(paramName)}=.*?(&|$)`,
            "i"
        );
        var separator = currentUrl.indexOf("?") !== -1 ? "&" : "?";

        // Check if the parameter exists in the URL
        if (currentUrl.match(regex)) {
            if (paramValue === "") {
                // If the parameter value is empty, remove the parameter from the URL
                currentUrl = currentUrl.replace(regex, "$2");
            } else {
                // If the parameter already exists in the URL with a different value, update the value
                currentUrl = currentUrl.replace(
                    regex,
                    `$1${paramName}=${paramValue}$2`
                );
            }
        } else if (paramValue !== "") {
            console.log(paramName, paramValue);
            // If the parameter does not exist in the URL and the value is not empty, add the new parameter to the URL
            currentUrl = `${currentUrl}${separator}${paramName}=${paramValue}`;
        }
    }

    return currentUrl;
}

function removeQueryParams(paramsToRemove) {
    var currentUrl = window.location.href;

    // Parse the URL to extract the query parameters
    var urlParts = currentUrl.split("?");
    var baseUrl = urlParts[0];
    var queryParamsString = urlParts[1] || "";

    // Split the query parameters string into individual parameters
    var queryParamsArray = queryParamsString.split("&");

    // Create a new array to hold the filtered query parameters
    var filteredParams = [];

    // Loop through the existing query parameters and filter out the ones to remove
    queryParamsArray.forEach(function (queryParam) {
        var paramName = queryParam.split("=")[0];

        // Check if the current parameter should be kept
        if (paramsToRemove.indexOf(paramName) === -1) {
            filteredParams.push(queryParam);
        }
    });

    // Reconstruct the updated query parameters string
    var updatedParamsString = filteredParams.join("&");

    // Combine the base URL with the updated query parameters to form the final URL
    var updatedUrl =
        baseUrl + (updatedParamsString ? "?" + updatedParamsString : "");

    return updatedUrl;
}

function attachSpinLoader(elementId) {
    var element = $(elementId);
    element.append(
        '<div class="spin-loader-overlay"><div class="spin-loader"></div></div>'
    );
    return elementId;
}

function removeSpinLoader(elementId) {
    var element = $(elementId);
    element.find(".spin-loader-overlay").remove();
}

function replaceKeysInString(string, object) {
    try {
        if (
            typeof string !== "string" ||
            object === null ||
            typeof object !== "object"
        ) {
            throw new Error("Invalid input");
        }

        for (var key in object) {
            if (object.hasOwnProperty(key)) {
                var regex = new RegExp(key, "g");
                string = string.replace(regex, object[key]);
            }
        }

        return string;
    } catch (error) {
        console.error("Error:", error.message);
        return string;
    }
}

jQuery(".toggle-icon").click(function () {
    jQuery("#mob-menu").slideToggle(600, "linear");
    jQuery(".toggle-icon").toggleClass("close-icon");
});

$(document).ready(function () {
    $(".left-sidebar-toggle").click(function () {
        $(".left-sidebar-spacer").toggle();
    });
});

function imagePreview(thisvalue){
    $(thisvalue).addClass('img-enlargable');
    var src = $(thisvalue).attr('src');

    $('<div>').css({
        background: 'RGBA(0,0,0,.5) url('+src+') no-repeat center',
        backgroundSize: 'contain',
        width:'100%', height:'100%',
        position:'fixed',
        zIndex:'10000',
        top:'0', left:'0',
        cursor: 'zoom-out'
    }).click(function(){
        $(this).remove();
    }).appendTo('body');
}


$(document).ready(function(){
  
    $(".password_icon").click(function(){
        $(this).toggleClass("icon_change_toggle");
        var x = document.getElementById("password");

        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";  
        }
    });

    $(".confirm_password_icon").click(function(){
        $(this).toggleClass("icon_change_toggle");
        var x = document.getElementById("confirm_password");

        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";  
        }
    });

      // Prevent typing non-numeric characters (including 'e')
      $('#numberInput').on('keydown', function(e) {
        // Allow: backspace, delete, tab, escape, enter, and arrow keys
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 37, 38, 39, 40]) !== -1 ||
           // Allow: Ctrl/cmd+A, Ctrl/cmd+C, Ctrl/cmd+V, Ctrl/cmd+X
           (e.ctrlKey === true || e.metaKey === true) && 
           $.inArray(e.keyCode, [65, 67, 86, 88]) !== -1) {
           return;  // let it happen, don't do anything
        }
           // Ensure that it is a number and stop the keypress if not
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && 
           (e.keyCode < 96 || e.keyCode > 105)) {
           e.preventDefault();
        }
     });

     // Prevent non-numeric characters from being pasted
     $('#numberInput').on('paste', function(e) {
           var clipboardData = (e.originalEvent || e).clipboardData.getData('text');
           if (!/^\d+$/.test(clipboardData)) {
              e.preventDefault();
           }
     });

})
