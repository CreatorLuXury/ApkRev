window.URL = window.URL || window.webkitURL;
var elBrowse = document.getElementById("imgInp"),
    elPreview = document.getElementById("preview"),
    useBlob = false && window.URL; // `true` to use Blob instead of Data-URL

function readImage(file) {
    var reader = new FileReader();
    reader.addEventListener("load", function () {
        var image = new Image();
        image.addEventListener("load", function () {
            var imageInfo = file.name + ' ' +
                image.width + '×' +
                image.height + ' ' +
                file.type + ' ' +
                Math.round(file.size / 1024) + 'KB';
            elPreview.appendChild(this);
            elPreview.insertAdjacentHTML("beforeend", imageInfo + '<br>');
        });
        image.src = useBlob ? window.URL.createObjectURL(file) : reader.result;
        if (useBlob) {
            window.URL.revokeObjectURL(file); // Free memory
        }
    });
    reader.readAsDataURL(file);
}

elBrowse.addEventListener("change", function () {
    var files = this.files;
    var errors = "";
    if (!files) {
        errors += "File upload not supported by your browser.";
    }
    if (files && files[0]) {
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            if ((/\.(png|jpeg|jpg|gif)$/i).test(file.name)) {
                readImage(file);
            } else {
                errors += file.name + " Unsupported Image extension\n";
            }
        }
    }
    if (errors) {
        alert(errors);
    }
});