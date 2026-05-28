<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $slugs = [
            '20-kb-jpg-converter', '200kb-jpg-converter', '20kb-jpg-converter', '50kb-jpg-converter',
            'ai-image-generator', 'aspect-ratio-calculator', 'best-online-youtube-audio-downloader',
            'best-online-youtube-mp3-downloader', 'best-online-youtube-mp4-downloader',
            'best-online-youtube-video-downloader', 'best-youtube-downloader',
            'best-youtube-downloader-reddit', 'best-youtube-mp3-downloader',
            'best-youtube-video-downloader', 'bin-to-pdf-converter', 'cartoon-image-maker',
            'chrome-youtube-downloader', 'color-picker', 'convert-color-pdf-to-black-and-white',
            'convert-image-mb-to-kb', 'convert-image-to-jpg-200kb', 'convert-image-to-jpg-20kb',
            'convert-image-to-jpg-50kb', 'convert-ipynb-to-pdf', 'convert-youtube-to-mp3-hq',
            'convert-youtube-to-mp4-hd', 'crop-image', 'crop-pdf', 'crop-video', 'csv-to-srt-converter',
            'desktop-youtube-downloader', 'docx-to-pdf', 'download-entire-youtube-playlist',
            'download-music-from-youtube-video', 'download-shorts-from-youtube',
            'download-youtube-audio-mp3', 'download-youtube-audio-to-phone',
            'download-youtube-playlist', 'download-youtube-shorts', 'download-youtube-thumbnail',
            'download-youtube-video-from-url', 'download-youtube-video-mp4',
            'download-youtube-videos-to-computer', 'easy-youtube-audio-downloader',
            'easy-youtube-mp3-downloader', 'easy-youtube-mp4-downloader',
            'easy-youtube-video-downloader', 'epub-to-pdf', 'extract-images-pdf',
            'facebook-reels-downloader', 'facebook-video-downloader', 'fast-youtube-audio-downloader',
            'fast-youtube-downloader', 'fast-youtube-mp3-downloader', 'fast-youtube-mp4-downloader',
            'fast-youtube-video-downloader', 'firefox-youtube-downloader', 'flatten-pdf', 'flip-image',
            'free-audio-extractor', 'free-online-youtube-audio-downloader',
            'free-online-youtube-mp3-downloader', 'free-online-youtube-mp4-downloader',
            'free-online-youtube-video-downloader', 'free-youtube-4k-downloader',
            'free-youtube-downloader', 'free-youtube-mp3-downloader', 'free-youtube-playlist-downloader',
            'free-youtube-shorts-downloader', 'free-youtube-thumbnail-downloader',
            'free-youtube-video-downloader', 'gif-compressor', 'gif-maker', 'hd-video-downloader',
            'heic-to-gif', 'heic-to-jpg', 'heic-to-pdf', 'heic-to-png', 'heic-to-webp',
            'image-colorizer', 'image-compressor', 'image-enlarger', 'image-to-gif', 'image-to-text',
            'instagram-video-downloader', 'ipynb-to-pdf-converter', 'jfif-to-png', 'jpg-converter-50kb',
            'jpg-to-cdr-converter', 'jpg-to-pdf', 'jpg-to-png', 'kb-to-mb-image-converter',
            'mac-youtube-video-downloader', 'metadata-remover', 'mov-to-mp4', 'mp4-converter',
            'mp4-to-gif', 'mp4-to-mp3', 'my-youtube-downloader', 'ofx-to-pdf', 'online-youtube-downloader',
            'online-youtube-shorts-downloader', 'online-youtube-thumbnail-downloader',
            'online-youtube-video-downloader', 'organize-pdf', 'pdf-compressor', 'pdf-converter',
            'pdf-merge', 'pdf-split', 'pdf-to-epub', 'pdf-to-heic', 'pdf-to-image', 'pdf-to-jpg',
            'pdf-to-ofx', 'pdf-to-pub', 'pdf-to-text', 'pdf-to-word', 'pdf-to-xml', 'pdf-to-xml-converter',
            'png-to-jpg', 'png-to-svg', 'png-to-tiff', 'png-to-webp', 'protect-pdf', 'raw-video-data-tool',
            'reddit-youtube-video-downloader', 'resize-image', 'resize-pdf', 'rotate-image', 'rotate-pdf',
            'safe-youtube-downloader', 'safe-youtube-to-mp3-downloader',
            'safe-youtube-video-downloader-online', 'save-youtube-video-to-gallery',
            'secure-youtube-downloader', 'srt-merger', 'srt-time-shift', 'srt-to-csv-converter',
            'srt-to-txt-converter', 'svg-converter', 'tiktok-video-downloader', 'trim-video',
            'trusted-youtube-downloader', 'unlock-pdf', 'video-audio-pro', 'video-compressor',
            'video-converter', 'video-frame-storage', 'video-to-anime-converter', 'video-to-mp3',
            'virus-free-youtube-downloader', 'vtt-to-txt-converter', 'webm-to-gif', 'webp-to-jpg',
            'webp-to-png', 'working-youtube-downloader-reddit', 'y2mate-mp3-converter',
            'youtube-1080p-downloader', 'youtube-1080p-video-downloader-free',
            'youtube-4k-download-online', 'youtube-4k-downloader', 'youtube-4k-mp4-downloader',
            'youtube-4k-video-downloader', 'youtube-audio-downloader', 'youtube-audio-downloader-online',
            'youtube-audio-extractor', 'youtube-audio-ripper', 'youtube-clip-downloader',
            'youtube-clip-saver', 'youtube-content-downloader', 'youtube-direct-download-link',
            'youtube-download-mp4-video', 'youtube-downloader', 'youtube-downloader-1080p',
            'youtube-downloader-1080p-60fps', 'youtube-downloader-2023', 'youtube-downloader-2024',
            'youtube-downloader-2025', 'youtube-downloader-4k', 'youtube-downloader-android',
            'youtube-downloader-apk', 'youtube-downloader-app', 'youtube-downloader-audio',
            'youtube-downloader-audio-video', 'youtube-downloader-download-for-windows',
            'youtube-downloader-download-playlist', 'youtube-downloader-extension',
            'youtube-downloader-extension-chrome', 'youtube-downloader-for-mac', 'youtube-downloader-hd',
            'youtube-downloader-high-quality', 'youtube-downloader-ios', 'youtube-downloader-linux',
            'youtube-downloader-mac', 'youtube-downloader-mp3', 'youtube-downloader-mp3-and-video',
            'youtube-downloader-mp4', 'youtube-downloader-no-ads', 'youtube-downloader-online',
            'youtube-downloader-pc', 'youtube-downloader-reddit', 'youtube-downloader-safe',
            'youtube-downloader-safe-for-pc', 'youtube-downloader-software-for-windows',
            'youtube-downloader-to-mp3', 'youtube-downloader-video', 'youtube-downloader-windows',
            'youtube-downloaders', 'youtube-downloading-videos', 'youtube-downloads',
            'youtube-downloder-safe', 'youtube-full-video-downloader', 'youtube-hd-downloader',
            'youtube-hd-video-saver', 'youtube-high-quality-downloader', 'youtube-link-download',
            'youtube-link-downloader', 'youtube-list-downloader', 'youtube-long-video-downloader',
            'youtube-media-downloader', 'youtube-movie-downloader', 'youtube-mp3-converter-320',
            'youtube-mp3-converter-download', 'youtube-mp3-downloader', 'youtube-mp3-downloader-for-android',
            'youtube-mp3-downloader-for-iphone', 'youtube-mp3-downloader-for-mac',
            'youtube-mp3-downloader-for-mobile', 'youtube-mp3-downloader-for-pc',
            'youtube-mp3-downloader-online', 'youtube-mp3-downloader-site', 'youtube-mp4-download-online',
            'youtube-mp4-downloader', 'youtube-music-download-mp3', 'youtube-music-downloader',
            'youtube-music-grabber', 'youtube-offliner', 'youtube-online-downloader',
            'youtube-playlist-download-mp4', 'youtube-playlist-downloader',
            'youtube-playlist-downloader-online', 'youtube-playlist-downloder', 'youtube-playlist-saver',
            'youtube-playlist-to-mp3-downloader', 'youtube-playlist-video-downloader',
            'youtube-private-video-downloader', 'youtube-saver-online', 'youtube-short-download-mp4',
            'youtube-short-downloader', 'youtube-short-video-downloader', 'youtube-shorts-download-mp4',
            'youtube-shorts-download-online', 'youtube-shorts-downloader', 'youtube-shorts-downloder',
            'youtube-shorts-saver', 'youtube-shorts-video-downloader', 'youtube-sound-downloader',
            'youtube-tag-extractor', 'youtube-thumbnail-downloader', 'youtube-thumbnail-downloader-1080p',
            'youtube-thumbnail-downloader-hd', 'youtube-thumbnail-grabber', 'youtube-thumbnail-saver',
            'youtube-to-mp3-audio-saver', 'youtube-to-mp3-converter-online', 'youtube-to-mp3-downloader',
            'youtube-to-mp3-reddit', 'youtube-to-mp4-1080p', 'youtube-to-mp4-4k',
            'youtube-to-mp4-converter', 'youtube-to-mp4-converter-online', 'youtube-to-mp4-converter-reddit',
            'youtube-to-mp4-downloader', 'youtube-to-mp4-hd', 'youtube-to-mp4-high-quality',
            'youtube-ultra-hd-downloader', 'youtube-url-to-mp3', 'youtube-url-to-mp4',
            'youtube-vid-downloader', 'youtube-video-download-1080p', 'youtube-video-download-4k',
            'youtube-video-download-mp4', 'youtube-video-downloaded', 'youtube-video-downloader',
            'youtube-video-downloader-1080p', 'youtube-video-downloader-2024',
            'youtube-video-downloader-2025', 'youtube-video-downloader-4k', 'youtube-video-downloader-app',
            'youtube-video-downloader-for-android', 'youtube-video-downloader-for-iphone',
            'youtube-video-downloader-for-mac', 'youtube-video-downloader-for-mobile',
            'youtube-video-downloader-for-pc', 'youtube-video-downloader-free',
            'youtube-video-downloader-hd', 'youtube-video-downloader-high-quality',
            'youtube-video-downloader-mac', 'youtube-video-downloader-mp3', 'youtube-video-downloader-mp4',
            'youtube-video-downloader-no-malware', 'youtube-video-downloader-online',
            'youtube-video-downloader-pc', 'youtube-video-downloader-reddit', 'youtube-video-downloader-safe',
            'youtube-video-downloader-site', 'youtube-video-downloads', 'youtube-video-extractor',
            'youtube-video-fetcher', 'youtube-video-grabber', 'youtube-video-ripper', 'youtube-video-saver',
            'youtube-video-thumbnail-downloader', 'youtube-video-to-pdf-converter',
            'youtube-videos-downloader', 'yt-mp3-converter-download'
        ];

        DB::table('tool_analytics')->whereIn('tool_slug', $slugs)->delete();
        DB::table('tool_health_checks')->whereIn('tool_slug', $slugs)->delete();
        DB::table('failed_tool_logs')->whereIn('tool_slug', $slugs)->delete();
        DB::table('conversion_logs')->whereIn('tool_slug', $slugs)->delete();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Data cannot be restored via down migration.
    }
};
