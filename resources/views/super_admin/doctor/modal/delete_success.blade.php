<div class="fixed z-50 inset-0 hidden" id="deleteSucess">
    <div class="fixed inset-0 bg-gray-500 opacity-40" id="delete_overlay"></div>
    <div class="bg-white rounded m-auto fixed inset-0 z-10 " style="max-height:250px; width:500px">
        <button type="button" id="deleteModalClose"
            class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
            data-modal-toggle="deleteModal">
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
            <img src="{{ asset('asset/img/Animation - 1704823785365.gif') }}" class="h-20 w-20" alt="delete">
        </div>
        <h4 class="text-center font-normal text-gray-400 mt-4">Delete Successfully!</h4>
        <div class="flex items-center justify-center">
            <button class="p-2 bg-blue-600 text-white w-22 flex justify-center mt-5 rounded-md shadow-lg"
                id="close_deleteModalMessage">OK</button>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#close_deleteModalMessage").click(function() {
            $("#deleteSucess").hide();
            $("#deleteModal").hide();
        });
    });
</script>
