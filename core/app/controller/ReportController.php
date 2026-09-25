<?php
namespace App\Controller;

use App\Service\ReportService;
use ViewEngine;
use Req;

/**
 * Genera reportes de ventas filtrables por rango de fecha y cliente.
 */
class ReportController {
	private $reportService;

	public function __construct() {
		$this->reportService = new ReportService();
	}

	public function sales() {
		$sd = Req::get('sd', '');
		$ed = Req::get('ed', '');
		$clientId = Req::get('client_id', '');

		$sells = null;
		$total = 0;
		if ($sd !== '' && $ed !== '') {
			$sells = $this->reportService->getSalesReport($clientId, $sd, $ed);
			foreach ($sells as $sell) {
				$total += ($sell->total - $sell->discount);
			}
		}

		ViewEngine::render('reports/sales.html.twig', [
			'clients' => \PersonData::getClients(),
			'sells' => $sells,
			'total' => $total,
			'sd' => $sd,
			'ed' => $ed,
			'client_id' => $clientId,
		]);
	}
}
