$(document).ready(function() {

	$('[data-toggle="tooltip"]').tooltip();

  var bs_modal = $('#modal');
  var image = document.querySelector('#model_img');
  var cropper,reader,file;
  
  $("body").on("change", "#input_profile", function(e) {
    var files = e.target.files;
    var file = files[0];
    var file_type = file.type.slice(6);   // output this image/png to this png
    var file_size = file.size;

    if(!(file_type == "jpg" || file_type == "jpeg" || file_type == "png")) {
      $("#error_EP_IMG").addClass("mb-2");
      $("#error_EP_IMG").text("Only Upload JPG, JPEG and PNG");
    } else if (!(file_size < 8388608)) {
      $("#error_EP_IMG").addClass("mb-2");
      $("#error_EP_IMG").text("Your Image Size is Larger than 8MB ...");
    } else {
      $("#error_EP_IMG").removeClass("mb-2");
      $("#error_EP_IMG").text("");
      var done = function(url) {
        image.src = url;
        bs_modal.modal('show');
      };
    }

    if (URL) {
      done(URL.createObjectURL(file));
    } else if (FileReader) {
      reader = new FileReader();
      reader.onload = function(e) {
        done(reader.result);
      };
      reader.readAsDataURL(file);
    }
  });

  bs_modal.on('shown.bs.modal', function() {
    cropper = new Cropper(image, {
      aspectRatio: 1,
      viewMode: 3,
      preview: '.preview'
    });
  }).on('hidden.bs.modal', function() {
    cropper.destroy();
    cropper = null;
  });

  $("#upload").click(function() {
    canvas = cropper.getCroppedCanvas({
      width: 250,
      height: 250,
    });

    canvas.toBlob(function(blob) {
        url = URL.createObjectURL(blob);
        reader = new FileReader();
        reader.readAsDataURL(blob);
        reader.onloadend = function() {
          var base64data = reader.result;
          
          $.ajax({
            type: "POST",
            dataType: "json",
            url: "profile_store.php",
            data: {image: base64data},
            success: function(data) { 
              bs_modal.modal('hide');
              $('#profile_show').attr('src', data);
              document.cookie = "profile_path="+data;
            }
          });
        };
    });
  });
});




// SignIn Show and Hide Password
function SH_SI_PWD() {
	if ($("#si_password").attr("type") === "password") {
    $("#si_password").attr("type", "text");
		$('#SH_SI_PWD_Icon').removeClass();
		$('#SH_SI_PWD_Icon').addClass("fas fa-eye-slash");
		$('#SH_SI_PWD_Icon').attr("title", "Show Password").tooltip("_fixTitle").tooltip("show");
  } else {
		$("#si_password").attr("type", "password");
		$('#SH_SI_PWD_Icon').removeClass();
		$('#SH_SI_PWD_Icon').addClass("fas fa-eye");
		$('#SH_SI_PWD_Icon').attr("title", "Hide Password").tooltip("_fixTitle").tooltip("show");
  }
}

// SignUP Show and Hide Password
function SH_SU_PWD() {
	if ($("#su_password").attr("type") === "password") {
    $("#su_password").attr("type", "text");
		$('#SH_SU_PWD_Icon').removeClass();
		$('#SH_SU_PWD_Icon').addClass("fas fa-eye-slash");
		$('#SH_SU_PWD_Icon').attr("title", "Show Password").tooltip("_fixTitle").tooltip("show");
  } else {
		$("#su_password").attr("type", "password");
		$('#SH_SU_PWD_Icon').removeClass();
		$('#SH_SU_PWD_Icon').addClass("fas fa-eye");
		$('#SH_SU_PWD_Icon').attr("title", "Hide Password").tooltip("_fixTitle").tooltip("show");
  }
}

// SignUP Show and Hide Confirm Password
function SH_SU_CPWD() {
	if ($("#su_confirmPassword").attr("type") === "password") {
    $("#su_confirmPassword").attr("type", "text");
		$('#SH_SU_CPWD_Icon').removeClass();
		$('#SH_SU_CPWD_Icon').addClass("fas fa-eye-slash");
		$('#SH_SU_CPWD_Icon').attr("title", "Show Password").tooltip("_fixTitle").tooltip("show");
  } else {
		$("#su_confirmPassword").attr("type", "password");
		$('#SH_SU_CPWD_Icon').removeClass();
		$('#SH_SU_CPWD_Icon').addClass("fas fa-eye");
		$('#SH_SU_CPWD_Icon').attr("title", "Hide Password").tooltip("_fixTitle").tooltip("show");
  }
}

// ResetPassword Show and Hide Password
function SH_NEW_PWD() {
	if ($("#new_password").attr("type") === "password") {
    $("#new_password").attr("type", "text");
		$('#SH_NEW_PWD_Icon').removeClass();
		$('#SH_NEW_PWD_Icon').addClass("fas fa-eye-slash");
		$('#SH_NEW_PWD_Icon').attr("title", "Show Password").tooltip("_fixTitle").tooltip("show");
  } else {
		$("#new_password").attr("type", "password");
		$('#SH_NEW_PWD_Icon').removeClass();
		$('#SH_NEW_PWD_Icon').addClass("fas fa-eye");
		$('#SH_NEW_PWD_Icon').attr("title", "Hide Password").tooltip("_fixTitle").tooltip("show");
  }
}

// ResetPassword Show and Hide Password
function SH_NEW_CPWD() {
	if ($("#new_confirmPassword").attr("type") === "password") {
    $("#new_confirmPassword").attr("type", "text");
		$('#SH_NEW_CPWD_Icon').removeClass();
		$('#SH_NEW_CPWD_Icon').addClass("fas fa-eye-slash");
		$('#SH_NEW_CPWD_Icon').attr("title", "Show Password").tooltip("_fixTitle").tooltip("show");
  } else {
		$("#new_confirmPassword").attr("type", "password");
		$('#SH_NEW_CPWD_Icon').removeClass();
		$('#SH_NEW_CPWD_Icon').addClass("fas fa-eye");
		$('#SH_NEW_CPWD_Icon').attr("title", "Hide Password").tooltip("_fixTitle").tooltip("show");
  }
}

// ResetPassword Show and Hide Password
function SH_CURRENT_PWD() {
	if ($("#current_password").attr("type") === "password") {
    $("#current_password").attr("type", "text");
		$('#SH_CURRENT_PWD_Icon').removeClass();
		$('#SH_CURRENT_PWD_Icon').addClass("fas fa-eye-slash");
		$('#SH_CURRENT_PWD_Icon').attr("title", "Show Password").tooltip("_fixTitle").tooltip("show");
  } else {
		$("#current_password").attr("type", "password");
		$('#SH_CURRENT_PWD_Icon').removeClass();
		$('#SH_CURRENT_PWD_Icon').addClass("fas fa-eye");
		$('#SH_CURRENT_PWD_Icon').attr("title", "Hide Password").tooltip("_fixTitle").tooltip("show");
  }
}




