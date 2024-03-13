<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\District;
use App\Models\Division;
use App\Models\Medium;
use App\Models\Payment;
use App\Models\Setting;
use App\Models\Subject;
use App\Models\Tclass;
use App\Models\Timely;
use App\Models\TuitionBook;
use App\Models\Tuition;
use App\Models\Tutor;
use App\Models\User;
use App\Models\Weekly;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class TuitionBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $status = 0;

        if ($request->application_details and $request->application_details == 'true') {
            return $this->application_details($request);
        }
        if ($request->pending_book && $request->pending_book == 'true') {
            return $this->pending_book($request);
        }

        if ($request->applied_book && $request->applied_book == 'true') {
            return $this->applied_book($request);
        }
        if ($request->booked_tuition && $request->booked_tuition == 'true') {
            return $this->booked_tuition($request);
        }
        if ($request->pending_charge && $request->pending_charge == 'true') {
            return $this->pending_charge($request);
        }
        if ($request->not_applied && $request->not_applied == 'true') {
            return $this->not_applied($request);
        }
        if ($request->rejected && $request->rejected == 'true') {
            return $this->rejected($request);
        }

        if ($request->not_applied) {
            $data['tuition_all'] = Tuition::orderBy('id', 'DESC')->with(['tuition_books'])->get();
        } else {
            $searching_2 = $this->searching_2($request);

            //যখন টিউশন ‘অ্যাপ্লায়েড হয়ে থাকবে, তখন যতজন পেন্ডিং এ পাঠানো হয়েছে, তাদের ডাটাও যেন আসে
            //পরবর্তীতে তাদের পাশাপাশি রাখা হবে।
            if ($status == 2) {
                $data['tuition_all'] = Tuition::orderBy('id', 'DESC')->with(
                    [
                        'tuition_books.user',
                        'tuition_books' => function ($q) use ($status) {
                            $q->where('status', $status)->orWhere('status', 0);
                        }
                    ]
                )->where($searching_2)->paginate(150);
            } else {
                $data['tuition_all'] = Tuition::orderBy('id', 'DESC')->with(['tuition_books' => function ($q) use ($status) {
                    $q->where('status', $status);
                }])->where($searching_2)->paginate(150);
            }
        }
        return view('backend.tuition_book.tuiton_list_with_info', $data, compact('request', 'status'));
    }



    public function applied_book($request)
    {

        $searching_2 = $this->searching_2($request);
        $data['name'] = 'Applied Tuition';
        $status = 2;
        $data['tuition_all'] = Tuition::with(['tuition_books' => function ($q) use ($status) {
            $q->where('status', $status)->orWhere('status', 0);
        }, 'tuition_books.user'])
            ->select(
                "tuitions.*",
                'tuitions.status as tuitions_status',
                'tuition_books.tuition_id',
            )
            // ->with('user')
            ->leftJoin('tuition_books', 'tuitions.id', '=', 'tuition_books.tuition_id')
            ->leftJoin('users', 'users.id', '=', 'tuition_books.user_id')
            ->where($searching_2)
            ->where(function ($q) use ($request) {
                if ($request->class_id) {
                    $q->whereJsonContains('tuitions.tclass', ["$request->class_id"]);
                }
            })
            ->orderBy("tuitions.id", 'DESC');

        $data['tuition_all'] = $data['tuition_all']->distinct(['tuitions.id'])->paginate(20);
        return view('backend.tuition_book.applied_tuiton_list_with_info', $data, compact('request', 'status'));
    }

    public function pending_book($request)
    {
        $data['name'] = 'Pending Tuition';
        $status = 0;
        $searching_2 = $this->searching_2($request);

        $data['tuition_all'] = Tuition::with(['tuition_books' => function ($q) use ($status) {
            $q->where('status', $status);
        }, 'tuition_books.user'])
            ->select(
                "tuitions.*",
                'tuitions.status as tuitions_status',
                'tuition_books.tuition_id',
            )
            ->leftJoin('tuition_books', 'tuitions.id', '=', 'tuition_books.tuition_id')
            ->leftJoin('users', 'users.id', '=', 'tuition_books.user_id')
            ->where($searching_2)
            ->where(function ($q) use ($request) {
                if ($request->class_id) {
                    $q->whereJsonContains('tuitions.tclass', ["$request->class_id"]);
                }
            })
            ->orderBy("tuitions.id", 'DESC');

        $data['tuition_all'] = $data['tuition_all']->distinct(['tuitions.id'])->paginate(30);

        return view('backend.tuition_book.pending_tuiton_list_with_info', $data, compact('request', 'status'));
    }

    public function booked_tuition($request)
    {
        $data['name'] = 'Booked Tuition';
        $status = 1;
        $searching_2 = $this->searching_2($request);

        $data['tuition_all'] = Tuition::with(['tuition_books' => function ($q) use ($status) {
            $q->where('status', $status);
        }, 'tuition_books.user'])
            ->select(
                "tuitions.*",
                'tuitions.status as tuitions_status',
                'tuition_books.tuition_id',
            )
            ->leftJoin('tuition_books', 'tuitions.id', '=', 'tuition_books.tuition_id')
            ->leftJoin('users', 'users.id', '=', 'tuition_books.user_id')
            ->where($searching_2)
            ->where(function ($q) use ($request) {
                if ($request->class_id) {
                    $q->whereJsonContains('tuitions.tclass', ["$request->class_id"]);
                }
            })
            ->where('tuitions.status', 2) //শুধু যেগুলো বুক করা হয়েছে।
            ->orderBy("tuitions.id", 'DESC');

        $data['tuition_all'] = $data['tuition_all']->distinct(['tuitions.id'])->paginate(30);
        return view('backend.tuition_book.booked_tuiton_list_with_info', $data, compact('request', 'status'));
    }

    public function pending_charge($request)
    {
        $status = 1;
        $data['name'] = 'Pending Charge';

        $searching_2 = $this->searching_2($request);

        $data['tuition_all'] = Tuition::with(['tuition_books' => function ($q) use ($status) {
            $q->where('status', $status);
        }, 'tuition_books.user'])
            ->select(
                "tuitions.*",
                'tuitions.status as tuitions_status',
                'tuition_books.tuition_id',
                'tuition_books.payment_status'
            )
            ->leftJoin('tuition_books', 'tuitions.id', '=', 'tuition_books.tuition_id')
            ->leftJoin('users', 'users.id', '=', 'tuition_books.user_id')
            ->where($searching_2)
            ->where(function ($q) use ($request) {
                if ($request->class_id) {
                    $q->whereJsonContains('tuitions.tclass', ["$request->class_id"]);
                }
            })
            ->where('tuitions.status', 2) //শুধু যেগুলো বুক করা হয়েছে।
            ->where('tuition_books.payment_status', '!=', 'Completed') //শুধু যেগুলো বুক করা হয়েছে।
            ->orderBy("tuitions.id", 'DESC');

        $data['tuition_all'] = $data['tuition_all']->distinct(['tuitions.id'])->paginate(30);


        return view('backend.tuition_book.pending_charge_tuiton_list_with_info', $data, compact('request', 'status'));
    }

    public function not_applied($request)
    {
        $data['name'] = 'Not Applied';
        $data['tuition_all'] = Tuition::with(['tuition_books'])
            ->select(
                "tuitions.*",
                'tuitions.status as tuitions_status',
                // 'tuition_books.tuition_id',
                DB::raw("(SELECT COUNT(tuition_books.id) FROM tuition_books
                                          WHERE tuition_books.tuition_id = tuitions.id
                                          GROUP BY tuition_books.tuition_id) as total_tuition_booked")
            )
            // ->leftJoin('tuition_books', 'tuitions.id', '=', 'tuition_books.tuition_id')
            ->orderBy('id', 'DESC')
            ->get();
        $data['tuition_all'] = $data['tuition_all']->where('total_tuition_booked', null);
        return view('backend.tuition_book.not_applied_tuiton_list_with_info', $data, compact('request'));
    }


    public function rejected($request)
    {
        $status = 3;
        $data['name'] = 'Rejected Application';

        $searching_2 = $this->searching_2($request);

        $data['tuition_all'] = Tuition::with(['tuition_books' => function ($q) use ($status) {
            $q->where('status', $status);
        }, 'tuition_books.user'])
            ->select(
                "tuitions.*",
                'tuitions.status as tuitions_status',
                'tuition_books.tuition_id',
            )
            ->leftJoin('tuition_books', 'tuitions.id', '=', 'tuition_books.tuition_id')
            ->leftJoin('users', 'users.id', '=', 'tuition_books.user_id')
            ->where($searching_2)
            ->where(function ($q) use ($request) {
                if ($request->class_id) {
                    $q->whereJsonContains('tuitions.tclass', ["$request->class_id"]);
                }
            })
            ->orderBy("tuitions.id", 'DESC');

        $data['tuition_all'] = $data['tuition_all']->distinct(['tuitions.id'])->paginate(30);

        return view('backend.tuition_book.rejected_tuiton_list_with_info', $data, compact('request', 'status'));
    }

    private function searching($request)
    {
        $search_items = [];

        if ($request->pending_book && $request->pending_book == 'true') {
            $search_items[] = ['status', '=', 0];
        }

        if ($request->applied_book && $request->applied_book == 'true') {
            $search_items[] = ['status', '=', 2];
        }

        if ($request->booked_tuition && $request->booked_tuition == 'true') {
            $search_items[] = ['status', '=', 1];
        }
        if ($request->rejected && $request->rejected == 'true') {
            $search_items[] = ['status', '=', 3];
        }
        if ($request->tuition_id && $request->tuition_id != '') {
            $search_items[] = ['tuition_id', '=', $request->tuition_id];
        }

        return $search_items;
    }


    public function application_details(Request $request)
    {

        // dd($request->all());

        if ($request->pending_book && $request->pending_book == 'true') {
            $data['name'] = 'Pending Tuition';
        }
        if ($request->applied_book && $request->applied_book == 'true') {
            $data['name'] = 'Applied Tuition';
        }
        if ($request->booked_tuition && $request->booked_tuition == 'true') {
            $data['name'] = 'Booked Tuition';
        }
        if ($request->pending_charge && $request->pending_charge == 'true') {
            $data['name'] = 'Pending Charge';
        }
        if ($request->not_applied && $request->not_applied == 'true') {
            $data['name'] = 'Not Applied';
        }
        if ($request->rejected && $request->rejected == 'true') {
            $data['name'] = 'Rejected Application';
        }

        $searching = $this->searching($request);

        $data['tuition_all'] = TuitionBook::with('tutor')->where($searching)->with(['payment' => function ($q) use ($request) {
            if ($request->pending_charge == 'true') {
                $q->where('status', 'Pending');
            }
        }])->orderBy('id', 'desc')->get();

        $data['divitions'] = Division::all();
        $data['districts'] = District::all();
        $data['areas'] = Area::all();
        $data['mediums'] = Medium::all();
        $data['tclass'] = Tclass::all();
        $data['subjects'] = Subject::all();
        $data['timelys'] = Timely::all();
        $data['weeklys'] = Weekly::all();
        $data['users'] = User::where('status', '1')->where('user_type', 'student')->orwhere('user_type', 'guardian')->get();
        $data['tuition'] = \App\Models\Tuition::find($request->tuition_id);
        $tutorId = $request->tuition_id;

        $tutor = Tutor::with('book_tuitions')->find($tutorId);
        // dd($data);
        return view('backend.tuition_book.index', $data, compact('request'));
    }
    // public function edit($id)
    // {
    //     $saveuser = User::find($id);
    //     $departments = Department::get();
    //     return view('admin.user_management.edit', compact('saveuser', 'departments'));
    // }
    public function application_edit($id)
    {
        // dd($id);
        $tuition = TuitionBook::find($id);
        return view('backend.tuition_book.application_edit', ['tuition' => $tuition]);
    }
    public function tution_edit($id)
    {
        $tuition = Tuition::find($id);
        $tclassOptions = Tclass::all();
        $subjectOptions = Subject::all();

        // dd( $tuition);

        return view('backend.tuition_book.tution_edit', compact('tuition', 'tclassOptions', 'subjectOptions'));
    }

    private function searching_2($request)
    {
        $search_items = [];
        if ($request->job_id && $request->job_id != '') {
            $search_items[] = ['tuitions.job_id', '=', $request->job_id];
        }
        if ($request->guardian_phone && $request->guardian_phone != '') {
            $search_items[] = ['tuitions.phone', '=', $request->guardian_phone];
        }
        if ($request->area_id && $request->area_id != '') {
            $search_items[] = ['tuitions.area_id', '=', $request->area_id];
        }

        if ($request->tutor_phone && $request->tutor_phone != '') {
            $search_items[] = ['users.phone', '=', $request->tutor_phone];
        }


        return $search_items;
    }



    public function delete_application(Request $request)
    {



        $ids = explode(',', $request->tuition_book_ids);

        foreach ($ids as $id) {
            $tuition_book = TuitionBook::where('id', $id)->first();
            if ($tuition_book == null) {
                continue;
            }
            $tuition_book->delete();
        }


        return back()->withSuccess('Message sent successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        if ($request->tuition_id && $request->tuition_id != '') {
            $data['current_tuition_from_tuition_list'] = Tuition::findOrFail($request->tuition_id);
        }

        $data['tuitions'] = Tuition::where('status', 1)->get();
        // $data['tutors'] = Tutor::where('status',1)->get();
        $data['users'] = User::where('status', 1)->get();

        $tutors = Tutor::select("tutors.id", "tutors.tutor_code", "users.name", "users.phone")
            ->leftJoin('users', 'users.id', '=', 'tutors.user_id')
            ->where('tutors.status', 1)
            ->orderBy('tutors.id', 'desc')
            ->get();
        $data['tutors'] = $tutors;
        return view('backend.tuition_book.create', $data, compact('request'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'tuition_id' => 'required',
            'tutor_id' => 'required',
            'user_id' => 'required',
        ]);

        $tuition = new TuitionBook;
        $tuition->tuition_id = $request->tuition_id;
        $tuition->tutor_id = $request->tutor_id;
        $tuition->user_id = $request->user_id;
        $tuition->salary = $request->salary;
        $tuition->payment_status = $request->payment_status;
        $tuition->details = $request->details;
        $tuition->status = $request->status;
        $tuition->save();

        $this->send_sms($tuition, $request);

        $payment = new Payment();
        $payment->tuition_book_id = $tuition->id;
        $payment->payment_for = 'tuition_book';
        $payment->amount = $request->media_charge_amount;
        $payment->media_charge_percent = $request->media_charge_percent;
        $payment->payment_type = $request->payment_type;
        $payment->transaction_id = rand(10, 15);
        $payment->currency = 'BDT';
        $payment->status = $request->payment_status == 'paid' ? 'Completed' : 'Pending';
        $payment->save();

        if ($tuition->status == '1') {
            $tui = Tuition::where('id', $request->tuition_id)->first();
            $tui->status = 2;
            $tui->save();
        }
        return redirect()->route('tuition_book.index')
            ->with('success', 'Tuition Book created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TuitionBook  $tuitionBook
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
    }
    public function status(TuitionBook $tuitionBook)
    {
        if ($tuitionBook->status == 0) {
            $status = 1;
        } else {
            $status = 0;
        }
        $tuitionBook = TuitionBook::findOrFail($tuitionBook->id);
        $tuitionBook->status = $status;
        $tuitionBook->save();

        return redirect()->route('tuition_book.index')
            ->with('success', 'Tuition  Book Status changes successfully.');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TuitionBook  $tuitionBook
     * @return \Illuminate\Http\Response
     */
    public function edit(TuitionBook $tuitionBook)
    {
        $data['current_tuition'] = Tuition::findOrFail($tuitionBook->tuition_id);
        $data['tuitions'] = Tuition::where('status', 1)->get();
        $data['tutors'] = Tutor::where('status', 1)->where('user_id', $tuitionBook->user_id)->get();
        $data['users'] = User::where('status', 1)->get();
        $data['tuitionBook'] = TuitionBook::findOrFail($tuitionBook->id);

        return view('backend.tuition_book.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TuitionBook  $tuitionBook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TuitionBook $tuitionBook)
    {
        $this->validate($request, [
            'tuition_id' => 'required',
            'tutor_id' => 'required',
        ]);

        $tuition_book = TuitionBook::find($tuitionBook->id);

        if ($tuition_book->tutor_id != $request->tutor_id) {
            $tuition_book = new TuitionBook();
        }


        $tuition_book->tuition_id = $request->tuition_id;
        $tuition_book->tutor_id = $request->tutor_id;
        $tuition_book->salary = $request->salary;
        $tuition_book->payment_status = $request->payment_status;
        $tuition_book->details = $request->details;
        $tuition_book->status = $request->status;
        $tuition_book->save();
        $this->send_sms($tuition_book, $request);


        $payment = Payment::where('tuition_book_id', $tuition_book->id)->first();

        if (!$payment) {
            $payment = new Payment();
        }
        $payment->tuition_book_id = $tuition_book->id;
        $payment->payment_for = 'tuition_book';
        $payment->amount = $request->media_charge_amount;
        $payment->media_charge_percent = $request->media_charge_percent;
        $payment->payment_type = $request->payment_type;
        $payment->transaction_id = rand(10, 15);
        $payment->currency = 'BDT';
        $payment->status = $request->payment_status;
        $payment->save();

        if ($tuition_book->status == '1') {
            $tui = Tuition::where('id', $request->tuition_id)->first();
            $tui->status = 2;
            $tui->save();

            $tuitionBook_rejects = TuitionBook::where('tuition_id', $request->tuition_id)->where('user_id', '!=', $tuitionBook->user_id)->get();
            if ($tuitionBook_rejects) {
                foreach ($tuitionBook_rejects as $tuitionBook_reject) {
                    $tuitionBook_reject->status = 3;
                    $tuitionBook_reject->save();
                }
            }
        }



        if ($request->move_to_next_stage == 'on' or $tuition_book->status == '3') {
            $redirect_to = '';
            if ($tuition_book->status == '0') {
                $redirect_to = 'pending_book=true';
            }
            if ($tuition_book->status == '2') {
                $redirect_to = 'applied_book=true';
            }
            if ($tuition_book->status == '3') {
                $redirect_to = 'applied_book=true';
            }
            if ($tuition_book->status == '1') {
                $redirect_to = 'booked_tuition=true';
            }

            return redirect("admin/tuition_book?application_details=true&tuition_id=$tuition_book->tuition_id&$redirect_to")
                ->with('success', 'Tuition Book Update successfully.');
        } else {
            $redirect_to = '';
            if ($tuition_book->status == '0') {
                $redirect_to = 'applied_book=true';
            }
            if ($tuition_book->status == '2') {
                $redirect_to = 'applied_book=true';
            }
            if ($tuition_book->status == '1') {
                $redirect_to = 'pending_book=true';
            }
            return redirect("admin/tuition_book?tuition_id=$tuition_book->tuition_id&$redirect_to")
                ->with('success', 'Tuition Book Update successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TuitionBook  $tuitionBook
     * @return \Illuminate\Http\Response
     */
    public function destroy(TuitionBook $tuitionBook)
    {
        //        return 'here';
        //        return $tuitionBook->all();
        //        $tuitionBook->delete();
        return back()->with('success', 'Tuition  Book deleted successfully.');
        //        return redirect()->route('tuition_book.index'+)
        //            ->with('success','Tuition  Book deleted successfully.');
    }


    private function tuition_status($status)
    {
        if ($status == 2) {
            return 'Applied';
        } elseif ($status == 0) {
            return 'Pending Book';
        } elseif ($status == 1) {
            return 'Booked';
        } else {
            return '-';
        }
    }


    private function send_sms($tuition_book, $request)
    {
        $status_name = $this->tuition_status($tuition_book->status);
        if ($tuition_book->status == 0 or $tuition_book->status == 1) {
            if ($request->send_sms_to_tutor == 'on') {
                $receiver_number = $tuition_book->tutor->user->phone;
                $guardian_number = $tuition_book->tuition->user->phone;
                $job_id = $tuition_book->tuition->job_id;

                $tuition_provider_name = $tuition_book->tuition->user->name;
                $tuition_provider_number = $tuition_book->tuition->user->phone;
                $tuition_provider_number_2 = $tuition_book->tuition->phone;

                if ($tuition_provider_number == $tuition_provider_number_2) {
                    $provider_numbers = $tuition_provider_number;
                } else {
                    $provider_numbers = $tuition_provider_number . ', ' . $tuition_provider_number_2;
                }

                $tuition_msg_txt = '';
                $tuition_msg_txt .= ", মোবাইল- $provider_numbers";

                if ($tuition_book->status == 0) {
                    $text = "আপনার আবেদনকৃত টিউশন কোড- $job_id, স্টাটাস- $status_name $tuition_msg_txt";
                    $text = "Dear Tutor, \n You are selected for demo class.  Id $job_id Guardian's phone: $guardian_number";
                } else {
                    $text = "আপনার আবেদনকৃত টিউশন কোড- $job_id, স্টাটাস- $status_name $tuition_msg_txt";
                }
                sendSms($receiver_number, $text);
            }


            if ($request->send_sms_to_tution_provider == 'on') {
                $receiver_number = $tuition_book->tuition->user->phone;
                $tutor_name = $tuition_book->tutor->user->name;
                $tutor_phone = $tuition_book->tutor->user->phone;

                $provider_tution_txt = '';
                $provider_tution_txt .= ", টিউটরের নাম- $tutor_name, মোবাইল- $tutor_phone";
                $text = "টিউশন কোড- $job_id, স্টাটাস- $status_name $provider_tution_txt";
                sendSms($receiver_number, $text);
            }
        }
    }

    public function update_note(Request $request)
    {
        // dd($request->all());  //to check all the data dumped from the form


        $tuition = Tuition::findOrFail($request->tuition_id);
        $tuition->note = $request->note;
        $tuition->update();
        return redirect()->to('/admin/tuition_book?applied_book=true');
    }
}
