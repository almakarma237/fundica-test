<?php

namespace _lib\cqrs;
class Pagination
{
    private int $page;
    private int $pageSize;

    public function __construct(?int $page, ?int $pageSize)
    {
        $this->page = $page;
        $this->pageSize = $pageSize;
    }

    public function page()
    {
        return $this->page;
    }

    public function pageSize()
    {
        return $this->pageSize;
    }
}