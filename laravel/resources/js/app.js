console.log("script loaded");

require('./bootstrap');
import Dropzone from "dropzone";


// let userProfile = new Dropzone("#user-profile");
// userProfile.on("addedfile", file => {
//     console.log(`File added: ${file.name}`);
// });


function getId(_req) {
  let req = document.getElementById(_req);
  return req;
}
