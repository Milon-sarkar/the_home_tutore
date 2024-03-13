<?php

namespace App\Http\Controllers;

use PDF; // Import the PDF facade
use App\Models\Invoice;
use App\Models\Tuition;

class InvoiceController extends Controller
{
    public function generateInvoice(Tuition $tuition)
    {
        // Assuming you have a relationship between Tuition and User models
        $user = $tuition->user;

        // Check if $user->user is not null before accessing its properties
        $userName = $user->user ? $user->user->name : 'Unknown User';

        // Calculate total amount
        $amount = $tuition->calculateTotalAmount();

        // Create an invoice for the user
        $invoice = Invoice::create([
            'user_id' => $user->id,
            'user_Name' => $userName,
            'amount' => $amount,
            // Other fields...
        ]);

        // Generate PDF using the PDF facade
        $pdf = PDF::loadView('invoices.invoice', compact('user', 'amount', 'userName','invoice'));

        return $pdf->download('invoice.pdf');
    }
}