<?php
class SeoHelper {
    public static function setMeta($title, $desc, $image = null) {
        $image = $image ?? 'https://golap-canon.com/default-share.jpg';
        echo "
        <title>$title | Golap-Canon</title>
        <meta name='description' content='$desc'>
        <!-- Open Graph / Facebook -->
        <meta property='og:type' content='website'>
        <meta property='og:title' content='$title'>
        <meta property='og:description' content='$desc'>
        <meta property='og:image' content='$image'>
        <!-- Twitter -->
        <meta property='twitter:card' content='summary_large_image'>
        <meta property='twitter:title' content='$title'>
        <meta property='twitter:description' content='$desc'>
        <meta property='twitter:image' content='$image'>
        ";
    }
}
?>