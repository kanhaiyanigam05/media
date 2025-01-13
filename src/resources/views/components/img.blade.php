@props(['src' => [], 'class' => null])
@if($src && $src->type === 'image')
<img src="{{ asset($src->file) }}" alt="{{ $src->alt }}" title="{{ $src->title }}" {{ $attributes->merge(['class' => $class]) }} />
@elseif($src && $src->type === 'video')
<video {{ $attributes->merge(['class' => $class]) }}>
    <source src="{{ asset($src->file) }}" type="video/mp4">
    Your browser does not support the video tag.
</video>
@endif