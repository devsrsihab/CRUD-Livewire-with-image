<div>
    <div class="max-w-6xl py-5 mx-auto ">
   
       <div class=" p-3 table-parent">
           <div class="row px-2 uppercase text-2xl py-3 flex vertical-center">
               <div class="col-sm-6">
                   <h2>Employe List</h2>
               </div>
 
           </div>
           {{-- search box  and create button--}}
           <div class="row px-2 uppercase text-2xl py-3 flex align-items-center">

           {{-- seletction delete button --}}
           <div class=" mb-6 col-sm-6">
            <button  wire:click="deleteConfirmation(null)" type="button" class="uppercase btn btn-danger">Delete Selected</button>
           </div>
            <div class="col-sm-6 text-right">   
                <x-jet-button class="bg-success" wire:click="showEmployeModal">Create Employe</x-jet-button>
            </div>
        </div>
        <div class="search_box mb-6 col-sm-5">
            <input type="text" class="form-control" placeholder="Search..." wire:model="searchTerm">
           </div>
           {{-- Created alert --}}
           <div class="alert_div">
            @if (session()->has('created'))
                <div class="alert alert-success alert-dismissible d-flex align-items-center fade show">
                    <i class="bi-check-circle-fill"></i>
                <strong class="mx-2">Success!</strong> Employe Created Succesfully .
            </div>                
            @endif
           {{-- Created alert --}}
           <div class="alert_div">
            @if (session()->has('updated'))
                <div class="alert alert-success alert-dismissible d-flex align-items-center fade show">
                    <i class="bi-check-circle-fill"></i>
                <strong class="mx-2">Success!</strong> Employe Updated Succesfully .
            </div>                
            @endif
            {{-- deleted alert --}}
            @if (session()->has('deleted'))
                    <div class="alert alert-info alert-dismissible d-flex align-items-center fade show">
                        <i class="bi-info-circle-fill"></i>
                    <strong class="mx-2">Deleted!</strong> Employe Deleted Succesfully</div>               
            @endif
           </div>




           {{-- table --}}
           <!-- component -->
           <div class="overflow">
             <div class="bg-gray-100 flex items-center justify-center bg-gray-100 font-sans overflow-hidden">
              <div class="w-full lg:w-6/6">
               <div class="bg-white shadow-md rounded my-6">
                   <table class="min-w-max w-full table-auto">
                       <thead>
                           <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                               <th class="py-3 px-2"><input id="selectAll" type="checkbox" wire:model="selectAll"></th>
                               <th class="py-3 px-2">Id</th>
                               <th class="py-3 px-2" ><label for="selectAll"></label></th>Name</label> </th>
                               <th class="py-3 px-2">Photo</th>
                               <th class="py-3 px-2">Designation</th>
                               <th class="py-3 px-2">Email</th>
                               <th class="py-3 px-2">Phone</th>
                               <th class="py-3 px-2">Actions</th>
                           </tr>
                       </thead>
                       <tbody class="text-gray-600 text-sm font-light">
                           @forelse ( $employees as $key => $Employe )
                           <tr class="border-b border-gray-200  hover:bg-gray-100">
                               <td class="py-2 px-2 "><input type="checkbox" wire:model="selectedEmploye" value="{{ $Employe->id }}"></td>
                               <td class="py-2 px-2 ">{{ $Employe->id }}
                               </td>
                                <td class="py-2 px-2" style="text-transform:capitalize">{{ $Employe->name }}
                                </td>
                                <td class="py-2 px-2">
                                    <img class="profile-image"  src="{{ asset('uploads/'.$Employe->image) }}" alt="Employe-img">
                                </td>
                               <td class="py-2 px-2">{{ $Employe->designation }}
                               </td>
                               <td class="py-2 px-2">{{ $Employe->email }}
                               </td>
                               <td class="py-2 px-2">{{ $Employe->phone }}
                               </td>
                               {{-- action td --}}
                               <td class="py-2 px-2">
                                   <div class="flex ">
                                      {{-- view icon --}}
                                       <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                           <a style="cursor:pointer"  wire:click="viewEmployeModal({{ $Employe->id }})" >
                                               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                               </svg>
                                           </a>
                                       </div>
                                       {{-- edit icon --}}
                                       <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                           <a style="cursor:pointer"  wire:click="editShowEmployeModal({{ $Employe->id }})">
                                               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                               </svg>
   
                                           </a>
                                       </div>
                                       {{-- delete icon --}}
                                       <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                           <a style="cursor:pointer" wire:click="deleteConfirmation({{ $Employe->id }})">
                                               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                               </svg>
   
                                           </a>
                                       </div>
                                   </div>
                               </td>
                           </tr>   
                           @empty
                           <td colspan="8" class=" text-center text-red-500"><div class="alert alert-warning" role="alert" data-mdb-color="warning">
                            <i class="fas fa-exclamation-triangle me-3"></i>Employees Data Not Found!
                          </div></td>
                               
                           @endforelse
      
                        
                           </tbody>
                     </table>
                     {{-- pagination --}}
                     <div class="paginate my-2 py-5">
                        {{ $employees->links() }}
                      </div>
                </div>
              </div>
           </div>
        </div>
      {{-- /end table --}}
           
   </div>
   
      {{-- create and edit modal --}}
       <div>
           <x-jet-dialog-modal  wire:model="showingEmployeModal">
   
               @if ($isEditMode)                
               <x-slot name="title">Update Employe</x-slot>
               @else
               <x-slot name="title">Create Employe</x-slot>
                   
               @endif
   
               <x-slot name="content">
                   <div class="mt-10 sm:mt-0">
                       <div class="md:grid ">
           
                               <div class=" md:col-span-2 md:mt-0">
                                   <form autocomplete="off"  method="POST" enctype="multipart/form-data" >
                                   <div class="overflow-hidden shadow sm:rounded-md">
                                       <div class="bg-white px-4 py-5 sm:p-6">
                                       <div class="grid grid-cols-6 gap-6">
   
                                           <div class="col-span-6 ">
                                           <label for="title" class="block mb-4 text-sm font-medium text-gray-700">Employe Name</label>
                                           <input type="text"  wire:model="name" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                           @error('name') <span class="error text-red-400">{{ $message }}</span> @enderror
                                           </div>
                           
                                           <div class="col-span-6">              
                                           <label class="block mb-4 text-sm font-medium text-gray-900 dark:text-gray-300" for="file_input">Employe Image</label>
   
                                           @if ($newImage)
                                           {{--new image preview --}}
                                           @if ($newImage)
                                           <div class="img-box">
                                               <img class="mb-4 bordered" src="{{ $newImage->temporaryUrl() }}">
                                               <div  wire:loading wire:key="newImage" wire:target="newImage" class="mb-4"><i class="fa fa-spinner fa-spin"></i>Uploading</div>
                                           </div>
                                           @endif 
                                           @else
                                           {{-- old imag preview --}}
                                           @if ($oldImage)
                                           <div class="img-box">
                                               <img  class="mb-4 bordered" src="{{ asset('uploads/'.$oldImage) }}">
                                               <div  wire:loading wire:key="oldImage" wire:target="oldImage" class="mb-4"><i class="fa fa-spinner fa-spin"></i>Uploading</div>
                                           </div>
                                           @endif
                                           @endif
                                           <input class=" form-control block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="{{ rand() }}"  wire:model="newImage" type="file">
                                           @error('newImage') <span class="error text-red-400">{{ $message }}</span> @enderror                     
   
                                           </div>
                                       
   
                                           <div class="col-span-6 ">               
                                           <label for="designation" class="block mb-4 text-sm font-medium text-gray-900 dark:text-gray-400">Designation</label>
                                           <select class="form-control select2bs4"   wire:model="designation" id="designation" style="width: 100%">
                                            <option value="Select Designation">Select Designation</option>
                                            <option value="Front-End Developer">Front-End Developer</option>
                                            <option value="Back-End Developer">Back-End Developer</option>
                                            <option value="Digital Markater">Digital Markater</option>
                                            <option value="App Developer">App Developer</option>
                                            <option value="Database Engineer">Database Engineer</option>
                                          </select>
                             
                                           @error('designation') <span class="error text-red-400">{{ $message }}</span> @enderror   
                                           </div>

                                           <div class="col-span-6 ">               
                                           <label for="email" class="block mb-4 text-sm font-medium text-gray-900 dark:text-gray-400">email</label>
                                           <input class=" form-control block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="email" wire:model="email"  type="text">
                                           @error('email') <span class="error text-red-400">{{ $message }}</span> @enderror 
                                           </div>                  

                                           <div class="col-span-6 ">               
                                           <label for="phone" class="block mb-4 text-sm font-medium text-gray-900 dark:text-gray-400">Phone</label>
                                           <input class=" form-control block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="phone" wire:model="phone"  type="text">
                                           @error('phone') <span class="error text-red-400">{{ $message }}</span> @enderror 
                                           </div>                  
   
                                           </div>
                                           </div>
                                       </div>
                                   </form>             
                               </div>
                          </div>
                   </div>
               </x-slot>
               <x-slot name="footer">
                   @if ($isEditMode)
                   <x-jet-button class="mr-3 bg" wire:click="updateEmploye">Update</x-jet-button>
                   <x-jet-danger-button class="mr-3" wire:click="hideEmployeModal">Close</x-jet-danger-button>
                   
                   @else
                   <x-jet-button class="mr-3 " wire:click="createEmploye">Save</x-jet-button>                 
                   <x-jet-danger-button class="mr-3 " wire:click="hideEmployeModal">Close</x-jet-danger-button>
                   @endif
               </x-slot>
          </x-jet-dialog-modal>
       </div>  
       {{-- /create edit modal --}}
   
       <!-- Delete Employe Confirmation Modal -->
       <div>
           <x-jet-dialog-modal wire:model="confirmingEmployeDeletion">
                 <x-slot name="title">
                   Delete Confirmation
                   </x-slot>
     
                 <x-slot name="content">
                     <div class="modal-confirm mx-auto">
                         <div class="modal-head">
     
                             <div class="icon-box text-center">
                                 <i class="fa-solid fa-xmark"></i>
                             </div>
                             <h4 class="modal-title w-100">Are you sure?</h4>
                             <div class="modal-body p-3 text-center">
                                 <p>Do you really want to delete these records? This process cannot be undone.</p>
                             </div>
                         </div>
                     </div>

     
                 </x-slot>
     
                 <x-slot name="footer">
                     <x-jet-secondary-button wire:click="hideEmployeModal">
                         Cancel
                     </x-jet-secondary-button>
                     @if ($isSelect)
                     <x-jet-danger-button class="ml-3" wire:click="selectedEmployees" >
                        Delete Selected
                    </x-jet-danger-button>

                     @else
                     <x-jet-danger-button class="ml-3" wire:click="deleteEmploye" wire:loading.attr="disabled">
                         Delete
                     </x-jet-danger-button>
                         
                     @endif
                 </x-slot>
           </x-jet-dialog-modal>
       </div>
          <!-- /Delete Employe Confirmation Modal -->
   
       <!-- View Employe Modal -->
       <div>
           <x-jet-dialog-modal wire:model="viewingemployeModal">
                 <x-slot name="title">
                 </x-slot>
     
                 <x-slot name="content">  
                   <section >
                       <div class="container py-2">
                         <div class="row d-flex justify-content-center align-items-center h-100">
                           <div class="col-lg-12 mb-lg-0">
                             <div class="card mb-3" style="border-radius: .5rem;">
                               <div class="row g-0">
                                 <div class="col-md-4 gradient-custom text-center text-white "
                                   style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                       
                                   <img  src="{{ asset('uploads/'.$Employe_view_image) }}"
                                     alt="Avatar" class="img-fluid my-3 m-auto" style="width: 80px;height:80px;border-radius:50%;" />
                                   <h5 class="Employe-title uppercase">{{ $Employe_view_name }}</h5>
                                   <p class="text-black-50">{{ $Employe_view_designation }}</p>
   
                                 </div>
                                 <div class="col-md-8">
                                   <div class="card-body p-4">
                                     <h6>Information</h6>
                                     <hr class="mt-0 mb-4">
                                     <div class="row pt-1">
                                       <div class="col-6 mb-3">
                                         <h6>Email</h6>
                                         <p class="text-muted">{{ $Employe_view_email }}</p>
                                       </div>
                                       <div class="col-6 mb-3">
                                         <h6>Phone</h6>
                                         <p class="text-muted">{{ $Employe_view_phone }}</p>
                                       </div>
                                     </div>
                                     <div class="row pt-1">
                                       <div class="col-6 mb-3">
                                         <h6>Name</h6>
                                         <p class="text-muted">{{ $Employe_view_name }}</p>
                                       </div>
                                       <div class="col-6 mb-3">
                                         <h6>Desingnation</h6>
                                         <p class="text-muted">{{ $Employe_view_designation }}</p>
                                       </div>
                                     </div>
        
                                   </div>
                                 </div>
                               </div>
                             </div>
                           </div>
                         </div>
                       </div>
                     </section>
   
                 </x-slot>
     
                 <x-slot name="footer">
                     <x-jet-danger-button wire:click="hideEmployeModal">
                         Cancel
                     </x-jet-danger-button>
     
                 </x-slot>
           </x-jet-dialog-modal>
           <!-- /Vidw Employe  Modal -->
       </div>
     {{-- /View Employe Modal --}}

   