<form method="POST" action="{{ $route }}">
    @method('delete')
    @csrf

    <a
        href="#"
        onclick="event.preventDefault();
            this.closest('form').submit();"
        class="underline"
    >
        {{ $text }}
    </a>
</form>
