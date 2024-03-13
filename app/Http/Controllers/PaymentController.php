<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // payment list
        $name =null;
        $phone =null;
        $date =null;
        $enddate =null;
        $status =null;
        $payment_type =null;
       // $batches = Batch::all();

        $search_items = [];
        if ($request->date){
            $date = $request->date;
            $search_items[] = ['created_at', '>=',$request->date.' 00:00:00'];
        }
        if ($request->enddate){
            $enddate = $request->enddate;
            $search_items[] = ['created_at', '<=', $request->enddate.' 23:59:59'];
        }

        if ($request->transaction_id){
            $type = $request->transaction_id;
            $search_items[] = ['transaction_id', 'like', '%' . $request->transaction_id . '%'];
        }
        if ($request->payment_type){
            $type = $request->payment_type;
            $search_items[] = ['payment_type', 'like', '%' . $request->payment_type . '%'];
        }

        //$search_items[] = ['status', '=', 'Completed'];
        $data['payment_list'] = Payment::with('tutor_book')->where($search_items)->where('status','=','Completed')->orderBy('id', 'desc')->get();

        $data['request'] = $request;
       //dd($request->all());
       // $payments = $payments->paginate(50);
        return view('backend.payment.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
