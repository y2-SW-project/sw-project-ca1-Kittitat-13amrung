import Dropzone from "dropzone";

let userProfile = new Dropzone("#user-profile");
userProfile.options.autoProcessQueue = false;
userProfile.options.maxFiles = 1;

Dropzone.options.userProfile = {
    maxFileSize : 4,

   init: () => {

       let button = document.querySelector('#submit');
       
       button.addEventListener("click", () => {
           userProfile.processQueue();
       });

       userProfile.on("addedfile", file => {
        console.log(`File added: ${file.name}`);
        file.previewElement.addEventListener("click", function() {
            userProfile.removeFile(file);
          });

    });
       
   },


 };
 
 Dropzone.options.userProfile.init();