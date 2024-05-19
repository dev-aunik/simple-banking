@extends('layout.master')
@section('title', 'Home')
@section('content')
    <div class="d-flex flex-column flex-xl-row">
        <div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
            <div class="card mb-5 mb-xl-8">
                <div class="card-body pt-15">
                    <div class="d-flex flex-center flex-column mb-5">
                        <a href="javascript:void(0);" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-1">
                            {{ auth()->user()->name }} </a>

                        <div class="d-flex flex-wrap flex-center">
                            <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                <div class="fs-4 fw-bold text-gray-700">
                                    <span class="w-75px">${{ $despositAmount }}</span>
                                </div>
                                <div class="fw-semibold text-muted">Deposit</div>
                            </div>

                            <div class="border border-gray-300 border-dashed rounded py-3 px-3 mx-4 mb-3">
                                <div class="fs-4 fw-bold text-gray-700">
                                    <span class="w-50px">${{ $withdrwalAmount }}</span>
                                </div>
                                <div class="fw-semibold text-muted">Withdrawn</div>
                            </div>

                            <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                <div class="fs-4 fw-bold text-gray-700">
                                    <span class="w-50px">${{ auth()->user()->balance }}</span>
                                </div>
                                <div class="fw-semibold text-muted">Balance</div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-stack fs-4 py-3">
                        <div class="fw-bold rotate collapsible" data-bs-toggle="collapse" href="#kt_customer_view_details"
                            role="button" aria-expanded="false" aria-controls="kt_customer_view_details">
                            Details
                            <span class="ms-2 rotate-180">
                                <i class="ki-duotone ki-down fs-3"></i> </span>
                        </div>
                    </div>

                    <div class="separator separator-dashed my-3"></div>

                    <div id="kt_customer_view_details" class="collapse show">
                        <div class="py-5 fs-6">
                            <div class="badge badge-light-info d-inline">
                                {{ auth()->user()->account_type == 'INDIVIDUAL' ? 'Individual' : 'Business' }}</div>

                            <div class="fw-bold mt-5">Account ID</div>
                            <div class="text-gray-600">ID-00{{ auth()->user()->id }}</div>
                            <div class="fw-bold mt-5">Email</div>
                            <div class="text-gray-600"><a href="javascript:void(0);"
                                    class="text-gray-600 text-hover-primary">{{ auth()->user()->email }}</a></div>
                            <div class="fw-bold mt-5">Created at</div>
                            <div class="text-gray-600">
                                {{ \Carbon\Carbon::parse(auth()->user()->created_at)->format('Y-m-d H:i') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex-lg-row-fluid ms-lg-15">
            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_4_table">
                    <thead>
                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-100px">Date</th>
                            <th class="text-center min-w-50px">Transaction Type</th>
                            <th class="text-end min-w-100px">Amount</th>
                            <th class="text-end min-w-125px">Fee</th>
                            <th class="text-end min-w-125px">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="fw-bold text-gray-600">
                        @forelse ($userTransactions as $key => $userTransaction)
                            <tr>
                                <td>
                                    {{ \Carbon\Carbon::parse($userTransaction->date)->format('Y-m-d') }}
                                </td>
                                <td class="text-center">
                                    <span
                                        class="badge py-3 px-4 fs-7 {{ $userTransaction->transaction_type == 'DEPOSIT' ? 'badge-light-success' : 'badge-light-warning' }}">
                                        {{ $userTransaction->transaction_type == 'DEPOSIT' ? 'Deposit' : 'Withdrawal' }}
                                    </span>
                                </td>
                                <td class="text-end">${{ $userTransaction->amount }}</td>
                                <td class="text-end">
                                    ${{ $userTransaction->fee }}
                                </td>
                                <td class="text-end">
                                    ${{ $userTransaction->amount + $userTransaction->fee }}
                                </td>
                            </tr>
                        @empty
                            <tr class="bg-light">
                                <td colspan="5" class="text-center">
                                    No transaction found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $userTransactions->links() }}
        </div>
    </div>
@endsection
