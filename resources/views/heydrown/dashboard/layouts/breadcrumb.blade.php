<?php
$url = collect(explode('/', Request::path()));
$currentUrl = Request::path();
$link = '';
?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-white px-0 mt-2">
        @foreach ($url as $key => $value)
            @for ($i = 0; $i <= $key; $i++)
                <?php $link .= $url[$i] . '/'; ?>
            @endfor
            @if (rtrim($link, '/') == $currentUrl)
                <li class="breadcrumb-item active">{{ ucfirst($value) }}</li>
            @else
                <li class="breadcrumb-item">
                    <a class="text-decoration-none" href="/{{ rtrim($link, '/') }}">{{ ucfirst($value) }}</a>
                </li>
            @endif
            <?php $link = ''; ?>
        @endforeach
    </ol>
</nav>
