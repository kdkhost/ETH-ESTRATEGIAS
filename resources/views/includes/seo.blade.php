@php
    $seo_title = $setting->title;
    $seo_desc = $setting->keywords; // fallback
    $seo_image = $setting->photo ? asset('images/media/' . $setting->photo->file) : asset('img/200x200.png');
    $seo_url = url()->current();

    if(isset($post)) {
        $seo_title = $post->meta_title ?: $post->title;
        $seo_desc = $post->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($post->body), 150);
        $seo_image = $post->photo ? asset('images/media/' . $post->photo->file) : $seo_image;
    } elseif(isset($project)) {
        $seo_title = $project->meta_title ?: $project->title;
        $seo_desc = $project->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($project->body), 150);
        $seo_image = $project->photo ? asset('images/media/' . $project->photo->file) : $seo_image;
    } elseif(isset($page)) {
        $seo_title = $page->meta_title ?: $page->title;
        $seo_desc = $page->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($page->body), 150);
        $seo_image = $page->photo ? asset('images/media/' . $page->photo->file) : $seo_image;
    } elseif(isset($service)) {
        $seo_title = $service->meta_title ?: $service->title;
        $seo_desc = $service->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($service->description), 150);
        $seo_image = $service->photo ? asset('images/media/' . $service->photo->file) : $seo_image;
    } elseif(View::hasSection('title')) {
        $seo_title = View::getSection('title') . ' | ' . $setting->title;
        if(View::hasSection('meta')) {
            $seo_desc = View::getSection('meta');
        }
    }
@endphp

<!-- Basic Meta Tags -->
<title>{{ $seo_title }}</title>
<meta name="description" content="{{ $seo_desc }}">
<link rel="canonical" href="{{ $seo_url }}">
<meta name="keywords" content="{{ $setting->keywords }}" />
<meta name="publisher" content="{{ url('/') }}">
<meta name="copyright" content="Copyright (c) {{ $setting->title }}" />
<meta name="author" content="{{ $setting->author }}" />
<meta name="contact" content="{{ $setting->contact }}" />
<meta name="revisit-after" content="7 Days" />
<meta name="robots" content="index, follow" />
<meta name="googlebot" content="index, follow" />

<!-- Schema.org -->
<meta itemprop="name" content="{{ $seo_title }}">
<meta itemprop="description" content="{{ $seo_desc }}">
<meta itemprop="image" content="{{ $seo_image }}">

@if($setting->OGgraph_switch == 1)
<!-- Open Graph / Facebook / WhatsApp -->
<meta property="og:type" content="website" />
<meta property="og:url" content="{{ $seo_url }}" />
<meta property="og:title" content="{{ $seo_title }}" />
<meta property="og:description" content="{{ $seo_desc }}" />
<meta property="og:image" content="{{ $seo_image }}" />
<meta property="og:site_name" content="{{ $setting->author }}" />

<!-- Twitter Cards -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="{{ $seo_url }}">
<meta name="twitter:title" content="{{ $seo_title }}">
<meta name="twitter:description" content="{{ $seo_desc }}">
<meta name="twitter:image" content="{{ $seo_image }}">
@endif
