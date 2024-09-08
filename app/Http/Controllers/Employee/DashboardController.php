<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view("employee.index");
    }
    public function customers()
    {
        return view("doctor.customers");
    }
    public function customerModal(Request $request)
    {
        $id = $request->id;
        $patient = Patient::where('id', $id)->first();
        $gender = $patient->gender == 1 ? "ذكر" : "انثي";
        $data = '';

        $data .= '
                            <h6 class="text-uppercase mb-2">معلومات شخصية</h6>

        <table class=" table table-borderless" style="background:#f6ffea;box-shadow: 4px 7px 5px -3px rgba(0,0,0,0.17);
">
        <tr>
        <td><strong>الاسم</strong> : ' . $patient->name . '</td>
        </tr>
        <tr>
        <td>الجنس : ' . $gender . '</td>
        </tr>
        <tr>
        <td>الهاتف : ' . $patient->phone . '</td>
        </tr>
        <tr>
        <td>رقم البطاقة : ' . $patient->cid . '</td>
        </tr>
         <tr>
        <td>المدينة : ' . $patient->city . '</td>
        </tr>
         <tr>
        <td>الطول : ' . $patient->height     . '</td>
        </tr>
          <tr>
        <td>الوزن : ' . $patient->weight . '</td>
        </tr>
           <tr>
        <td>الحالة الاجتماعية : ' . $patient->marital_status . '</td>
        </tr>
           <tr>
        <td>تاريخ الميلاد    : ' . $patient->date_of_birth . '</td>
        </tr>
            <tr>
        <td>تاريخ التسجيل    : ' . $patient->created_at . '</td>
        </tr>
        </table>
          <h6 class="text-uppercase mb-2 fw-bold text-danger">السجلات</h6>

        ';
        $data .= '  <table class="table table-striped text-center">
         <tr>
            <th>#</th>
            <th>تاريخ الحجز </th>
            <th>رقم الحجز</th>
            <th>الحالة</th>
            <th>السبب</th>
            </tr>
        ';
        $i = 1;
        $status='';
        
        foreach ($patient->alhajzs as $item) {
            if ($item->status == 1) {
                $status = ' <span class="badge bg-danger">لم يتم الحضور</span>';
            } elseif ($item->status == 2) {
                $status = '<span class="badge bg-primary">دخول</span>';
            } elseif ($item->status == 3) {
                $status = '  <span class="badge bg-warning">انتظار</span>';
            } else {
                $status = ' <span class="badge bg-success">تم الحضور</span>';
            }

            $data .= '
            <tr>
            <td>' . $i++ . '</td>
            <td>' . $item->register_days . '</td>
            <td>'.$item->number.'</td>
            <td>'.$status.'</td>
            <td>' . $item->reason->name . '</td>

            </tr>

            ';
        }
        $data .= '</table>';
        echo $data;
    }

 
}
