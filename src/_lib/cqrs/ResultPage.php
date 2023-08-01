<?php

namespace _lib\cqrs;

class ResultPage
{
    public static function toResultPagination(
        ?int $current,
        ?int $pageSize,
        ?int $totalElements,
    ) {

        $totalPages = ceil($totalElements / $pageSize);

        return [
            'totalPages' => $totalPages,
            'pageSize' => $pageSize,
            'totalElements' => $totalElements,
            'current' => $current,
            'first' => $current === 1,
            'last' => $current === $totalPages
        ];
    }
}