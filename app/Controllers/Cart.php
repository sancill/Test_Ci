<?php

namespace App\Controllers;

class Cart extends BaseController
{
    /**
     * Update quantity dari AJAX request
     * Menerima POST request dengan JSON body: { quantity: number }
     */
    public function update_quantity()
    {
        // Set response header sebagai JSON
        header('Content-Type: application/json');

        // Check if POST request
        if ($this->request->getMethod() !== 'post') {
            return json_encode([
                'success' => false,
                'message' => 'Invalid request method'
            ]);
        }

        // Get JSON input
        $json = $this->request->getJSON();
        $quantity = isset($json->quantity) ? (int)$json->quantity : 0;

        // Validasi quantity
        if ($quantity < 1 || $quantity > 10) {
            return json_encode([
                'success' => false,
                'message' => 'Quantity harus antara 1-10'
            ]);
        }

        // Simpan ke session
        session()->set('product_quantity', $quantity);

        // Return success response
        return json_encode([
            'success' => true,
            'message' => 'Quantity updated successfully',
            'quantity' => $quantity,
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Get current quantity dari session
     */
    public function get_quantity()
    {
        header('Content-Type: application/json');

        $quantity = session()->get('product_quantity') ?? 1;

        return json_encode([
            'success' => true,
            'quantity' => $quantity
        ]);
    }
}
