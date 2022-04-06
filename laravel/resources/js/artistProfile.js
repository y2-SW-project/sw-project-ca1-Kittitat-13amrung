
import Dropzone from "dropzone";
import Editor from '@toast-ui/editor';
import '@toast-ui/editor/dist/toastui-editor.css';
import '@toast-ui/editor/dist/theme/toastui-editor-dark.css';
import 'tui-color-picker/dist/tui-color-picker.css';
import '@toast-ui/editor-plugin-color-syntax/dist/toastui-editor-plugin-color-syntax.css';

import colorSyntax from '@toast-ui/editor-plugin-color-syntax';

let artistProfile = new Dropzone("#artist-profile");
artistProfile.options.autoProcessQueue = false;
artistProfile.options.maxFiles = 3;
artistProfile.options.chunking = true;
artistProfile.options.forceChunking = true;


// artistProfile.on("maxfilesexceeded", function(file) { this.removeFile(file); });

artistProfile.confirm = function(question, accepted, rejected) {
    // Do your thing, ask the artist for confirmation or rejection, and call
    // accepted() if the artist accepts, or rejected() otherwise. Make
    // sure that rejected is actually defined!
    alert(question);
  };

Dropzone.options.artistProfile = {
    maxFileSize : 4,
    chunksUploaded: (file, done) => {
        file.upload();
        done();
    },

   init: () => {

       let button = document.querySelector('#submit-all');
       
       button.addEventListener("click", () => {
           artistProfile.processQueue();
       });

       artistProfile.on("addedfile", file => {
        console.log(`File added: ${file.name}`);
        file.previewElement.addEventListener("click", function() {
            artistProfile.removeFile(file);
          });

                  // Create the remove button
        var removeButton = Dropzone.createElement("<button>Remove file</button>");
        

        // Capture the Dropzone instance as closure.
        var _this = artistProfile;

        // Listen to the click event
        removeButton.addEventListener("click", function(e) {
          // Make sure the button click doesn't submit the form:
          e.preventDefault();
          e.stopPropagation();

          // Remove the file preview.
          _this.removeFile(file);
          // If you want to the delete the file on the server as well,
          // you can do the AJAX request here.
        });

        // Add the button to the file preview element.
        file.previewElement.appendChild(removeButton);
    });
       
   },


 };
 
 Dropzone.options.artistProfile.init();

  
  const editor = new Editor({
    el: document.querySelector('#editor'),
    height: '700px',
    initialEditType: 'wysiwyg',
    previewStyle: 'vertical',
    theme: 'light',
    toolbarItems: [
        ['heading', 'bold', 'italic', 'strike'],
        ['hr', 'quote'],
        ['ul', 'ol', 'task', 'indent', 'outdent'],
        ['table', 'image', 'link'],
        ['scrollSync']],
        plugins: [colorSyntax],
        autofocus: false,
        initialValue: newContent,
        frontMatter: true,
    });

    let content = document.getElementById("editor2").value;
    let newContent = editor.setMarkdown(content);

    let submit = document.getElementById("submit");
    

submit.addEventListener("click", () => {
    document.getElementById("editor1").value = editor.getMarkdown();
})




  

