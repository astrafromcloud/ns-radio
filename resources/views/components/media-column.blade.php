@if(in_array(pathinfo($getState(), PATHINFO_EXTENSION), ['mp4', 'webm', 'ogg']))
<div class="media-container">
    <video autoplay muted loop class="media-player">
        <source src="{{ asset('storage/' . $getState()) }}" type="video/{{ pathinfo($getState(), PATHINFO_EXTENSION) }}">
        Your browser does not support the video tag.
    </video>
</div>
@else
<div class="media-container">
    <img class="media-image" src="{{ asset('storage/' . $getState()) }}" alt="Media Image" />
</div>
@endif


<style>
    .media-container {
        position: relative;
        width: 350px;
        height: 150px;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }

    .media-player,
    .media-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        padding: 12px;
    }
</style>
