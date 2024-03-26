<div class="container-fluid" x-data="{level: {}, action: null}">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <p class="mb-0">
                        Showing list of all Activities
                    </p>
                </div>
                <div class="card-body">
                    <div class="">
                        <div class="table-responsive signal-table">
                            <table class="table table-hover sm:mt-2">
                                <thead>
                                <tr>
                                    <th scope="col"><span class="f-light f-w-600">Subject</span></th>
                                    <th scope="col"><span class="f-light f-w-600">User</span></th>
                                    <th scope="col"><span class="f-light f-w-600">Action</span></th>
                                    <th scope="col"><span class="f-light f-w-600">Role</span></th>
                                    <th scope="col"><span class="f-light f-w-600">Date</span></th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach ($activities as $activity)

                                    <tr class="intro-x">
                                        <td class="w-56">{{ $activity->log_name }}</td>

                                        <td class="w-56">
                                            {{ optional( $activity->causer)->name ?? '...' }} <br>
                                            {{ optional( $activity->causer)->email ?? '...' }}
                                        </td>

                                        <td class="w-56">{{ strtoupper($activity->description) }}</td>

                                        <td class="w-56">
                                            {{ optional( $activity->causer)->roleName ?? '...' }}
                                        </td>

                                        <td class="w-96">{{ $activity->created_at }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div>
                        {{ $activities->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
