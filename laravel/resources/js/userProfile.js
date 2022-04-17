import Dropzone from "dropzone";

// let userProfile = new Dropzone("#user-profile");
// userProfile.options.autoProcessQueue = false;
// userProfile.options.maxFiles = 1;

// Dropzone.options.userProfile = {
//     maxFileSize : 4,

//    init: () => {

//        let button = document.querySelector('#submit');
       
//        button.addEventListener("click", () => {
//            userProfile.processQueue();
//        });

//        userProfile.on("addedfile", file => {
//         console.log(`File added: ${file.name}`);
//         file.previewElement.addEventListener("click", function() {
//             userProfile.removeFile(file);
//           });

//     });
       
//    },


//  };
 
//  Dropzone.options.userProfile.init();
$( window ).on( "load", () => {
window.addEventListener('DOMContentLoaded', function () {
    var avatar = document.getElementById('avatar');
    var image = document.getElementById('image');
    var input = document.getElementById('input');
    var $progress = $('.progress');
    var $progressBar = $('.progress-bar');
    var $alert = $('.alert');
    var $modal = $('#modal');
    var cropper;

    $('[data-toggle="tooltip"]').tooltip();

    input.addEventListener('change', function (e) {
      var files = e.target.files;
      var done = function (url) {
        input.value = '';
        image.src = url;
        $alert.hide();
        $modal.modal('show');
      };
      var reader;
      var file;
      var url;

      if (files && files.length > 0) {
        file = files[0];

        if (URL) {
          done(URL.createObjectURL(file));
        } else if (FileReader) {
          reader = new FileReader();
          reader.onload = function (e) {
            done(reader.result);
          };
          reader.readAsDataURL(file);
        }
      }
    });

    $modal.on('shown.bs.modal', function () {
      cropper = new Cropper(image, {
        aspectRatio: 1,
        viewMode: 2,
      });
    }).on('hidden.bs.modal', function () {
      cropper.destroy();
      cropper = null;
    });

    document.getElementById('crop').addEventListener('click', function () {
      var initialAvatarURL;
      var canvas;

      $modal.modal('hide');

      if (cropper) {
        canvas = cropper.getCroppedCanvas({
          width: 320,
          height: 320,
        });
        initialAvatarURL = avatar.src;
        avatar.src = canvas.toDataURL();
        $progress.show();
        $alert.removeClass('alert-success alert-warning');
        canvas.toBlob(function (blob) {
          var formData = new FormData();

          formData.append('avatar', blob, 'avatar.jpg');
          $.ajax('https://jsonplaceholder.typicode.com/posts', {
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,

            xhr: function () {
              var xhr = new XMLHttpRequest();

              xhr.upload.onprogress = function (e) {
                var percent = '0';
                var percentage = '0%';

                if (e.lengthComputable) {
                  percent = Math.round((e.loaded / e.total) * 100);
                  percentage = percent + '%';
                  $progressBar.width(percentage).attr('aria-valuenow', percent).text(percentage);
                }
              };

              return xhr;
            },

            success: function () {
              $alert.show().addClass('alert-success').text('Upload success');
            },

            error: function () {
              avatar.src = initialAvatarURL;
              $alert.show().addClass('alert-warning').text('Upload error');
            },

            complete: function () {
              $progress.hide();
            },
          });
        });
      }
    });
  });
});