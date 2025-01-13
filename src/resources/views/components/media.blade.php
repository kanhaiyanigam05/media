@props(['image' => '', 'name' => 'image', 'images' => [], 'label' => 'Image', 'type' => 'image', 'columns' => 'col-lg-2 col-md-3 col-4', 'multiple' => false])
<div class="mb-3 position-relative">
    <label for="image" class="form-label">{{ $label }}</label>
    <div class="gallery-images-wrapper list-images form-fieldset" data-columns="{{ $columns }}" {{ $multiple ? 'data-multiple=true' : '' }} data-name="{{ $name }}">
        <div class="mb-2 images-wrapper">
            <div data-bs-toggle="modal" data-bs-target="#imagesModel" class="text-center cursor-pointer default-placeholder-gallery-image" style="{{ $image || $images ? 'display: none' : '' }}">
                <div class="mb-3">
                    <svg class="icon icon-md text-secondary svg-icon-ti-ti-photo-plus" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M15 8h.01"></path>
                        <path d="M12.5 21h-6.5a3 3 0 0 1 -3 -3v-12a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v6.5"></path>
                        <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l4 4"></path>
                        <path d="M14 14l1 -1c.67 -.644 1.45 -.824 2.182 -.54"></path>
                        <path d="M16 19h6"></path>
                        <path d="M19 16v6"></path>
                    </svg>
                </div>
                <p class="mb-0 text-body">Click here to add more images.</p>
            </div>
            <div class="row w-100 list-gallery-media-images ui-sortable">
                @if ($image)
                <div class="{{ $columns }} gallery-image-item-handler mb-2">
                    <input type="hidden" name="{{ $name }}" value="{{ $image }}" class="hidden-media" id="hidden-input-imagesModel">
                    <div class="custom-image-box image-box">
                        <div class="preview-image-wrapper w-100">
                            <div class="preview-image-inner">
                                @if ($type == 'image')
                                <img class="preview-image w-100" src="{{ asset($image) }}" alt="{{ $image }}" title="{{ $image }}" style="width: 100px">
                                @elseif($type == 'video')
                                <video class="preview-image w-100" width="100px" autoplay muted>
                                    <source src="{{ asset($image) }}" type="video/mp4">
                                </video>
                                @endif
                                <div class="image-picker-backdrop"></div>
                                <span class="image-picker-remove-button">
                                    <button type="button" data-remove class="btn btn-sm btn-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm icon-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M18 6l-12 12"></path>
                                            <path d="M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </span>
                                <div data-bb-toggle="image-picker-edit" class="cursor-pointer image-box-actions"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @foreach ($images as $image)
                <div class="{{ $columns }} gallery-image-item-handler mb-2">
                    <input type="hidden" name="{{ $name }}" value="{{ $image }}" class="hidden-media" id="hidden-input-imagesModel">
                    <div class="custom-image-box image-box">
                        <div class="preview-image-wrapper w-100">
                            <div class="preview-image-inner">
                                @if ($type == 'image')
                                <img class="preview-image w-100" src="{{ asset($image) }}" alt="{{ $image }}" title="{{ $image }}" style="width: 100px">
                                @elseif($type == 'video')
                                <video class="preview-image w-100" width="100px" autoplay muted>
                                    <source src="{{ asset($image) }}" type="video/mp4">
                                </video>
                                @endif
                                <div class="image-picker-backdrop"></div>
                                <span class="image-picker-remove-button">
                                    <button type="button" data-remove class="btn btn-sm btn-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm icon-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M18 6l-12 12"></path>
                                            <path d="M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </span>
                                <div data-bb-toggle="image-picker-edit" class="cursor-pointer image-box-actions"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@once
@push('models')
@include('modal.media')
@endpush
@push('js')
<script>
    $(document).ready(function() {
        let component;

        // Event to capture the selected component
        $(document).on("click", ".default-placeholder-gallery-image, .custom-image-box", function() {
            component = $(this).closest('.gallery-images-wrapper');
            console.log(component.data('multiple'));
            $('.inp-cbx').prop('checked', false);
            $('.inp-cbx').on('change', function() {
                if (!component.data('multiple')) {
                    if ($(this).is(':checked')) {
                        $('.inp-cbx').not(this).prop('checked', false);
                        console.log('Only one image can be selected');
                    }
                }
            });
        });

        // Insert button click event
        $(".insert-btn").on("click", function() {
            let selectedImages = $('input[name="media[]"]:checked').map(function() {
                return $(this).val();
            }).get();

            // If no image is selected, prevent running the query
            if (!selectedImages || (Array.isArray(selectedImages) && selectedImages.length === 0)) {
                console.log('No images selected');
                return;
            }

            const URL = `{{ route('media.show', ':id') }}`;
            if (Array.isArray(selectedImages)) {
                selectedImages.forEach(function(imageId) {
                    handleImageInsertion(imageId, URL);
                });
            } else {
                handleImageInsertion(selectedImages, URL);
            }

            $(".imagesModel").modal("hide");
            // Uncheck the radio button after processing
            $('input[name="media"]').prop("checked", false);
        });

        function handleImageInsertion(imageId, URL) {
            const imageURL = URL.replace(':id', imageId);

            $.ajax({
                url: imageURL,
                type: "GET",
                success: function(data) {
                    let fileContent;
                    if (data.type === "image") {
                        fileContent = `<img class="preview-image w-100" src="{{ asset('/') }}${data.image}" alt="${data.alt}" title="${data.title}" style="width: 100px">`;
                    } else if (data.type === "video") {
                        fileContent = `<video class="preview-image w-100" width="100px" autoplay muted><source src="{{ asset('/') }}${data.image}" type="video/mp4"></video>`;
                    }
                    const columns = component.data('columns');
                    const name = component.data('name');

                    const columnImage = `
                        <div class="${columns} gallery-image-item-handler mb-2">
                            <input type="hidden" name="${name}" value="${data.image}" class="hidden-media">
                            <div class="custom-image-box image-box">
                                <div class="preview-image-wrapper w-100">
                                    <div class="preview-image-inner">
                                        ${fileContent}
                                        <div class="image-picker-backdrop"></div>
                                        <span class="image-picker-remove-button">
                                            <button type="button" data-remove class="btn btn-sm btn-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm icon-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M18 6l-12 12"></path>
                                                    <path d="M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </span>
                                        <div data-bb-toggle="image-picker-edit" class="cursor-pointer image-box-actions"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    // Append to the specific uploader instance
                    if (component.data('multiple')) {
                        component.find(".list-gallery-media-images").append(columnImage);
                    } else {
                        component.find(".list-gallery-media-images").html(columnImage);
                    }

                    component.find(".default-placeholder-gallery-image").hide();
                },
            });
        }
        // Open modal on image box click
        $(document).on("click", ".custom-image-box", function(event) {
            if (!$(event.target).is("[data-remove]")) {
                $(".imagesModel").modal("show");
            }
        });

        $("[data-remove]").on("click", function(event) {
            event.preventDefault();
            event.stopPropagation();
            const galleryWrapper = $(this).closest('.gallery-images-wrapper');
            $(this).closest(".gallery-image-item-handler").remove();
            const imageList = galleryWrapper.find('.list-gallery-media-images');
            if (imageList.children().length <= 0) {
                galleryWrapper.find(".default-placeholder-gallery-image").show();
            }
        });

    });
</script>
@endpush
@endonce