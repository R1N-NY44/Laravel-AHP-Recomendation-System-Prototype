<div>
    <div class="relative overflow-x-auto">
        <div class="items-center justify-center gap-2 overflow-x-hidden bg-black p-10">
            <button class="btn" onclick="my_modal_4.showModal()">open modal</button>
            <dialog id="my_modal_4" class="modal">
                <div class="modal-box w-11/12 max-w-[90%]">
                    <h3 class="text-lg font-bold">Hello!</h3>
                    <p class="py-4">Click the button below to close</p>
                    <div class="modal-action">
                        <form method="dialog">
                            <!-- if there is a button, it will close the modal -->
                            <button class="btn">Close</button>
                        </form>
                    </div>
                </div>
            </dialog>
        </div>
    </div>
</div>
