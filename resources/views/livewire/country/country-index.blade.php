<div>
    <!-- Page Heading -->
    <div class="card-header">
        <h3>Countries</h3>
    </div>
    <div class="card-body">
        <div>
            @if (session()->has('country_message'))
                <div class="alert alert-success">
                    {{ session('country_message') }}         
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
                    <button wire:click="showCountryModal" class="btn btn-primary" >
                        New Country
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table" wire:loading.remove>
                <thead>
                    <tr>
                        <th scope="col">#Id</th>
                        <th scope="col">Country Code</th>
                        <th scope="col">Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($countries as $country)
                        <tr>
                            <th scope="row">{{ $country->id }}</th>
                            <td>{{ $country->country_code }}</td>
                            <td>{{ $country->name }}</td>
                            <td>
                                <button wire:click="showEditModal({{ $country->id }})" class="btn btn-success">Edit</button>
                                <button wire:click="deleteCountry({{ $country->id }})" class="btn btn-danger">Delete</button>
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
                {{ $countries->links('pagination::bootstrap-4')}}
            </div>
        </div>
        

        <!-- Modal -->
        <div class="modal fade" id="countryModal" tabindex="-1" aria-labelledby="countryModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">

                        @if (!$editMode)
                            <h5 class="modal-title" id="countryModalLabel">Add New Country</h5>
                        @else
                            <h5 class="modal-title" id="countryModalLabel">Update Country</h5>
                        @endif
                        
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>

                            <div class="form-group row">
                                <label for="countryCode"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Country Code') }}</label>

                                <div class="col-md-6">
                                    <input id="countryCode" type="text"
                                        class="form-control @error('countryCode') is-invalid @enderror" wire:model.defer="countryCode">

                                    @error('countryCode')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

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
                        <button type="button" class="btn btn-secondary" wire:click="closeModal()">Close</button>
                        @if ($editMode)
                            <button type="button" class="btn btn-primary" wire:click="updateCountry()">Update User</button>
                        @else
                            <button type="button" class="btn btn-primary" wire:click="storeCountry()">Save</button>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

