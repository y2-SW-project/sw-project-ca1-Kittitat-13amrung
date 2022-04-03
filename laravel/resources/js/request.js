
import Dropzone from "dropzone";
import Editor from '@toast-ui/editor';
import '@toast-ui/editor/dist/toastui-editor.css';
import '@toast-ui/editor/dist/theme/toastui-editor-dark.css';

let userProfile = new Dropzone("#user-profile");
userProfile.on("addedfile", file => {
    console.log(`File added: ${file.name}`);
    file.previewElement.addEventListener("click", function() {
        userProfile.removeFile(file);
      });
});

Dropzone.options.userProfile = {
    parallelUploads: 1,
    chunking: true,
    forceChunking: true,
    parallelChunkUploads: true,    
    chunksUploaded: (file, done) => {
        console.log(file);
        done();
    }

  };

  
  const editor = new Editor({
      el: document.querySelector('#editor'),
    height: '700px',
    initialEditType: 'markdown',
    previewStyle: 'vertical',
    theme: 'light',
    toolbarItems: [
        ['heading', 'bold', 'italic', 'strike'],
        ['hr', 'quote'],
        ['ul', 'ol', 'task', 'indent', 'outdent'],
        ['table', 'image', 'link'],
        ['scrollSync']],
        autofocus: false,
        initialValue: newContent,
    });

    let content = document.getElementById("editor2").value;
    let newContent = editor.setMarkdown(content.replace(/n/, ''));

    let submit = document.getElementById("submit");
    

submit.addEventListener("click", () => {
    document.getElementById("editor1").value = editor.getMarkdown();
})




  

