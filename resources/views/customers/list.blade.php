<div class="card">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="fas fa-list me-2"></i>Customer List</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="customerTable" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Bank Name</th>
                                                <th>Aadhar No</th>
                                                <th>Account No</th>
                                                <th>Customer Name</th>
                                                <th>Phone No</th>
                                                <th>Location</th>
                                                <th>Passbook/ATM</th>
                                                <th>Social Security</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($customers as $index => $customer)
                                                @foreach($customer->bankAccounts as $bankAccount)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $bankAccount->bank->name }}</td>
                                                <td>{{ $customer->aadhaar_no}}</td>
                                                <td>{{ $bankAccount->account_number }}</td>
                                                <td>{{ $customer->name }}</td>
                                                <td>{{ $customer->mobile_no }} / {{ $customer->alternate_no}}</td>
                                                <td>{{ $customer->location }}</td>
                                                <td>
                                                    @if(strtolower($bankAccount->passbook_received) == 'yes' && strtolower($bankAccount->atm_received) == 'yes')
                                                        <span class="badge bg-success">Both Received</span>
                                                    @elseif(strtolower($bankAccount->passbook_received) == 'no' && strtolower($bankAccount->atm_received) == 'no')    
                                                        <span class="badge bg-warning">Both Pending</span>
                                                    @elseif(strtolower($bankAccount->atm_received) == 'no')
                                                        <span class="badge bg-warning">ATM Pending</span>
                                                    @elseif(strtolower($bankAccount->passbook_received) == 'no')
                                                        <span class="badge bg-warning">Passbook Pending</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($bankAccount->socialSchemes->count() > 0)
                                                        @foreach($bankAccount->socialSchemes as $scheme)
                                                            <span class="badge 
                                                                @if($scheme->code == 'APY') bg-primary
                                                                @elseif($scheme->code == 'PMJJBY') bg-success
                                                                @else bg-secondary
                                                                @endif">
                                                                {{ $scheme->code }} {{ $scheme->pivot->status }}
                                                            </span>
                                                        @endforeach
                                                    @else
                                                        <span class="badge bg-secondary">None</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <!-- <button class="btn btn-sm btn-outline-primary me-1">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-warning me-1">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button> -->
                                                    <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-sm btn-info" title="View">
                                                        <i class="fa fa-eye"></i>
                                                    </a>

                                                    <!-- Edit -->
                                                    <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>

                                                    <!-- Delete -->
                                                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="d-inline"
                                                        onsubmit="return confirm('Are you sure you want to delete this customer?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>    