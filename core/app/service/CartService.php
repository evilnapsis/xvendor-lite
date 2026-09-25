<?php
namespace App\Service;

/**
 * Maneja $_SESSION['cart'], compartido historicamente entre el flujo de
 * Venta regular y el POS (mismo carrito, misma estructura: [{product_id, q}, ...]).
 */
class CartService {
	public function getCart(): array {
		return array_values($_SESSION['cart'] ?? []);
	}

	// Permite agregar productos al carrito sin restricción de inventario.
	public function addItem($productId, $qty): bool {
		if ($qty <= 0) {
			$qty = 1;
		}
		$cart = $this->getCart();
		$index = null;

		foreach ($cart as $i => $item) {
			if ($item['product_id'] == $productId) {
				$index = $i;
				break;
			}
		}

		if ($index !== null) {
			$cart[$index]['q'] += $qty;
		} else {
			$cart[] = ['product_id' => $productId, 'q' => $qty];
		}

		$_SESSION['cart'] = $cart;
		return true;
	}

	public function removeItem($productId): void {
		$cart = array_values(array_filter($this->getCart(), function($item) use ($productId) {
			return $item['product_id'] != $productId;
		}));
		$_SESSION['cart'] = $cart;
	}

	public function clear(): void {
		unset($_SESSION['cart']);
	}

	// Cada linea con su ProductData ya resuelto y el subtotal calculado, para las plantillas.
	public function getItemsWithProducts(): array {
		$items = [];
		foreach ($this->getCart() as $item) {
			$product = \ProductData::getById($item['product_id']);
			if (!$product) continue;
			$items[] = [
				'product' => $product,
				'q' => $item['q'],
				'subtotal' => $product->price_out * $item['q'],
			];
		}
		return $items;
	}

	public function getTotal(): float {
		$total = 0;
		foreach ($this->getItemsWithProducts() as $item) {
			$total += $item['subtotal'];
		}
		return $total;
	}
}
