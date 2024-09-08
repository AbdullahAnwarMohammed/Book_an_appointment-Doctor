<?php

namespace App\Livewire\Employee;

use App\Models\Alhajz;
use App\Models\Group;
use App\Models\GroupPateint;
use App\Models\Patient;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RegisterAll extends Component
{
    public $statuses = [];
    public $id_register;
    public $search;
    public $date;

    public $login, $waiting, $exit;

    // info modal 
    public $modal_info;
    public $show_registers;



    public $more_table_data = false;

    // الجروب لمشاهدة الاشخاص
    public $group;


    // ادخال المطلوب و العلاج المتبقي الخ
    public $aleilaj,$almatlub,$almadfue,$almutabaqiy,$details;

    public $listeners = ['resetRegisterDone'];
    public function mount()
    {
        $this->initialize();
    }

    public function initialize()
    {
        $this->date = $this->date ?? date("Y-m-d");
        $this->loadStatuses();
    }

    public function loadStatuses()
    {
        $Registers = Alhajz::whereDate('register_days', $this->date)->get();

        foreach ($Registers as $item) {
            $this->statuses[$item->id] = $item->status;
        }
    }

    public function render()
    {
        // جميع الحجوزات
        $Alhajzs = Alhajz::whereDate('register_days', $this->date)->get();
        foreach ($Alhajzs as $item) {

            if ($item->status == 1) {
                GroupPateint::updateOrCreate(
                    [
                        'patient_id' => $item->patient_id,
                        
                    ],
                    [
                        'patient_id' => $item->patient_id,
                        'date' => $this->date,
                        'group_id' =>  $this->getIDGroupEmplyee($this->idEmployee(), 'غياب')[0]
                    ]
                );
            }

            if ($item->status == 2) {
                GroupPateint::where('patient_id',$item->patient_id) ->delete();   
            }
           
            if ($item->status == 3) {
                GroupPateint::updateOrCreate([
                    'patient_id' => $item->patient_id,
                    
                ], [
                    'patient_id' => $item->patient_id,
                    'date' => $this->date,
                    'group_id' =>  $this->getIDGroupEmplyee($this->idEmployee(), 'انتظار')[0]
                ]);
            }
            if ($item->status == 4) {
                GroupPateint::updateOrCreate([
                    'patient_id' => $item->patient_id,
                    
                ], [
                    'patient_id' => $item->patient_id,
                    'date' => $this->date,
                    'group_id' =>  $this->getIDGroupEmplyee($this->idEmployee(), 'حضور')[0]
                ]);
            }
        }


        // شريط المعلومات 
        $this->login = Alhajz::where('status', 4)->whereDate('register_days', $this->date)->count();
        $this->waiting = Alhajz::where('status', 3)->whereDate('register_days', $this->date)->count();
        $this->exit = Alhajz::where('status', 1)->whereDate('register_days', $this->date)->count();


        $this->date = $this->date ?? date("Y-m-d");

        $query = Alhajz::query()->whereDate('register_days', $this->date);

        if ($this->search) {
            $searchValue = $this->search;

            $query->whereHas('patient', function ($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%')
                    ->orWhere('phone', 'like', '%' . $searchValue . '%')
                    ->orWhere('cid', 'like', '%' . $searchValue . '%');
            })->orWhere('register_days', 'like', '%' . $searchValue . '%');
        }

        $Registers = $query->orderBy('number', 'asc')->paginate(10);

        return view('livewire.employee.register-all', [
            'Registers' => $Registers
        ]);
    }

    public function get_id($id)
    {
        $this->id_register = $id;
        $this->updateStatus($id);
    }

    public function handleRegister($id)
    {
        $Register = Alhajz::find($id);

        if ($Register && $Register->status == 1) {
            $Register->update(['status' => 2]);
            $this->statuses[$Register->id] = 2;
            $this->updateAdjacentRecords($Register->id);
        }
    }

    public function updateStatus($id)
    {
        if (!isset($this->statuses[$id])) {
            // Handle the case where the key doesn't exist
            return;
        }
    
        $Register = Alhajz::find($id);
    
        if ($Register) {
            $Register->update(['status' => $this->statuses[$id]]);
            if ($Register->status != 4) {
                $this->updateAdjacentRecords($id);
            }
        }
    }

    private function getIDGroupEmplyee($id, $name)
    {
        return Group::where('name', $name)->pluck('id');
    }

    private function idEmployee()
    {
        return Auth::guard('employee')->check() ? Auth::guard('employee')->user()->id : Auth::guard('doctor')->user()->id;
    }



    protected function updateAdjacentRecords($id)
    {
        // Get the previous and next records
        $previousRegisters = Alhajz::where('id', '<', $id)->orderBy('id', 'desc')->get();
        $nextRegister = Alhajz::where('id', '>', $id)->orderBy('id', 'asc')->first();

        if ($nextRegister && $nextRegister->status == 2) {
            $nextRegister->update(['status' => 3]);
            $this->statuses[$nextRegister->id] = 3;
        }

        foreach ($previousRegisters as $item) {
            if ($item->status == 2) {
                $item->update(['status' => 3]);
                $this->statuses[$item->id] = 3;
            }
        }
    }

    public function blocking($status, $id)
    {
        Patient::find($id)->update(['is_block' => $status]);
    }

    public function getINFO($id)
    {

        $this->modal_info = Patient::where('id', $id)->first();
        $this->dispatch('open-modal');
    }


    public function ShowRegisterHandler()
    {
        $this->more_table_data = true;
        $this->dispatch('open-modal');


        if(!empty($this->show_registers))
        {
            $this->details = $this->modal_info->alhajz($this->modal_info->id,$this->show_registers)->details;

            $Payment = Payment::where('patient_id',$this->modal_info->id)
            ->where('date',$this->show_registers)
            ->first();
            $this->aleilaj = $Payment ? $Payment['aleilaj'] : '';
            $this->almatlub = $Payment ? $Payment['almatlub'] : generalSetting()['default_money'];
            $this->almadfue = $Payment ? $Payment['almadfue'] : 0;
            $this->almutabaqiy = $this->almatlub - $this->almadfue;
    
            $Alhajz = Alhajz::where('patient_id',$this->modal_info->id)
            ->where('register_days',$this->show_registers)
            ->first();
            $this->details = $Alhajz->details;
    
            if($this->show_registers == 'الحجوزات')
            {
                $this->more_table_data = false;
              
            }
        }else{
            $this->more_table_data = false;
            $Payment=[];
        }
 

        

       

    }

    public function updateDATA($id){

        $almutabaqiy = $this->almatlub - $this->almadfue;
        Payment::updateOrCreate([
            'patient_id' => $id,
            'date' => $this->show_registers
        ],[
            'aleilaj' => $this->aleilaj,
            'almatlub' => $this->almatlub,
            'almadfue' => $this->almadfue,
            'almutabaqiy' => $almutabaqiy,
            'date' => $this->show_registers
        ]);

        Alhajz::updateOrCreate(
        [
            'patient_id' => $id,
            'register_days' => $this->show_registers
        ],
        [
            'details' => $this->details
        ]
    );

        $this->almutabaqiy = $almutabaqiy;

        $this->dispatch('open-modal');


    }
   
    public function resetRegister()
    {
        if (generalSetting()['reset_register']) {
            $this->dispatch('resetRegister');
        }
    }

    public function resetRegisterDone()
    {
        Alhajz::whereDate('register_days', date("Y-m-d"))->update([
            'status' => 1
        ]);

        $this->loadStatuses();
    }


    // فتح الجروب لمشاهدة الاشخاص
    public function openModal($id){
         $this->group = Group::where('id',$id)->first();
         $this->dispatch('open-modal-group');
    }
}
