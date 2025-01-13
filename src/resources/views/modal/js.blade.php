@push('css')
<link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css" />
<link rel="stylesheet" href="https://cdn3.devexpress.com/jslib/23.1.3/css/dx.light.css" />
<link rel="stylesheet" href="{{ asset('media-assets/css/style.css') }}" />
<link rel="stylesheet" href="{{ asset('media-assets/css/responsive.css') }}" />
@endpush
@push('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn3.devexpress.com/jslib/23.1.3/js/dx.all.js"></script>
<script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
<script src="{{ asset('media-assets/js/dropzone.js') }}"></script>

<script>
    $("#toggleButton").on("click", function() {
        $("#toggleButton .change-icon").removeClass("fa-arrow-right-long");
        $("#toggleButton .change-icon").addClass("fa-arrow-left-long");
        $("#sidebar-1").addClass('active');
        $("#sidebar-2").addClass('active');
    });


    function handleEditImage(mediaId = null) {
        $.ajax({
            type: 'GET',
            url: `{{ route('media.show', ':id') }}`.replace(':id', mediaId),
            success: function(data) {

                $("#toggleButton .change-icon").addClass("fa-arrow-right-long");
                $('#sidebar-1').removeClass("active");
                $('#sidebar-2').addClass("active");
                $('#editbar-form').attr('action', `{{ route('media.update', ':id') }}`.replace(':id', data?.id));
                $('#editbar-image img').attr('src', `{{ asset('/') }}` + data?.image);
                $('#editbar-type input').val(data?.type);
                $('#editbar-alt input').val(data?.alt);
                $('#editbar-title input').val(data?.title);
                $('#editbar-created p').text(formatDate(data?.created_at));
                $('#editbar-updated p').text(formatDate(data?.updated_at));
            }
        })
    }

    function handleShowImage(mediaId = null) {
        $.ajax({
            type: 'GET',
            url: `{{ route('media.show', ':id') }}`.replace(':id', mediaId),
            success: function(data) {
                $("#toggleButton .change-icon").addClass("fa-arrow-right-long");
                $('#sidebar-2').removeClass("active");
                $('#sidebar-1').addClass("active");
                $('#sidebar-image').attr('src', `{{ asset('/') }}` + data.image);
                $('#sidebar-type p').text(data.type);
                $('#sidebar-alt p').text(data.alt);
                $('#sidebar-title p').text(data.title);
                $('#sidebar-created p').text(formatDate(data.created_at));
                $('#sidebar-updated p').text(formatDate(data.updated_at));
            }
        })
    }

    function handleUpdateImage(e) {
        e.preventDefault();
        let mediaTag = null;
        return $.ajax({
            type: 'POST',
            url: $('#editbar-form').attr('action'),
            data: new FormData($('#editbar-form')[0]),
            processData: false,
            contentType: false,
        }).then(data => {
            $('#sidebar-2').removeClass("active");
            $('#sidebar-1').addClass("active");
            data = data.data;
            $('#sidebar-image').attr('src', data.url);
            $('#sidebar-type p').text(data.type);
            $('#sidebar-alt p').text(data.alt);
            $('#sidebar-title p').text(data.title);
            $('#sidebar-created p').text(formatDate(data.created_at));
            $('#sidebar-updated p').text(formatDate(data.updated_at));
            const mediaWrapper = $('#media-' + data.id);
            if (data.type === 'image') {
                mediaTag = `<img src="${data.url}" alt="${data.alt}" title="${data.title}" style="width: 100px" class="">`;
            } else if (data.type === 'video') {
                mediaTag = `<video src="${data.url}" title="${data.title}" style="width: 100px"></video>`;
            }
            mediaWrapper.find('.media-image').html(mediaTag);
            mediaWrapper.find('.media-type').text(data.type);
            mediaWrapper.find('.media-updated').text(formatDate(data.updated_at));
            console.log(mediaWrapper.find('.media-image'));
            result = true;
        }).catch(error => {
            console.log(error);
            return false;
        });
    }

    function handleMediaDelete(event, mediaId = null) {
        event.preventDefault();
        const $form = $(event.target);
        $.ajax({
            type: 'POST',
            url: $form.attr('action'),
            data: $form.serialize(),
            success: function(data) {
                console.log(data);
                $('#media-' + mediaId).remove();
            }
        });
    }

    function formatDate(timestamp) {
        const date = new Date(timestamp);
        return date.toLocaleString('en-CA', {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit',
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        }).replace(',', '');
    }
</script>
@endpush