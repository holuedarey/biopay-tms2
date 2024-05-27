<div class="modal fade" id="edit-menus" tabindex="-1" role="dialog" aria-labelledby="edit-menus" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="modal-content my-form" :action="action" method="post">
            @csrf
            <div class="modal-header fw-medium">
                Edit Menus for Terminal
                <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-light-info rounded" role="alert">
                    <strong>Terminal ID </strong> -
                    <span class="italic font-medium" x-text="terminal.tid"></span>; <strong>Serial No </strong>-
                    <span class="italic font-medium" x-text="terminal.serial"></span>.
                </div>

                @can('edit terminals')
                    <x-note message="After adding or deleting menus from this terminal, ensure to save it before exiting." />
                @endcan

                <div class="mt-5">
                    <template x-for="(service, index) in current_menus" :key="service.id">
                        <div class="bg-white border border-light border-1 shadow-sm rounded w-75 my-2 ms-5 p-1">
                            <input type="hidden" name="menus[]" :value="service.id">
                            <div class="d-flex align-items-center justify-content-between">
                                <div x-text="service.menu_name" class="px-2"></div>
                                @can('edit terminals')
                                    <button type="button" @click="deleteMenu(index)"
                                            class="text-danger border-0 rounded-circle px-2 py-1"
                                    >
                                        x
                                    </button>
                                @endcan
                            </div>
                        </div>
                    </template>
                </div>

                @can('edit terminals')
                    <h6 class="mb-2 mt-5">- Add Menu to Terminal by selecting from below</h6>

                    <select class="form-select w-75" name="" x-model="new_menu" id="" x-on:change="addNewMenu">
                        <option value=""></option>
                        {{--                        Get the difference between the default menus and the current terminal menus to see which can still be added. --}}
                        <template x-for="(service, index) in others" :key="service.id">
                            <option :value="index" x-text="service.menu_name"></option>
                        </template>
                    </select>

                    <div class="mt-20"></div>
                @endcan
            </div>
            <div class="modal-footer text-right mt-2">
                <button class="btn btn-outline-light" type="button" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary btn-hover-effect" type="submit">Save</button>
            </div>
        </form>
    </div>
</div>

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            console.log('DOM fully loaded and parsed');
            document.addEventListener('alpine:init', () => {
                Alpine.data('terminal_update', () => ({
                    current_menus: [],
                    terminal: {},
                    action: null,

                    new_menu: {},
                    others: [],

                    async initializeModal(route){
                        let res = await fetch(route);
                        let body = await res.json()

                        this.current_menus = body.menus;
                        this.terminal = body.terminal;
                        this.action = body.route;

                        this.setAvailableMenus();
                    },

                    setAvailableMenus() {
                        let default_menus = @js(app('menus'));

                        this.others = default_menus.filter(
                            menu1 => !this.current_menus.some(menu2 => menu1.id === menu2.id),
                        );

                    },

                    addNewMenu() {
                        this.current_menus.push(this.others[this.new_menu])
                        this.others.splice(this.new_menu, 1)
                    },

                    deleteMenu(index) {
                        this.others.push(this.current_menus[index])
                        this.current_menus.splice(index, 1)
                    },
                }))
            })
        });

    </script>
@endpush
