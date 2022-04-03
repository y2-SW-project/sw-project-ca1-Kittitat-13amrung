import Editor from "@toast-ui/editor";

let content = document.getElementById("view").value;

const viewer = new Editor.factory({
    el: document.querySelector('#viewer'),
    viewer: true,
    initialValue: content,
});