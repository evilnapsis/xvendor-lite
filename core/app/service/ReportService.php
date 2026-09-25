<?php
namespace App\Service;

/**
 * Servicio para procesar datos de reportes de ventas por rango.
 */
class ReportService {
	public function getSalesReport($clientId, $start, $end): array {
		if (empty($clientId)) {
			return \SellData::getAllByDateOp($start, $end, 2);
		}
		return \SellData::getAllByDateBCOp($clientId, $start, $end, 2);
	}
}
