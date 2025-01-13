<div class="dropdown">
    <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false"
        style="--bs-btn-active-border-color:transparent;">
        <i class="fas fa-ellipsis-h"></i>
    </button>
    <ul class="dropdown-menu">

        <li><a href="javascript:void(0)" class="dropdown-item text-info fw-bold d-flex justify-content-between py-2"
                data-id="{{ $invoice->id }}" type="button" data-bs-toggle="modal"
                data-bs-target="#modalEditHeader">Edit Header<i class="ml-4 fas fa-pen"></i></a></li>
        <li><a href="javascript:void(0)" id="btnEditDetail"
                class="dropdown-item text-info fw-bold d-flex justify-content-between py-2"
                data-id="{{ $invoice->id }}" type="button" data-bs-toggle="modal"
                data-bs-target="#modalEditDetail">Edit Detail<i class="ml-4 fas fa-pen"></i></a></li>
        <li><a href="javascript:void(0)" id="btnEditDetail"
                class="dropdown-item text-info fw-bold d-flex justify-content-between py-2"
                data-id="{{ $invoice->id }}" type="button" data-bs-toggle="modal"
                data-bs-target="#modalEditPajak">Faktur Pajak<i class="ml-4 fas fa-pen"></i></a></li>
        <li><a href="javascript:void(0)" id="btnEditDetail"
                class="dropdown-item text-info fw-bold d-flex justify-content-between py-2"
                data-id="{{ $invoice->id }}" type="button" data-bs-toggle="modal"
                data-bs-target="#modalEditPaid">PAID<i class="ml-4 fas fa-pen"></i></a></li>
        <li><a href="javascript:void(0)" id="btnEditDetail"
                class="dropdown-item text-info fw-bold d-flex justify-content-between py-2"
                data-id="{{ $invoice->id }}" type="button" data-bs-toggle="modal" data-bs-target="#modalEditTtd">TTD<i
                    class="ml-4 fas fa-pen"></i></a></li>
        <li><a href="javascript:void(0)" class="dropdown-item text-info fw-bold d-flex justify-content-between py-2"
                data-id="{{ $invoice->id }}" type="button" data-bs-toggle="modal" data-bs-target="#modalEdit">Bast
                Completion <i class="ml-4 fas fa-print"></i></a></li>
        <li><a href="{{ route('print.invoice', $invoice->id) }}"
                class="dropdown-item text-info fw-bold d-flex justify-content-between py-2"
                data-id="{{ $invoice->id }}" type="button">Print
                Invoice <i class="ml-4 fas fa-print"></i></a></li>
        <li><a href="{{ route('print.invoice-non', $invoice->id) }}"
                class="dropdown-item text-info fw-bold d-flex justify-content-between py-2"
                data-id="{{ $invoice->id }}" type="button">Print
                Invoice Non<i class="ml-4 fas fa-print"></i></a></li>

        <li><a href="javascript:void(0)" class="dropdown-item text-info fw-bold d-flex justify-content-between py-2"
                data-id="{{ $invoice->id }}" type="button" data-bs-toggle="modal" data-bs-target="#modalEdit">Print
                Kwitansi <i class="ml-4 fas fa-print"></i></a></li>
        <li><a href="javascript:void(0)" class="dropdown-item text-info fw-bold d-flex justify-content-between py-2"
                data-id="{{ $invoice->id }}" type="button" data-bs-toggle="modal" data-bs-target="#modalEdit">Print
                Kwitansi Non<i class="ml-4 fas fa-print"></i></a></li>


        <li>
            <button class="dropdown-item text-danger fw-bold d-flex justify-content-between py-2" id="btnDeleteInvoice"
                type="button" data-table-id="invoice-table" data-url="{{ route('invoice.delete', $invoice->id) }}"
                data-name="{{ $invoice->kd_invoice }}" data-action="delete">
                Delete <i class="fas fa-trash"></i>
            </button>

        </li>
    </ul>
</div>
