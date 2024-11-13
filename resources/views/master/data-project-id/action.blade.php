<div class="dropdown">
    <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-ellipsis-h"></i>
    </button>
    <ul class="dropdown-menu">
        <li><button class="dropdown-item text-info fw-bold d-flex justify-content-between" type="button" >Edit <i
                    class="ml-4 fas fa-pen"></i></button></li>
        <li>
            <button class="dropdown-item text-danger fw-bold d-flex justify-content-between" type="button"
                data-table-id="dataprojectid-table" data-url="{{ route('project-id.delete', $projectid->id) }}"
                data-name="{{ $projectid->nama_project }}" data-action="delete">
                Delete <i class="fas fa-trash"></i>
            </button>

        </li>
    </ul>
</div>
