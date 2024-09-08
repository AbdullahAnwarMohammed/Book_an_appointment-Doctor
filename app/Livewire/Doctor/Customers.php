<?php

namespace App\Livewire\Doctor;

use App\Models\Patient;
use Livewire\Component;

class Customers extends Component
{
    public $search;

    public function render()
    {
        $query = Patient::query();
    
        if ($this->search) {
            $searchValue = $this->search;
            $query->where(function ($query) use ($searchValue) {
                    $query->where('name', 'like', '%' . $searchValue . '%')
                          ->orWhere('phone', 'like', '%' . $searchValue . '%')
                          ->orWhere('cid', 'like', '%' . $searchValue . '%');
            });
        }
    
        $patients = $query->paginate(10);
    
        return view('livewire.doctor.customers', [
            'patients' => $patients
        ]);
    }

    public function delete($id) {
       Patient::where('id',$id)->delete();
    }
}
