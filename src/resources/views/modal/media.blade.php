<!-- Modal -->
<div class="modal fade imagesModel" id="imagesModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <div class="file-uploader-sec">
                    <div class="flex-wrap upper-header-section d-flex justify-content-between flex-sm-nowrap">
                        <div class="flex-wrap gap-2 px-2 py-2 d-flex flex-sm-nowrap">
                            <div class="btn-group">
                                <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-upload"></i> Upload
                                    <i class="fa-solid fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item staticBackdropOpen" href="javascript:void(0)" type="button" data-bs-toggle="modal" data-bs-target="#uploadImage"><i class="fa-solid fa-upload"></i>
                                            Upload from local</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop1"><i class="fa-solid fa-link"></i>
                                            Upload from URL</a>
                                    </li>
                                </ul>
                            </div>
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                                <i class="fa-solid fa-folder-plus"></i>
                            </button>
                            <button type="button" class="btn btn-secondary">
                                <i class="fa-solid fa-arrows-rotate"></i>
                            </button>
                            <div class="btn-group">
                                <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-eye"></i>(<i class="fa-solid fa-globe"></i> All Media
                                    )<i class="fa-solid fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="#"><i class="fa-solid fa-globe me-2"></i>All
                                            Media</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#"><i class="fa-regular fa-trash-can me-2"></i>Trash</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#"><i class="fa-regular fa-clock me-2"></i>Recent</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#"><i class="fa-regular fa-star me-2"></i>Favorites</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="px-2 py-2">
                            <form class="gap-0 d-flex" role="search">
                                <input class="form-control" type="search" placeholder="Search in current folder" aria-label="Search" />
                                <button class="btn btn-outline-success" type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="flex-wrap px-3 py-3 upper-header-section-2 d-flex justify-content-between flex-sm-nowrap">
                        <div class="all-media-icon">
                            <button><i class="fa-regular fa-image"></i> All Media</button>
                        </div>
                        <div class="flex-wrap gap-2 d-flex flex-sm-nowrap">
                            <div class="btn-group sorting-menu-sec">
                                <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span>A-Z</span> Short
                                    <i class="fa-solid fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="#"><i class="fa-solid fa-arrow-down-a-z drop-i"></i>
                                            File Name- ASC</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#"><i class="fa-solid fa-arrow-up-z-a drop-i"></i>File
                                            Name- DESC</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#"><i class="fa-solid fa-arrow-up-1-9 drop-i"></i>Uploaded Date-
                                            ASC</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#"><i class="fa-solid fa-arrow-down-9-1 drop-i"></i>Uploaded
                                            Date-
                                            DESC</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#"><i class="fa-solid fa-arrow-down-short-wide drop-i"></i>Size-
                                            DESC</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#"><i class="fa-solid fa-arrow-down-wide-short drop-i"></i>Size
                                            Date-
                                            DESC</a>
                                    </li>
                                </ul>
                            </div>
                            <button type="button" class="btn btn-primary action-button">
                                <i class="fa-regular fa-hand-pointer hand-icons"></i> Actions
                            </button>
                            <button id="toggleButton" class="btn btn-primary action-button ">
                                <i class="fa-solid fa-arrow-left-long change-icon"></i>
                            </button>
                        </div>
                    </div>
                    <div class="upper-header-section-3 d-flex position-relative flex-column flex-sm-row">
                        <div class="table-responsive w-100">
                            <table class="table mb-0 file-table">
                                <thead>
                                    <tr>
                                        <th scope="col" colspan="2"></th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Alt Text (Name)</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="uploaded-files">
                                    @foreach (\Media\Models\Media::all() as $media)
                                    <x-media-item :media="$media" />
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="file-description active list image-sidebar sidebar-2" id="sidebar-2">
                            <div class="item">
                                <div class="text-center file-symbol">
                                    <img src="" id="sidebar-image" alt="">
                                </div>
                                <div class="file-details">
                                    <div id="sidebar-alt">
                                        <strong>Alt</strong>
                                        <p>name</p>
                                    </div>
                                    <div id="sidebar-title">
                                        <strong>Title</strong>
                                        <p>name</p>
                                    </div>
                                    <div id="sidebar-type">
                                        <strong>Type</strong>
                                        <p>image</p>
                                    </div>
                                    <div id="sidebar-created">
                                        <strong>Uploaded at</strong>
                                        <p>2024-09-27 02:31:38</p>
                                    </div>
                                    <div id="sidebar-updated">
                                        <strong>Modified at</strong>
                                        <p>2024-09-27 02:31:38</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="file-description active list image-sidebar sidebar-1" id="sidebar-1">
                            <form id="editbar-form" class="item" method="POST" onsubmit="handleUpdateImage(event)">
                                @csrf
                                @method('PUT')
                                <div class="text-center file-symbol" id="editbar-image">
                                    <img src="" alt="">
                                    <input type="file" name="image" class="w-100 form-control">
                                </div>
                                <div class="relative file-details">
                                    <div id="editbar-alt">
                                        <label class="form-label">Alt</label>
                                        <input class="form-control" name="alt" placeholder="alt" />
                                    </div>
                                    <div id="editbar-title">
                                        <label class="form-label">Title</label>
                                        <input class="form-control" name="title" placeholder="title" />
                                    </div>
                                    <div id="sidebar-type">
                                        <strong>Type</strong>
                                        <p>image</p>
                                    </div>
                                    <div id="editbar-created">
                                        <strong>Uploaded at</strong>
                                        <p>2024-09-27 02:31:38</p>
                                    </div>
                                    <div id="editbar-updated">
                                        <strong>Modified at</strong>
                                        <p>2024-09-27 02:31:38</p>
                                    </div>
                                    <div class="flex justify-end">
                                        <button type="submit" class="btn btn-success">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>


                    </div>
                </div>
                <button type="button" class="btn btn-primary insert-btn">Insert</button>
            </div>
        </div>
    </div>
</div>

<!-- file-upload modal -->
<div class="modal fade" id="staticBackdrop" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Upload Files Here</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="dropzone">
                    <form action="{{ route('media.store') }}" method="POST" enctype="multipart/form-data" class="dropzone needsclick" id="demo-upload">
                        @csrf
                        <div class="dz-message needsclick">
                            <span class="text">
                                <img src="http://www.freeiconspng.com/uploads/------------------------------iconpngm--22.png" alt="Camera" />
                                Drop files here or click to upload.
                            </span>
                            <span class="plus">+</span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#imagesModel">Back</button>
            </div>
        </div>
    </div>
</div>
<!-- file-upload modal -->
<!-- file-upload from url modal -->
<div class="modal fade" id="staticBackdrop1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <form id="upload-files" action="{{ route('media.upload.url') }}" method="POST" class="modal-content">
            <div class="loading-spinner"></div>
            @csrf
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Upload Files from URL</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2 shadow-none form-floating">
                    <textarea class="shadow-none form-control" name="media" placeholder="Enter URL Here" id="floatingTextarea2" style="height: 100px"></textarea>
                    <label for="floatingTextarea2" style="font-size: 12px">https://www.google.com,
                        https://www.google.com, https://www.google.com,
                    </label>
                </div>
                <small>Enter one URL per line.</small>
            </div>
            <div class="modal-footer">
                <div class="flex w-100">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-upload"></i> Upload
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#imagesModel">Back</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- file-upload from url modal -->
<!-- create-folder modal -->
<div class="modal fade" id="staticBackdrop2" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Folder</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="d-flex" role="search">
                    <input class="shadow-none form-control me-0 rounded-0" type="text" placeholder="create" aria-label="Search" />
                    <button class="btn btn-primary rounded-0" type="submit">Create</button>
                </form>
            </div>
            <div class="modal-footer border-top-0"></div>
        </div>
    </div>
</div>
<!-- create-folder modal -->
@include('modal.js')
