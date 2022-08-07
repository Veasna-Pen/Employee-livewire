<div>
    <!-- Page Heading -->
    <div class="card-header">
        <h3>Departments</h3>
    </div>
    <div class="card-body">
        <div>
            @if (session()->has('department-message'))
                <div class="alert alert-success">
                    {{ session('department-message') }}         
                </div>
            @endif
        </div>
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <form>
                        <div class="form-row align-items-center">
                            <div class="col">
                                <input type="search" wire:model="search" class="form-control mb-2" id="inlineFormInput"
                                    placeholder="Name...">
                            </div>
                            <div class="col-md-12" wire:loading>
                                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                Loading...
                            </div>
                        </div>
                    </form>
                </div>
                <div>
                    <!-- Button trigger modal -->
                    <button wire:click="showDepartmentModal" class="btn btn-primary" >
                        New Department
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table" wire:loading.remove>
                <thead>
                    <tr>
                        <th scope="col">#Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($departments as $department)
                        <tr>
                            <th scope="row">{{ $department->id }}</th>
                            <td>{{ $department->name }}</td>
                            <td>
                                <button wire:click="showEditModal({{ $department->id }})" class="btn btn-success">Edit</button>
                                <button wire:click="deleteDepartment({{ $department->id }})" class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th>No Results</th>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div>
                {{ $departments->links('pagination::bootstrap-4')}}
            </div>
        </div>
        

        <!-- Modal -->
        <div class="modal fade" id="departmentModal" tabindex="-1" aria-labelledby="departmentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">

                        @if (!$editMode)
                            <h5 class="modal-title" id="departmentModalLabel">Add New Department</h5>
                        @else
                            <h5 class="modal-title" id="departmentModalLabel">Update Department</h5>
                        @endif
                        
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>

                            <div class="form-group row">
                                <label for="department"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Department') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" wire:model.defer="name">
    
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                            </div>
                            
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Close</button>
                        @if ($editMode)
                            <button type="button" class="btn btn-primary" wire:click="updateDepartment">Update Department</button>
                        @else
                            <button type="button" class="btn btn-primary" wire:click="storeDepartment">Save</button>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

