<?php

class Resi {
    /**
     * 
     * @param string $keyword
     * @return array
     */
    public function getResi($keyword) {
        
        $resiData = [
            [
                'courier' => [
                    'name' => 'DnS Express',        //Speed in Delivery
                    'method' => 'Reguler'
                ],
                'resi_number' => 'DNS123456789',
                'product' => 'Baju',
                'destination' => 'Jl. Kebon Jeruk No. 25, Jakarta'
            ],
            [
                'courier' => [
                    'name' => 'DnS Express',
                    'method' => 'Ongkos Kirim Ekonomis'
                ],
                'resi_number' => 'DNS987654321',
                'product' => 'Celana',
                'destination' => 'Jl. Pemuda No. 10, Surabaya'
            ]
        ];

        
        $filteredData = array_filter($resiData, function($resi) use ($keyword) {
            return stripos($resi['product'], $keyword) !== false;
        });

        return array_values($filteredData);
    }
}
