<?php
use \App\Page;

if (!function_exists('page')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function page($slug)
    {
        $page = Page::all();
        return $page;
    }
}
