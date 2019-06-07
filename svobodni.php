<?php

require_once __DIR__ . '/index.php';

$html   =  getPageByUrl('http://svobzan.amur.ru/Vak.htm', 'windows-1251');

if ($html) {
    $pq     = phpQuery::newDocument($html);
    $table  = $pq->find("body > table:last > tbody");
    $rows   = $table->find("tr");

    $csfds  = [];

    foreach ($rows as $row) {
        $pq = pq($row);

        $csfds[] = [
            'title'         => trim($pq->find('td:eq(0)')->text()),
            'salary_start'  => (int)trim($pq->find('td:eq(2)')->text()),
            'education'     => trim($pq->find('td:eq(4)')->text()),
            'count'         => (int)trim($pq->find('td:eq(5)')->text()),
            'work_type'     => trim($pq->find('td:eq(6)')->text()),
            'organization'  => trim($pq->find('td:eq(7)')->text()),
            'address'       => trim($pq->find('td:eq(8)')->text()),
            'phone'         => trim($pq->find('td:eq(9)')->text()),
            'additionally'  => trim($pq->find('td:eq(10)')->text()),
        ];
    }

    $file = new \SplFileObject(SVOBODNI, 'w');
    $file->fwrite(serialize($csfds));
}