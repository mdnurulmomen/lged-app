<style type="text/css">
    .table th, .table td {
        padding: 0.5rem;
        vertical-align: top;
    }
</style>

<!-- The Modal -->
<div class="modal fade" id="announcementMemoModal" tabindex="-1" role="dialog" aria-labelledby="announcementMemoModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Annoncement Memo</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-row">
                    <div class="col-sm-12 form-group">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Subject:</th>
                                    <th>Commencement of Audit of
                                        {{ $announcementMemo['project_name_en'] ?? ($announcementMemo['function_name_en'] ?? $announcementMemo['cost_center_en']) }}
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div class="col-sm-12 form-group">
                        <p>IAD has planned to commence the audit of <b>(Audit Activity)</b> as per the Audit Committe's
                            approved Audit Plan</p>
                    </div>

                    <div class="col-sm-12 form-group">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="">Audit Period</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>This audit covers the period from
                                        {{ count($announcementMemo['teams']) ? $announcementMemo['teams'][0]['team_start_date'] : '--' }}
                                        till
                                        {{ count($announcementMemo['teams']) ? $announcementMemo['teams'][0]['team_end_date'] : '--' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-sm-12 form-group">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="">Audit Scope</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>This audit covers the period from till</td>
                                </tr>

                                <tr>
                                    <td>
                                        <ol type="a">
                                            <li>...</li>
                                            <li>...</li>
                                            <li>...</li>
                                        </ol>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-sm-12 form-group">
                        <table class="table table-bordered">
                            @foreach ($announcementMemo['teams'] as $team)
                                <thead>
                                    <tr>
                                        <th colspan="2">
                                            Audit Team {{ $team['team_name'] }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Name</th>
                                        <th>Designation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($team['members'] as $member)
                                        <tr>
                                            <td>{{ $member['team_member_name_en'] }}</td>
                                            <td>{{ $member['team_member_designation_en'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @endforeach
                        </table>
                    </div>

                    <div class="col-sm-12 form-group">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="2">
                                        Audit Time Table
                                    </th>
                                </tr>
                                <tr>
                                    <th>Particulars</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Start of Audit</td>
                                    <td>{{ count($announcementMemo['teams']) ? $announcementMemo['teams'][0]['team_start_date'] : '--' }}
                                    </td>
                                </tr>

                                <tr>
                                    <td>Close out Meeting</td>
                                    <td>Date</td>
                                </tr>

                                <tr>
                                    <td>Issue of Draft Report</td>
                                    <td>Date</td>
                                </tr>

                                <tr>
                                    <td>Issue of Final Report</td>
                                    <td>Date</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-sm-12 form-group">
                        <p>
                            We would like to see you for a kick-off meeting to discuss the focus areas of auditable
                            activities on audit commencement date i.e.
                            [{{ count($announcementMemo['teams']) ? $announcementMemo['teams'][0]['team_start_date'] : '--' }}].
                            Kindly, commenicate the commencement of internal audit of relevant personnel.
                        </p>

                        <p>
                            At the completion of field work, the audit results will be shared and discussed with you and
                            other conrned personnel before submission of the draft report for management comments. The
                            report will be finalized after obtaining management comments and action plan along with the
                            target implementation date in writing.
                        </p>

                        <p>
                            We look forward to a smooth audit with your assistance and co-operation
                        </p>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-download btn-sm btn-bold btn-square ml-auto"
                    onclick="Entity_Plan_Container.downloadAnnouncementModal({{ $yearly_plan_location_id }})">
                    Download
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    var Entity_Plan_Container = {
        downloadAnnouncementModal: function (yearly_plan_location_id) {
            url = "{{ route('audit.plan.individual.download-announcement-memo') }}";

            data = {
                yearly_plan_location_id
            };

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                message: 'ডাউনলোড হচ্ছে অপেক্ষা করুন...',
                state: 'primary' // a bootstrap color
            });

            $.ajax({
                type: 'get',
                url: url,
                data: data,
                xhrFields: {
                    responseType: 'blob'
                },
                success: function (response) {
                    KTApp.unblock('#kt_wrapper');
                    var blob = new Blob([response]);
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "announcement-memo.pdf";
                    link.click();
                },
                error: function (blob) {
                    toastr.error('Failed to generate PDF.')
                    console.log(blob);
                }
            });
        },
    }
</script>
