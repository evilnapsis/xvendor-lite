<?php
namespace App\Service;

/**
 * Procesa ventas, validaciones de stock previa a transacción y eliminación de registros.
 */
class SellService {
	public function getAllSells(): array {
		return \SellData::getSells();
	}

	public function getSellById($id) {
		return \SellData::getById($id);
	}

	public function getSellOperations($id): array {
		return \OperationData::getAllProductsBySellId($id);
	}

	// Misma logica que delsell-view.php: borra las operaciones y la venta (no repone inventario).
	public function deleteSell($id): void {
		foreach ($this->getSellOperations($id) as $operation) {
			$operation->del();
		}
		$sell = \SellData::getById($id);
		if ($sell) {
			$sell->del();
		}
	}

	/**
	 * Crea la venta y sus operaciones de detalle (salida). Retorna ['success'=>bool, 'sell_id'=>?, 'error'=>?].
	 */
	public function checkout(array $cartItems, array $postData, $userId): array {
		if (empty($cartItems)) {
			return ['success' => false, 'sell_id' => null, 'error' => 'El carrito esta vacio.'];
		}

		$sell = new \SellData();
		$sell->user_id = $userId;
		$sell->total = $postData['total'] ?? 0;
		$sell->discount = $postData['discount'] ?? 0;

		if (!empty($postData['client_id'])) {
			$sell->person_id = $postData['client_id'];
			$result = $sell->add_with_client();
		} else {
			$result = $sell->add();
		}
		$sellId = $result[1];

		$salidaId = \OperationTypeData::getByName('salida')->id;
		foreach ($cartItems as $item) {
			$operation = new \OperationData();
			$operation->product_id = $item['product_id'];
			$operation->operation_type_id = $salidaId;
			$operation->sell_id = $sellId;
			$operation->q = $item['q'];
			$operation->add();
		}

		return ['success' => true, 'sell_id' => $sellId, 'error' => null];
	}
}
