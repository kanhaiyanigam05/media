@props(['media' => []])
<tr class="table-active" id="media-{{ $media->id }}">
    <td scope="col" colspan="2">
        <div>
            <div class="checkbox-wrapper-4">
                <input class="inp-cbx" name="media[]" id="media-image-{{ $media->id }}" type="checkbox" value="{{ $media->id }}" />
                <label class="cbx" for="media-image-{{ $media->id }}">
                    <span>
                        <svg width="12px" height="10px">
                            <use xlink:href="#check-4"></use>
                        </svg>
                    </span>
                    <span class="media-image">
                        @if ($media->type == 'image')
                        <img src="{{ asset($media->image) }}" alt="{{ $media->alt }}" title="{{ $media->title }}" style="width: 100px" class="">
                        @elseif($media->type == 'video')
                        <video src="{{ asset($media->image) }}" title="{{ $media->title }}" style="width: 100px"></video>
                        @endif
                    </span>
                </label>
                <svg class="inline-svg">
                    <symbol id="check-4" viewbox="0 0 12 10">
                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                    </symbol>
                </svg>
            </div>
        </div>
    </td>
    <td scope="col">
        <div>
            <p class="m-0 text-capitalize media-type">{{ $media->type }}</p>
        </div>
    </td>
    <td scope="col">
        <div>
            <p class="m-0 media-updated">{{ $media->alt }}</p>
        </div>
    </td>
    <td scope="col">
        <div class="gap-2 d-flex">
            <form action="{{ route('media.destroy', $media->id) }}" method="POST" class="media-delete" onsubmit="handleMediaDelete(event, {{ $media->id }})">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure you want to delete this image?');" class="btn btn-danger">
                    <i class="fa-regular fa-trash-can"></i>
                </button>
            </form>
            <a href="javascript:void(0)" onclick="handleEditImage({{ $media->id }})" class="btn btn-warning" data-id="{{ $media->id }}">
                <i class="fa-solid fa-pencil"></i>
            </a>
            <a href="javascript:void(0)" onclick="handleShowImage({{ $media->id }})" class="btn btn-info" data-id="{{ $media->id }}">
                <i class="fa-regular fa-eye"></i>
            </a>
        </div>
    </td>
</tr>