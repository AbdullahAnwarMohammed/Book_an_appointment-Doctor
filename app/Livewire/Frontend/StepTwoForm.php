<?php

namespace App\Livewire\Frontend;

use App\Models\Alhajz;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StepTwoForm extends Component
{
    public $cid, $error = false, $form = false, $register_days, $hour, $number, $reason_id;
    public $register_already = false;
    public $type_work, $number_of_patients, $patient_id;
    public $DayBreak, $working_hours, $patient_minutes, $start_work;

    public $break_day_message = false;
    public $not_available = false;
    public function mount()
    {
        $settings = generalSetting();
        $this->DayBreak = $settings['break'];
        $this->working_hours = $settings['working_hours'];
        $this->patient_minutes = $settings['patient_minutes'];
        $this->start_work = $settings['start_work'];
        $this->type_work = $settings['type_work'];
        $this->number_of_patients = $settings['number_of_patients'];

        if(Auth::guard('patient')->user())
        {
            $this->cid = Auth::guard('patient')->user()->cid;
        }
    }

    public function render()
    {
        $this->prepareStartTime();

        if ($this->register_days) {
          

            $start_register = generalSetting()['start_register'];
            $end_register = generalSetting()['end_register'];

            if (($start_register && $this->register_days < $start_register) || ($end_register  && $this->register_days > $end_register)) {
                $this->register_days = null; // Clear the selected date
                 $this->break_day_message = false;
                $this->not_available = true;
            }else{
                $this->not_available = false;

            }


            $Patient = $this->getPatientByCid($this->cid);

            if ($this->isDayABreak($this->register_days)) {
                $this->register_days = null;
                $this->not_available = false;
                $this->break_day_message = true;
                // $this->dispatch('day_is_break');
            } else {
                    if($Patient)
                    {

                
                    $this->break_day_message = false;

                    $this->patient_id = $Patient->id;
                    if ($this->checkPatientAlreadyRegisteredToday($Patient->id)) {
                        // لو هو حاجز
                        $this->register_already = true;
                    } else {
                        $this->processRegistration($this->register_days);
                    }
                }
               
            }
        }

        $Patient = $this->checkPatientExistsAndUpdateForm($this->cid);

        return view('livewire.frontend.step-two-form', ['Patient' => $Patient]);
    }

    private function prepareStartTime()
    {
        if (is_string($this->start_work)) {
            $this->start_work = explode(":", $this->start_work);
        }
    }

    private function getPatientByCid($cid)
    {
        return Patient::where('cid', $cid)->orWhere('phone',$cid)->first();
    }

    private function isDayABreak($register_days)
    {
        $dayOfWeek = date('w', strtotime($register_days));
        return in_array($dayOfWeek, $this->DayBreak);
    }

    private function checkPatientAlreadyRegisteredToday($patient_id)
    {
        return Alhajz::where('patient_id', $patient_id)
            ->whereDate('register_days', $this->register_days)
            ->count() > 0;
    }

    private function processRegistration($register_days)
    {
        $patients_register_today = Alhajz::whereDate('register_days', $register_days)->count();

        if ($this->type_work == 1) {
            // Processing based on the number of patients
        } else {
            // Processing based on working hours
            $working_hours_by_minutes = $this->working_hours * 60;
            $minutesToAdd = $patients_register_today * $this->patient_minutes;
            $time = Carbon::createFromTime($this->start_work[0], $this->start_work[1], 0);
            $newTime = $time->addMinutes($minutesToAdd);
            $this->hour = $newTime->format('h:i A');
            $this->register_already = false;
        }
    }

    private function checkPatientExistsAndUpdateForm($cid)
    {
        if (strlen($cid)) {

            if(Auth::guard('patient')->user())
            {
                $this->cid = Auth::guard('patient')->user()->cid;
            }

            $Patient = $this->getPatientByCid($cid);
            if ($Patient) {
                if ($Patient->LastRegister() && $Patient->LastRegister()->status != 4) {
                    // لو هو حاجز 
                    if ($Patient->status != 4) {
                        $this->register_already = true;
                        $this->form = false;
                    } else {
                        $this->form = true;
                    }
                } else {
                    $this->form = true;
                }
                $this->error = false;

                return $Patient;
            } else {
                $this->register_already = false;
                $this->error = true;
                $this->form = false;
            }
        } else {
            $this->register_already = false;
            $this->error = false;
            $this->form = false;
        }
        return null;
    }

    public function addHandler()
    {
        $this->validate([
            'register_days' => 'required',
            'number' => 'required',
            'reason_id' => 'required',
        ]);

        Alhajz::create([
            'patient_id' => $this->patient_id,
            'register_days' => $this->register_days,
            'hour' => $this->hour,
            'reason_id' => $this->reason_id,
            'status' => 1,
            'number' => $this->number,
        ]);

        $this->resetDATA();
    }

    public function resetDATA()
    {
        $this->register_days = '';
        $this->hour = '';
        $this->number = '';
        $this->reason_id = '';
    }
}
