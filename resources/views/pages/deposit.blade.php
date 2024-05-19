@extends('layout.master')
@section('title', 'Deposits')
@section('content')
    <div class="row g-5 g-lg-8 mb-5 mb-xl-0">
        <div class="col-xl-12 mb-xl-8">
            <div class="row">
                <div class="col-md-3 ms-auto d-flex justify-content-end">
                    <div class="card-toolbar">
                        <a href="#" class="btn btn-sm btn-flex btn-light-primary" data-bs-toggle="modal"
                            data-bs-target="#kt_modal_new_card">
                            <i class="ki-duotone ki-plus-square fs-3">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>Add new deposit</a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_4_table">
                    <thead>
                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-100px">Date</th>
                            <th class="text-end min-w-100px">Amount</th>
                            <th class="text-end min-w-100px">Fee</th>
                            <th class="text-end min-w-125px">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="fw-bold text-gray-600">
                        @forelse ($userDeposits as $key => $userDeposit)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($userDeposit->date)->format('Y-m-d') }}</td>
                                <td class="text-end">${{ $userDeposit->amount }}</td>
                                <td class="text-end">
                                    ${{ $userDeposit->fee }}
                                </td>
                                <td class="text-end">${{ $userDeposit->amount + $userDeposit->fee }}</td>
                            </tr>
                        @empty
                            <tr class="bg-light">
                                <td colspan="5" class="text-center">
                                    No deposit found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $userDeposits->links() }}
        </div>
    </div>
    <div class="modal fade" id="kt_modal_new_card" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Add New Deposit</h2>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                </div>
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <form id="kt_modal_new_card_form" class="form"
                        action="{{ route('deposit.post', auth()->user()->id) }}" method="POST">
                        @csrf
                        <div class="d-flex flex-column fv-row">
                            @if (session()->has('success'))
                                <div
                                    class="alert alert-dismissible bg-light-success d-flex flex-column align-items-center flex-sm-row w-100 p-3 mb-5">

                                    <div class="d-flex flex-column pe-0 pe-sm-10">
                                        <span>{{ session('success') }}</span>
                                    </div>

                                    <button type="button"
                                        class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
                                        data-bs-dismiss="alert">
                                        <i class="ki-duotone ki-cross fs-1 text-success"><span class="path1"></span><span
                                                class="path2"></span></i> </button>
                                </div>
                            @elseif (session()->has('failed'))
                                <div
                                    class="alert alert-dismissible bg-light-danger d-flex flex-column align-items-center flex-sm-row w-100 p-3 mb-5">

                                    <div class="d-flex flex-column pe-0 pe-sm-10">
                                        <span>{{ session('failed') }}</span>
                                    </div>

                                    <button type="button"
                                        class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
                                        data-bs-dismiss="alert">
                                        <i class="ki-duotone ki-cross fs-1 text-danger"><span class="path1"></span><span
                                                class="path2"></span></i>
                                    </button>
                                </div>
                            @endif
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div
                                        class="alert alert-dismissible bg-light-danger d-flex flex-column align-items-center flex-sm-row w-100 p-3 mb-5">

                                        <div class="d-flex flex-column pe-0 pe-sm-10">
                                            <span>{{ $error }}</span>
                                        </div>

                                        <button type="button"
                                            class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
                                            data-bs-dismiss="alert">
                                            <i class="ki-duotone ki-cross fs-1 text-danger"><span
                                                    class="path1"></span><span class="path2"></span></i>
                                        </button>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="d-flex flex-column my-7 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                <span class="required">Amount</span>
                                <span class="ms-1" data-bs-toggle="tooltip"
                                    title="Specify the amount you want to deposit">
                                    <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </span>
                            </label>
                            <input type="number" class="form-control form-control-solid" placeholder="Ex: 1000"
                                name="amount" required min="1" value="{{ old('amount') }}" />
                        </div>
                        <div class="text-center pt-15">
                            <button type="button" data-bs-dismiss="modal" class="btn btn-light me-3">Discard</button>
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#kt_modal_new_card').modal('hide');

            @if ($errors->any() || session()->has('failed') || session()->has('success'))
                $('#kt_modal_new_card').modal('show');
            @endif
        });
    </script>
@endsection
