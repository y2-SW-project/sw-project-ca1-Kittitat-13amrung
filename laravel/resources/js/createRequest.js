import Editor from '@toast-ui/editor';
import '@toast-ui/editor/dist/toastui-editor.css';
import '@toast-ui/editor/dist/theme/toastui-editor-dark.css';
import 'tui-color-picker/dist/tui-color-picker.css';
import '@toast-ui/editor-plugin-color-syntax/dist/toastui-editor-plugin-color-syntax.css';

import colorSyntax from '@toast-ui/editor-plugin-color-syntax';
  const request = new Editor({
    el: document.querySelector('#request'),
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

    let content = document.getElementById("request2").value;
    let newContent = request.setMarkdown(content);

    let submit = document.getElementById("request-submit");
    

submit.addEventListener("click", () => {
    document.getElementById("request1").value = request.getMarkdown();
})