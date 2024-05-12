<?php

class template {
    protected $layoutPage;
    public function __construct($layoutPage)
    {
        $this->layoutPage = $layoutPage;
    }

    public function viewPage($pageName,$pageSections)
    {
        include VIEW_PATH . $this->layoutPage . '.html';
    }

    public function viewSection($pageName,$pageSections)
    {
        foreach ($pageSections as $section) {
            include VIEW_PATH . "$pageName".'/' . $section . '.html';
        }
    }

}