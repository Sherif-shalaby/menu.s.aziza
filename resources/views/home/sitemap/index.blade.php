<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @if($Product != null)
        <sitemap>
            <loc>{{ route('sitemap.posts.index') }}</loc>
            <lastmod>{{ $Product->updated_at->tz('UTC')->toAtomString() }}</lastmod>
        </sitemap>
    @endif
</sitemapindex>