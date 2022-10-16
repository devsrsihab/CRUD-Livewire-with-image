<?php

namespace App\Http\Livewire;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Employees;
use Livewire\WithFileUploads;

class EmployesComp extends Component
{

    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $showingEmployeModal = false;
    public $confirmingEmployeDeletion = false;
    public $isEditMode = false;
    public $viewingemployeModal = false;
    public $Employe_view_name,$Employe_view_image,$Employe_view_designation,$Employe_view_email,$Employe_view_phone,$employe_view_id;
    public $name;
    public $email;
    public $image;
    public $employe;
    public $employe_edit_id;
    public $phone;
    public $newImage;
    public $oldImage;
    public $designation;
    public $Employe;
    public $employe_delet_id;
    public $searchTerm;
    public $selectedEmploye = [];
    public $selectAll = false;
    public $isSelect = false;
    public $isSelectId;





    public function showEmployeModal()
    {
        $this->reset();
        $this->showingEmployeModal = true;

    }

    public function hideEmployeModal()
    {
        $this->confirmingEmployeDeletion = false;
        $this->showingEmployeModal       = false;
        $this->viewingemployeModal       = false;
        $this->resetErrorBag();
    }
    // editShowEmployeModal  method 
    public function editShowEmployeModal($ide)
    {
        $this->employe             = Employees::findOrFail($ide);
        $this->employe_edit_id     = $this->employe->id;
        $this->name                = $this->employe->name;
        $this->image               = $this->employe->image;
        $this->designation         = $this->employe->designation;
        $this->oldImage            = $this->employe->image;
        $this->email               = $this->employe->email;
        $this->phone               = $this->employe->phone;
        $this->showingEmployeModal = true;
        $this->isEditMode          = true;
        
    }
    // error check lifecycle method
    public function updated($fields)
    {
        $this->validateOnly($fields,[
            // 'email' => 'required|email|unique:students,email,'.$this->students_edit_id.'',
            // 'phone' => 'required|string|max  : 11|unique:students,phone,'.$this->students_edit_id.'',

            'name'        => 'min:5|required',
            'newImage'    => 'required|image|max:1024', // 1MB Max
            'designation' => 'string|required|min:5',
            'email'       => 'email|required|unique:employees,email,'.$this->employe_edit_id.'',
            'phone'       => 'required|string|max:11|min:11|unique:employees,phone,'.$this->employe_edit_id.'',
        ]);
    }
    // create Employe
    public function createEmploye()
    {
        $this->validate([
            'name'        => 'min: 5|required',
            'newImage'    => 'required|image|max : 1024', // 1MB Max
            'designation' => 'string|required|min: 5',
            'email'       => 'email|required|unique:employees,email,'.$this->employe_edit_id.'',
            'phone'       => 'required|string|max:11|unique:employees,phone,'.$this->employe_edit_id.'',
        ]);
        $image =  $this->newImage->store('Employes');
        Employees::create([
            'name'        => $this->name,
            'image'       => $image,
            'designation' => $this->designation,
            'email'       => $this->email,
            'phone'       => $this->phone,
        ]);
        session()->flash('created','Employe Created Successfully');
        $this->reset();
        $this->newImage = '';
    }


       // updatePost method 
    public function updateEmploye()
    {
        $this->validate([
            'name'        => 'min: 5|required',
            'designation' => 'string|min: 5',
            'email'       => 'email|unique:employees,email,'.$this->employe_edit_id.'',
            'phone'       => 'string|max:11|unique:employees,phone,'.$this->employe_edit_id.'',
        ]);
           $image = $this->employe->image;
           if ($this->newImage) {
               $image = $this->newImage->store('posts');
           }
               $this->employe->update([
               'name'        => $this->name,
               'image'       => $image,
               'designation' => $this->designation,
               'oldImage'    => $this->oldImage,
               'email'       => $this->email,
               'phone'       => $this->phone,
               ]);
               $this->reset();    
               session()->flash('updated','Employe Updated Successfully');

    }


    // for view studetn details
    public function viewEmployeModal($id)
    {

        $this->viewingemployeModal = true;
        $employe= Employees::findOrFail($id);
        $this->employe_view_id          = $employe->id;
        $this->Employe_view_name        = $employe->name;
        $this->Employe_view_image       = $employe->image;
        $this->Employe_view_designation = $employe->designation;
        $this->Employe_view_email       = $employe->email;
        $this->Employe_view_phone       = $employe->phone;

    }

    // delete by selected method
    public function selectedEmployees()
    {  

        if($this->selectedEmploye){
            Employees::query()
            ->whereIn('id', $this->selectedEmploye)
            ->delete();
            $this->selectedEmploye =[];
            $this->selectAll = false;
            $this->isSelect = true;
            $this->hideEmployeModal();
            session()->flash('deleted','Employe Deleted Successfully');

        }       

    }

    // updated selected all
    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedEmploye =Employees::pluck('id');
            $this->selectAll = true;


        }else{
            $this->selectedEmploye =[];
            $this->selectAll = false;

        }
    }

    // confirmingEmployeDeletion modals
    public function deleteConfirmation($id)
    {
        $this->confirmingEmployeDeletion = true;
        $this->employe_delet_id = $id;
        if($this->employe_delet_id==null){
           $this->isSelect = true;
        }

    }
    // cancle delete modal
    public function cancleDelete()
    {
        $this->employe_delet_id = '';
    }  
    // delete empllye query 
    public function deleteEmploye()
    {
        Employees::find($this->employe_delet_id)->delete() ;
        $this->hideEmployeModal();
        $this->reset();
        //  session 
        session()->flash('deleted');
        $this->employe_delet_id = '';
        session()->flash('deleted','Employe Deleted Successfully');

    }







    public function render()
    {
        $searchTermS = '%'.$this->searchTerm.'%';

        $employeData['employees'] = Employees::where('name','LIKE',$searchTermS)
                                    ->orWhere('designation','LIKE',$searchTermS)
                                    ->orWhere('email','LIKE',$searchTermS)
                                    ->orWhere('phone','LIKE',$searchTermS) 
                                    ->orderBy('id','DESC')       
                                    ->paginate(5);            
        return view('livewire.employes-comp',$employeData);
    }
}
