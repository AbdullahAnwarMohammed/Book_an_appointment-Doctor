<?php 
namespace App\Livewire\Employee;

use App\Models\Alhajz;
use App\Models\Patient;
use Livewire\Component;

class RegisterToday extends Component
{
    public $statuses = [];
    public $id_register;
    public $search;
    public $date;

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

        $Registers = $query->paginate(10);

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

    protected function updateStatus($id)
    {
        $Register = Alhajz::find($id);

        if ($Register) {
            $Register->update(['status' => $this->statuses[$id]]);
            $this->updateAdjacentRecords($id);
        }
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
}
