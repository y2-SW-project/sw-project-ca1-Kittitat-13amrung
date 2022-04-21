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
  
  let avatar = $('.avatar');
  let image = document.getElementById('image');
  let input = $('#user-profile');
  let profileModal = $('#modal-profile');
  let $progress = $('.progress');
  let $progressBar = $('.progress-bar');
  let $alert = $('.alert');
  let cropper;

  avatar.each( function() {
  console.log($(this)[0]);
  });
  
  $('label[data-toggle="tooltip"]').tooltip({
    offset: [0, -100],
  });

    input.change(function (e) {
      input.rules('add', {
        required: true,
        accept: "image/jpeg, image/pjpeg"
      });
      let files = e.target.files;
      let done = function (url) {
        input.value = '';
        $alert.hide();
        image.src = url;
        profileModal.modal('show');
      };

      let reader;
      let file;
      let url;

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

    profileModal.on('shown.bs.modal', function () {
      cropper = new Cropper(image, {
        aspectRatio: 1,
        viewMode: 2,
        dragMode: 'move',
        minContainerWidth: 305,
        minContainerHeight: 450,
        minCanvasWidth: 320,
        minCanvasHeight: 320,
      });
    }).on('hidden.bs.modal', function () {
      cropper.destroy();
      cropper = null;
    });

    document.getElementById('crop').addEventListener('click', function () {
      let initialAvatarURL;
      let canvas;

      profileModal.modal('hide');

      if (cropper) {
        canvas = cropper.getCroppedCanvas({
          width: 280,
          height: 280,
        });
        initialAvatarURL = avatar.each( function() {
          $(this)[0].src;
        });
        avatar.each( function() {
          $(this)[0].src = canvas.toDataURL();
        });
        canvas.toBlob(function (blob) {
          let formData = new FormData();

          formData.append('file', blob, 'file.jpg');
          console.log(formData);
          $.ajax('/user/profile/upload', {
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,

            xhr: function () {
              let xhr = new XMLHttpRequest();

              xhr.upload.onprogress = function (e) {
                $progress.removeClass('d-none');
                let percent = '0';
                let percentage = '0%';

                if (e.lengthComputable) {
                  percent = Math.round((e.loaded / e.total) * 100);
                  percentage = percent + '%';
                  $progressBar.width(percentage).attr('aria-valuenow', percent).text(percentage);
                }
              };

              return xhr;
            },

            success: function () {
              $alert.show().addClass('alert-success h6').text('Upload success');
            },

            error: function () {
              avatar.each( function() {
                $(this)[0].src = initialAvatarURL;
              });
              $alert.show().addClass('alert-danger h6').text('Upload error');
            },

            complete: function () {
              $progress.addClass('d-none');
              $progress.hide();
            },
          });
        });
      }
    });
});