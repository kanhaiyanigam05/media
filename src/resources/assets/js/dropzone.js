Dropzone.options.demoUpload = {
    paramName: "file",
    maxFilesize: 50,
    acceptedFiles: "image/*,video/*",
    success: function (file, response) {
        console.log(file, response);
        if (response.file) {
            loadBladeComponentWithData(response.file);
        }
    },
};

function loadBladeComponentWithData(data) {
    fetch("/admin/media-item", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        body: JSON.stringify({ media: data }),
    })
        .then((response) => response.json())
        .then((json) => {
            $("#uploaded-files").append(json.html);
        })
        .catch((error) =>
            console.error("Error loading Blade component:", error)
        );
}

$(document).ready(function () {
    $("#upload-files").on("submit", function (e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr("action"),
            type: $(this).attr("method"),
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.files) {
                    response.files.forEach(function (fileData) {
                        loadBladeComponentWithData(fileData);
                        $("#upload-files")[0].reset();
                    });
                }
            },
        });
    });
});
function formatDate(timestamp) {
    const date = new Date(timestamp);
    return date
        .toLocaleString("en-CA", {
            year: "numeric",
            month: "2-digit",
            day: "2-digit",
            hour: "2-digit",
            minute: "2-digit",
            hour12: false,
        })
        .replace(",", "");
}
