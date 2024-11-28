<?php
class TrackingService {
    protected $trackingData;

    public function __construct() {
        // Simulasi data pelacakan untuk berbagai Order ID
        $this->trackingData = [
            "FAHMI123" => [
                "status" => "In Transit",
                "location" => "Jakarta",
                "estimated_delivery" => "2024-11-15"
            ],
            "ORDER456" => [
                "status" => "Delivered",
                "location" => "Bandung",
                "estimated_delivery" => "2024-11-10"
            ],
            "ORDER789" => [
                "status" => "Processing",
                "location" => "Surabaya",
                "estimated_delivery" => "2024-11-20"
            ]
        ];
    }

    /**
     * Mengambil status pelacakan berdasarkan Order ID.
     * @param string $orderId
     * @return array
     */
    public function getTrackingStatus($orderId) {
        return $this->trackingData[$orderId] ?? [
            "status" => "Unknown",
            "location" => "N/A",
            "estimated_delivery" => "N/A"
        ];
    }
}
