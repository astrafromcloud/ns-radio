<div>
    <h3>Search Results:</h3>
    <ul>
        @if ($songs ?? null)
            @foreach ($songs as $song)
                <li>
                    <strong>{{ $song['name'] }}</strong> by {{ $song['artist'] }}
                    @if ($song['preview_url'])
                        <audio controls>
                            <source src="{{ $song['preview_url'] }}" type="audio/mpeg">
                        </audio>
                    @endif
                </li>
            @endforeach
        @else
            <li>No results found.</li>
        @endif
    </ul>
</div>
