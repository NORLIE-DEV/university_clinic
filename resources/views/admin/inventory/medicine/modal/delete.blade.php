<div class="fixed z-50 inset-0 hidden" id="deleteModal">
    <div class="fixed inset-0 bg-gray-500 opacity-40" id="delete_overlay1"></div>
    <div class="bg-white rounded m-auto fixed inset-0 z-10 " style="max-height:200px; width:500px">
        <button type="button" id="deleteModalClose1"
            class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
            data-modal-toggle="deleteModal1">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Close modal</span>
        </button>
        <input type="hidden" id="delete_id">
        <div class="flex justify-center mt-10">
            <img src="{{ asset('asset/img/bin.png') }}" class="h-12 w-12" alt="delete">
        </div>
        <h4 class="text-center font-normal text-gray-400 mt-4">Are you sure you want to delete this item?</h4>
        <div class="flex justify-center items-center space-x-4 mt-3">
            <button data-modal-toggle="deleteModal" type="button" id="cancelDeletemeModal"
                class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                No, cancel
            </button>
            <button id="delete"
                class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                Yes, I'm sure
            </button>
        </div>
    </div>
</div>
@include('components.modal.delete_success')
<script>
    $(document).ready(function() {

        $(document).on("click", '#delete', function(e) {
            e.preventDefault();

            var supplier_id = $('#delete_id').val();
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            var modelName = 'Medicine';
            $.ajax({
                type: "DELETE",
                url: "/delete/" + modelName + "/" + supplier_id,
                success: function(response) {
                    //alert(response.data.message);
                    setTimeout(function() {
                        $("#deleteModal").hide();
                        location.reload();
                    }, 2000);
                    $("#deleteSucess").show();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Error : ", textStatus,
                        errorThrown);
                },
            });
        })

    });
</script>
